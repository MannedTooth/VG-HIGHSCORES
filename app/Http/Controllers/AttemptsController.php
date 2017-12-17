<?php

namespace App\Http\Controllers;

use App\Attempt;
use App\Record;
use App\User;

use Illuminate\Http\Request;
use App\Http\Requests\AttemptRequest;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class AttemptsController extends Controller
{
    public function show($game_nickname, Record $record, Attempt $attempt)
    {
        Log::info('showing');
        return view('attempts.show', compact( 'attempt'));
    }

    public function create($game_nickname, Record $record)
    {
        if (Gate::allows('create-attempts'))
        {
            $users = User::orderBy('name')->get();

            return view('attempts.create', compact('record', 'users'));
        }
        else
        {
            return redirect('/games/' . $game_nickname . '/records/' . $record->id);
        }
    }

    public function store(AttemptRequest $request, $game_nickname, Record $record)
    {

        DB::beginTransaction();
        try
        {
            Attempt::create([
                'user_id' => request('user_id'),
                'record_id' => request('record_id'),
                'url' => request('url'),
                'score' => request('score'),
            ]);

            DB::commit();

            return redirect('/games/' . $game_nickname . '/records/' . $record->id);
        }
        catch (\Throwable $e)
        {
            DB::rollback();

            return redirect('/games/' . $game_nickname . '/records/' . $record->id);
        }
    }

    public function edit($game_nickname, Record $record, Attempt $attempt)
    {
        if (Gate::allows('edit-attempts'))
        {
            $users = User::orderBy('name')->get();

            return view('attempts.edit', compact('attempt', 'users'));
        }
        else
        {
            return redirect('/games/' . $attempt->record->game->nickname . '/records/' . $record->id . '/attempts/' . $attempt->id . '/edit');
        }
    }

    public function update(AttemptRequest $request, $game_nickname, Record $record, Attempt $attempt)
    {
        DB::beginTransaction();
        try
        {
            $attempt->update([
                'user_id' => request('user_id'),
                'record_id' => request('record_id'),
                'url' => request('url'),
                'score' => request('score'),
            ]);

            DB::commit();

            return redirect('/games/' . $attempt->record->game->nickname . '/records/' . $attempt->record->id);
        }
        catch (\Throwable $e)
        {
            DB::rollback();

            return redirect('/games/' . $attempt->record->game->nickname . '/records/' . $attempt->record->id);
        }
    }

    public function delete($game_nickname, Record $record, Attempt $attempt)
    {
        if (Gate::allows('delete-attempts'))
        {
            DB::beginTransaction();
            try
            {
                $attempt->delete();

                DB::commit();

                return redirect('/games/' . $game_nickname . '/records/' . $record->id);
            }
            catch (\Throwable $e)
            {
                DB::rollback();

                return redirect('/games/' . $game_nickname . '/records/' . $record->id);
            }
        }
    }

}

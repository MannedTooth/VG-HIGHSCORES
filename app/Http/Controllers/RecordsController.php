<?php

namespace App\Http\Controllers;

use App\Game;
use App\Record;

use Illuminate\Http\Request;
use App\Http\Requests\RecordRequest;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class RecordsController extends Controller
{
    public function show($nickname, Record $record)
    {
        $game = Game::where('nickname', $nickname)->first();

        return view('records.show', compact('game', 'record'));
    }

    public function create($nickname)
    {
        if (Gate::allows('create-records'))
        {
            $game = Game::where('nickname', $nickname)->first();

            return view('records.create', compact('game'));
        }
        else
        {
            return redirect('/games/{nickname}/records');
        }
    }

    public function store(RecordRequest $request, $nickname)
    {
        $game = Game::where('nickname', $nickname)->first();

        DB::beginTransaction();
        try
        {
            Record::create([
                'name' => request('name'),
                'unit' => request('unit'),
                'game_id' => $game->id,
                'time' => $request->has('time'),
                'decreasing' => $request->has('decreasing'),
            ]);

            DB::commit();

            return redirect('/games/' . $nickname);
        }
        catch (\Throwable $e)
        {
            DB::rollback();

            return redirect('/games/' . $nickname);
        }
    }

    public function edit($game_nickname, Record $record)
    {
        if (Gate::allows('edit-records'))
        {
            return view('records.edit', compact('record'));
        }
        else
        {
            return redirect('/');
        }
    }

    public function update(RecordRequest $request, $game_nickname, Record $record)
    {
        DB::beginTransaction();
        try
        {
            $record->update([
                'name' => request('name'),
                'nickname' => request('nickname'),
                ]);

            DB::commit();

            return redirect('/games/' . $record->game->nickname);
        }
        catch (\Throwable $e)
        {
            DB::rollback();

            return redirect('/games/' . $record->game->nickname);
        }
    }

    public function delete($game_nickname, Record $record)
    {
        if (Gate::allows('delete-records'))
        {
            DB::beginTransaction();
            try
            {
                $record->delete();

                DB::commit();

                return redirect('/games/' . $game_nickname);
            }
            catch (\Throwable $e)
            {
                DB::rollback();

                return redirect('/games/' . $game_nickname);
            }
        }
    }
}

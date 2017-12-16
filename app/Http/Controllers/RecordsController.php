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

            return redirect('/games/' . $game->nickname . '/records');
        }
        catch (\Throwable $e)
        {
            DB::rollback();

            return redirect('/games/' . $game->nickname . '/records');
        }
    }

    public function edit($game_nickname)
    {
        if (Gate::allows('edit-games'))
        {
            $game = Game::where('nickname', $game_nickname)->first();

            $genres = Genre::orderBy('name')->get();

            return view('games.edit', compact('game', 'genres'));
        }
        else
        {
            return redirect('/games');
        }
    }

    public function update(GameRequest $request, $game_nickname)
    {
        DB::beginTransaction();
        try
        {
            $game = Game::where('nickname', $game_nickname)->first();

            $game->update(['name' => request('name'), 'nickname' => request('nickname')]);

            $game->genres()->sync(request('genre'));

            DB::commit();

            return redirect('/games');
        }
        catch (\Throwable $e)
        {
            DB::rollback();

            return redirect('/games');
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

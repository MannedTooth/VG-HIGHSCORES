<?php

namespace App\Http\Controllers;

use App\Game;
use App\Genre;
use App\Image;
use App\Http\Requests\GameRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class GamesController extends Controller
{
    public function browse()
    {
        $games = Game::orderBy('name')->get();

        return view('games.browse', compact('games'));
    }

    public function show($game_nickname)
    {
        $game = Game::where('nickname', $game_nickname)->first();

        return view('games.show', compact('game'));
    }

    public function create()
    {
        if (Gate::allows('create-games'))
        {
            $genres = Genre::orderBy('name')->get();

            return view('games.create', compact('genres'));
        }
        else
        {
            return redirect('/games');
        }
    }

    public function store(GameRequest $request)
    {
        DB::beginTransaction();
        try
        {
            $image = Image::create([
                'source_url' => $request->file('image')->hashName(),
            ]);

            $request->file('image')->store('public/covers');

            $game = Game::create([
                'name' => request('name'),
                'nickname' => request('nickname'),
                'description' => request('description'),
                'release_year' => request('release_year'),
                'cover_image_id' => $image->id,
            ]);

            $game->genres()->sync(request('genre'));

            DB::commit();

            return redirect('/games');
        }
        catch (\Throwable $e)
        {
            DB::rollback();

            return redirect('/');
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

            $game->update([
                'name' => request('name'),
                'nickname' => request('nickname'),
                'description' => request('description'),
                'release_year' => request('release_year'),
            ]);

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

    public function delete(Game $game)
    {
        if (Gate::allows('delete-games'))
        {
            DB::beginTransaction();
            try
            {
                $game->delete();

                DB::commit();

                return redirect('/games');
            }
            catch (\Throwable $e)
            {
                DB::rollback();

                return redirect('/games');
            }
        }
    }
}

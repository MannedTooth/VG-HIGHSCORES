<?php

namespace App\Http\Controllers;

use App\Genre;
use App\Http\Requests\GenreRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class GenresController extends Controller
{
    public function browse()
    {
        $genres = Genre::orderBy('name')->get();

        return view('genres.browse', compact('genres'));
    }

    public function create()
    {
        if (Gate::allows('create-genres'))
        {
            return view('genres.create');
        }
        else
        {
            return redirect('/genres');
        }
    }

    public function store(GenreRequest $request)
    {
        DB::beginTransaction();
        try
        {
            Genre::create([
                'name' => request('name'),
            ]);

            DB::commit();

            return redirect('/genres');
        }
        catch (\Throwable $e)
        {
            DB::rollback();

            return redirect('/genres');
        }
    }

    public function edit(Genre $genre)
    {
        if (Gate::allows('edit-genres'))
        {
            return view('genres.edit', compact('genre'));
        }
        else
        {
            return redirect('/genres');
        }
    }

    public function update(GenreRequest $request, Genre $genre)
    {
        DB::beginTransaction();
        try
        {
            $genre->update(['name' => request('name')]);

            DB::commit();

            return redirect('/genres');
        }
        catch (\Throwable $e)
        {
            DB::rollback();

            return redirect('/genres');
        }
    }

    public function delete(Genre $genre)
    {
        if (Gate::allows('delete-genres'))
        {
            DB::beginTransaction();
            try
            {
                $genre->delete();

                DB::commit();

                return redirect('/genres');
            }
            catch (\Throwable $e)
            {
                DB::rollback();

                return redirect('/genres');
            }
        }
    }
}

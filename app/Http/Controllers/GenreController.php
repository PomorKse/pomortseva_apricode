<?php

namespace App\Http\Controllers;

use App\Contracts\GenreInterface;
use App\Http\Requests\Genre\CreateGenreRequest;
use App\Http\Requests\Genre\UpdateGenreRequest;
use App\Http\Resources\GenreResource;
use App\Models\Genre;

class GenreController extends Controller
{
    public function index(GenreInterface $service)
    {
        $games = $service->getAllData();
        
        return $games;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param GenreInterface $service
     * @param CreateGenreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(GenreInterface $service, CreateGenreRequest $request)
    {
        $validated = $request->validated();

        return $service->updateOrCreate($id = null, $validated);
    }

    /**
     * Display the specified resource.
     *
     * @param GenreInterface $service
     * @param Genre $genre
     * @return \Illuminate\Http\Response
     */
    public function show(GenreInterface $service, Genre $genre)
    {
        $genres = $service->getOne($genre);
        
        return $genres;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateGenreRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GenreInterface $service, UpdateGenreRequest $request, $id)
    {
        $validated = $request->validated();

        return $service->updateOrCreate($id, $validated);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param GenreInterface $service
     * @param Genre $genre
     * @return \Illuminate\Http\Response
     */
    public function destroy(GenreInterface $service, Genre $genre)
    {
        return $service->delete($genre);
    }
}

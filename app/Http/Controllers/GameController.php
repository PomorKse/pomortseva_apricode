<?php

namespace App\Http\Controllers;

use App\Contracts\GameInterface;
use App\Models\Game;
use App\Http\Requests\Game\CreateGameRequest;
use App\Http\Requests\Game\UpdateGameRequest;

class GameController extends Controller
{
    public function index(GameInterface $service)
    {
        $games = $service->getAllData();
        
        return $games;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param GameInterface $service
     * @param CreateGameRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(GameInterface $service, CreateGameRequest $request)
    {
        $validated = $request->validated();
        $genres = $request->input('genres');

        return $service->updateOrCreate($id = null, $validated, $genres);
    }

    /**
     * Display the specified resource.
     *
     * @param GameInterface $service
     * @param Game $game
     * @return \Illuminate\Http\Response
     */
    public function show(GameInterface $service, Game $game)
    {
        $games = $service->getOne($game);
        
        return $games;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateGameRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(GameInterface $service, UpdateGameRequest $request, $id)
    {
        $validated = $request->validated();
        $genres = $request->input('genres');

        return $service->updateOrCreate($id, $validated, $genres);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param GameInterface $service
     * @param Game $game
     * @return \Illuminate\Http\Response
     */
    public function destroy(GameInterface $service, Game $game)
    {
        return $service->delete($game);
    }
}

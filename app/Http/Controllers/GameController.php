<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Http\Requests\CreateGameRequest;
use App\Http\Requests\UpdateGameRequest;
use App\Http\Resources\GameResource;
use App\Models\Genre;

class GameController extends Controller
{
    public function index(Game $games)
    {
        return GameResource::collection(($games->all()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateGameRequest $request)
    {
        $game = Game::create($request->validated());

        $genres = $request->input('genres');
        if ($genres) {
            $this->attachGenre($game, $genres);
        }
        
        if($game) {
            return response()->json(['message' => 'Game created successfully']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Game $game)
    {
        return new GameResource($game);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGameRequest $request, Game $game)
    {
        
        $genres = $request->input('genres');
        if ($genres) {
            $this->attachGenre($game, $genres);
        }
        
        $game = $game->update($request->validated());
       
        if($game){
            return response()->json(['message' => 'Game updated successfully']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game)
    {
        try{
			$game->delete();

			return response()->json([
                'success' => true,
                'message' => 'Game deleted successfully'
            ]);
		}catch (\Exception $e) {
			\Log::error($e->getMessage() . PHP_EOL, $e->getTrace());

			return response()->json(['success' => false]);
		}
    }

    public function attachGenre(Game $game, $genres) : void
    {
        foreach ($genres as $genre) {
            $genre = Genre::where('name', $genre)->pluck('id');
            $game->genres()->sync($genre[0]);
        }
    }
}

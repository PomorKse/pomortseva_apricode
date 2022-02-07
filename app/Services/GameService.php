<?php

namespace App\Services;

use App\Contracts\GameInterface;
use App\Models\Game;
use App\Http\Resources\GameResource;
use App\Models\Genre;



class GameService implements GameInterface
{
    public function getAllData()
    {
        return GameResource::collection((Game::all()));
    }

    public function updateOrCreate($id = null, $data, $genres = null) : string
    {

        if(is_null($id)){
            $game = Game::create($data);
    
            if ($genres) {
                $this->attachGenre($game, $genres);
            }
            
            if($game) {
                return response()->json(['message' => 'Game created successfully']);
            }
        }else{
            $game = Game::find($id);
            if ($genres) {
                $this->attachGenre($game, $genres);
            }
            $game = $game->update($data);
            
            if($game){
                return response()->json(['message' => 'Game updated successfully']);
            }
        }
    }

    public function getOne($id)
    {
        return new GameResource($id);
    }

    public function delete($id) : string
    {
        try{
			$id->delete();

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
            $game->genres()->syncWithoutDetaching($genre[0]);
        }
    }

}
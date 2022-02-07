<?php

namespace App\Services;

use App\Contracts\GenreInterface;
use App\Models\Game;
use App\Http\Resources\GenreResource;
use App\Models\Genre;


class GenreService implements GenreInterface
{
    public function getAllData()
    {
        return GenreResource::collection(Genre::all());
    }

    public function updateOrCreate($id = null, $data) : string
    {

        if(is_null($id)){
            $genre = Genre::create($data);
        
            if($genre) {
                return response()->json(['message' => 'Genre created successfully']);
            }
        }else{
            $genre = Genre::find($id)->update($data);
       
            if($genre){
                return response()->json(['message' => 'Genre updated successfully']);
            }
        }
    }

    public function getOne($id)
    {
        return new GenreResource($id);
    }

    public function delete($id) : string
    {
        try{
			$id->delete();

			return response()->json([
                'success' => true,
                'message' => 'Genre deleted successfully'
            ]);
		}catch (\Exception $e) {
			\Log::error($e->getMessage() . PHP_EOL, $e->getTrace());

			return response()->json(['success' => false]);
		}
    }
}
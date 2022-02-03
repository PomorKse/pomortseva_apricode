<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGenreRequest;
use App\Http\Requests\UpdateGenreRequest;
use Illuminate\Http\Request;
use App\Models\Genre;

class GenreController extends Controller
{
    public function index(Genre $genres)
    {
        $genres = $genres->all();

        return response()->json(['genres' => $genres]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateGenreRequest $request)
    {
        $genre = Genre::create($request->validated());
        
        if($genre) {
            return response()->json(['message' => 'Genre created successfully']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Genre $genre)
    {
        $genre = $genre->find($genre);

        return response()->json(['genre' => $genre]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGenreRequest $request, Genre $genre)
    {
        $genre = $genre->fill($request->validated())->save();
       
        if($genre){
            return response()->json(['message' => 'Genre updated successfully']);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Genre $genre)
    {
        try{
			$genre->delete();

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

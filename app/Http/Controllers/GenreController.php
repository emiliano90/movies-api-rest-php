<?php

namespace App\Http\Controllers;

use App\Http\Resources\GenreCollection;
use App\Http\Resources\GenreResource;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class GenreController extends Controller
{
	/**
	 * Create a new GenreController instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth:api');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$genres = Genre::paginate();
		return (new GenreCollection($genres))->response();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$request->validate([
			'name' => 'bail|required|string|max:255',
		]);

		$genre = new Genre();

		$genre->name = $request->input('name');

		$genre->save();

		Log::info("Actor ID {$genre->id} created successfully.");

		return (new GenreResource($genre))->response()->setStatusCode(Response::HTTP_CREATED);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Genre  $genre
	 * @return \Illuminate\Http\Response
	 */
	public function show(Genre $genre)
	{
		return (new GenreResource($genre))->response();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Genre  $genre
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Genre $genre)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Genre  $genre
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Genre $genre)
	{
		$request->validate([
			'name' => 'bail|required|string|max:255'
		]);

		$genre->name = $request->input('name');

		$genre->save();


		Log::info("Genre ID {$genre->id} updated successfully.");

		return (new GenreResource($genre))->response();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Genre  $genre
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Genre $genre)
	{
		$genre->delete();

		Log::info("Genre ID {$genre->id} deleted successfully.");

		return response(null, Response::HTTP_NO_CONTENT);
	}
}

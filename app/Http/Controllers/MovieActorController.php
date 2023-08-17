<?php

namespace App\Http\Controllers;

use App\Http\Resources\ActorCollection;
use App\Http\Resources\ActorResource;
use App\Http\Resources\MovieResource;
use App\Models\Actor;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MovieActorController extends Controller
{
	/**
	 * Create a new MovieActorController instance.
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
	public function index($movie)
	{

		$movie = Movie::findOrFail($movie);
		return (new ActorCollection($movie->actors))->response();
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
	public function store(Movie $movie, Request $request)
	{
		$request->validate([
			'actor' => 'bail|required|numeric'
		]);

		$actor = Actor::findOrFail($request->input('actor'));
		$movie->actors()->attach($actor);

		return (new MovieResource($movie))->response()->setStatusCode(Response::HTTP_CREATED);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Movie  $movie
	 * @return \Illuminate\Http\Response
	 */
	public function show(Movie $movie, Actor $actor)
	{
		$actor = $movie->actors()->findOrFail($actor->id);
		return (new ActorResource($actor))->response();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Movie  $movie
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Movie $movie)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Movie  $movie
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Movie $movie)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Movie  $movie
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Movie $movie, Actor $actor)
	{
		$actor = $movie->actors()->findOrFail($actor->id);
		$movie->actors()->detach($actor->id);
		return response(null, Response::HTTP_NO_CONTENT);
	}
}

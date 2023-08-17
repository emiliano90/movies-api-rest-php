<?php

namespace App\Http\Controllers;

use App\Http\Resources\ActorCollection;
use App\Http\Resources\ActorResource;
use App\Http\Resources\TvShowResource;
use App\Models\Actor;
use App\Models\TvShow;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TvShowActorController extends Controller
{
	/**
	 * Create a new TvShowActorController instance.
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
	public function index(TvShow $tvshow)
	{
		$tvshow = TvShow::findOrFail($tvshow);
		return (new ActorCollection($tvshow->actors))->response();
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
	public function store(TvShow $tvshow, Request $request)
	{
		$request->validate([
			'actor' => 'bail|required|numeric'
		]);

		$actor = Actor::findOrFail($request->input('actor'));
		$tvshow->actors()->attach($actor);

		return (new TvShowResource($tvshow))->response()->setStatusCode(Response::HTTP_CREATED);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\TvShow  $tvShow
	 * @return \Illuminate\Http\Response
	 */
	public function show(TvShow $tvShow, Actor $actor)
	{
		$actor = $tvShow->actors()->findOrFail($actor->id);
		return (new ActorResource($actor))->response();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\TvShow  $tvShow
	 * @return \Illuminate\Http\Response
	 */
	public function edit(TvShow $tvShow)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\TvShow  $tvShow
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, TvShow $tvShow)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\TvShow  $tvShow
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(TvShow $tvShow, Actor $actor)
	{
		$actor = $tvShow->actors()->findOrFail($actor->id);
		$tvShow->actors()->detach($actor->id);
		return response(null, Response::HTTP_NO_CONTENT);
	}
}

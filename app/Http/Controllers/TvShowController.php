<?php

namespace App\Http\Controllers;

use App\Http\Resources\TvShowCollection;
use App\Http\Resources\TvShowResource;
use App\Models\Genre;
use App\Models\TvShow;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class TvShowController extends Controller
{
	/**
	 * Create a new TvShowController instance.
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
		$tvshows = TvShow::paginate();
		return (new TvShowCollection($tvshows))->response();
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
			'release' => 'bail|required|date_format:Y-m-d',
			'genre' => 'bail|required|numeric',
		]);

		$genre = Genre::findOrFail($request->input('genre'));

		$tvShow = new TvShow();

		$tvShow->name = $request->input('name');
		$tvShow->release = $request->input('release');

		$tvShow->genre()->associate($genre);

		$tvShow->save();

		Log::info("TvShow ID {$tvShow->id} created successfully.");

		return (new TvShowResource($tvShow))->response()->setStatusCode(Response::HTTP_CREATED);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\TvShow  $tvShow
	 * @return \Illuminate\Http\Response
	 */
	public function show(TvShow $tvShow)
	{
		return (new TvShowResource($tvShow))->response();
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
		$request->validate([
			'name' => 'bail|required|string|max:255',
			'release' => 'bail|required|date_format:Y-m-d',
			'genre' => 'bail|required|numeric',
		]);

		$genre = Genre::findOrFail($request->input('genre'));

		$tvShow->name = $request->input('name');
		$tvShow->release = $request->input('release');

		$tvShow->genre()->associate($genre);

		$tvShow->save();


		Log::info("TvShow ID {$tvShow->id} updated successfully.");

		return (new TvShowResource($tvShow))->response();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\TvShow  $tvShow
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(TvShow $tvShow)
	{
		$tvShow->delete();

		Log::info("TvShow ID {$tvShow->id} deleted successfully.");

		return response(null, Response::HTTP_NO_CONTENT);
	}
}

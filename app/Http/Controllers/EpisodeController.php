<?php

namespace App\Http\Controllers;

use App\Http\Resources\EpisodeCollection;
use App\Http\Resources\EpisodeResource;
use App\Models\Director;
use App\Models\Episode;
use App\Models\Season;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class EpisodeController extends Controller
{
	/**
	 * Create a new EpisodeController instance.
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
		$episodes = Episode::paginate();
		return (new EpisodeCollection($episodes))->response();
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
			'number' => 'bail|required|numeric',
			'director' => 'bail|required|numeric',
			'season' => 'bail|required|numeric',
		]);

		$director = Director::findOrFail($request->input('director'));
		$season = Season::findOrFail($request->input('season'));

		$episode = new Episode();

		$episode->name = $request->input('name');
		$episode->number = $request->input('number');

		$episode->director()->associate($director);
		$episode->season()->associate($season);

		$episode->save();

		Log::info("Episode ID {$episode->id} created successfully.");

		return (new EpisodeResource($episode))->response()->setStatusCode(Response::HTTP_CREATED);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Episode  $episode
	 * @return \Illuminate\Http\Response
	 */
	public function show(Episode $episode)
	{
		return (new EpisodeResource($episode))->response();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Episode  $episode
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Episode $episode)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Episode  $episode
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Episode $episode)
	{
		$request->validate([
			'name' => 'bail|required|string|max:255',
			'number' => 'bail|required|numeric',
			'director' => 'bail|required|numeric',
			'season' => 'bail|required|numeric',
		]);

		$director = Director::findOrFail($request->input('director'));
		$season = Season::findOrFail($request->input('season'));

		$episode->name = $request->input('name');
		$episode->number = $request->input('number');

		$episode->director()->associate($director);
		$episode->season()->associate($season);

		$episode->save();


		Log::info("Episode ID {$episode->id} updated successfully.");

		return (new EpisodeResource($episode))->response();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Episode  $episode
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Episode $episode)
	{
		$episode->delete();

		Log::info("Episode ID {$episode->id} deleted successfully.");

		return response(null, Response::HTTP_NO_CONTENT);
	}
}

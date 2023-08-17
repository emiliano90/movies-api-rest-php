<?php

namespace App\Http\Controllers;

use App\Http\Resources\SeasonCollection;
use App\Http\Resources\SeasonResource;
use App\Models\Season;
use App\Models\TvShow;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class SeasonController extends Controller
{
	/**
	 * Create a new SeasonController instance.
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
		$seasons = Season::paginate();
		return (new SeasonCollection($seasons))->response();
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
			'number' => 'bail|required|numeric',
			'tvshow' => 'bail|required|numeric',
		]);

		$tvshow = TvShow::findOrFail($request->input('tvshow'));

		$season = new Season();

		$season->number = $request->input('number');

		$season->tvshow()->associate($tvshow);

		$season->save();

		Log::info("Season ID {$season->id} created successfully.");

		return (new SeasonResource($season))->response()->setStatusCode(Response::HTTP_CREATED);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Season  $season
	 * @return \Illuminate\Http\Response
	 */
	public function show(Season $season)
	{
		return (new SeasonResource($season))->response();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Season  $season
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Season $season)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Season  $season
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Season $season)
	{
		$request->validate([
			'number' => 'bail|required|numeric',
			'tvshow' => 'bail|required|numeric',
		]);

		$tvshow = TvShow::findOrFail($request->input('tvshow'));

		$season->number = $request->input('number');

		$season->tvshow()->associate($tvshow);

		$season->save();


		Log::info("Season ID {$season->id} updated successfully.");

		return (new SeasonResource($season))->response();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Season  $season
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Season $season)
	{
		$season->delete();

		Log::info("Season ID {$season->id} deleted successfully.");

		return response(null, Response::HTTP_NO_CONTENT);
	}
}

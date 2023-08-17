<?php

namespace App\Http\Controllers;

use App\Http\Resources\ActorCollection;
use App\Http\Resources\ActorResource;
use App\Models\Actor;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class ActorController extends Controller
{
	/**
	 * Create a new ActorController instance.
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
		$actors = Actor::paginate();
		return (new ActorCollection($actors))->response();
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
			'last_name' => 'bail|required|string|max:255',
			'born' => 'bail|required|date_format:Y-m-d'
		]);

		$actor = new Actor();

		$actor->name = $request->input('name');
		$actor->last_name = $request->input('last_name');
		$actor->born = $request->input('born');

		$actor->save();

		Log::info("Actor ID {$actor->id} created successfully.");

		return (new ActorResource($actor))->response()->setStatusCode(Response::HTTP_CREATED);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Actor  $actor
	 * @return \Illuminate\Http\Response
	 */
	public function show(Actor $actor)
	{
		return (new ActorResource($actor))->response();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Actor  $actor
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Actor $actor)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Actor  $actor
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Actor $actor)
	{
		$request->validate([
			'name' => 'bail|required|string|max:255',
			'last_name' => 'bail|required|string|max:255',
			'born' => 'bail|required|date_format:Y-m-d'
		]);

		$actor->name = $request->input('name');
		$actor->last_name = $request->input('last_name');
		$actor->born = $request->input('born');

		$actor->save();


		Log::info("Actor ID {$actor->id} updated successfully.");

		return (new ActorResource($actor))->response();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Actor  $actor
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Actor $actor)
	{
		$actor->delete();

		Log::info("Actor ID {$actor->id} deleted successfully.");

		return response(null, Response::HTTP_NO_CONTENT);
	}
}

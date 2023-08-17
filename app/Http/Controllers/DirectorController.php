<?php

namespace App\Http\Controllers;

use App\Http\Resources\DirectorCollection;
use App\Http\Resources\DirectorResource;
use App\Models\Director;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class DirectorController extends Controller
{
	/**
	 * Create a new DirectorController instance.
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
		$directors = Director::paginate();
		return (new DirectorCollection($directors))->response();
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

		$director = new Director();

		$director->name = $request->input('name');
		$director->last_name = $request->input('last_name');
		$director->born = $request->input('born');

		$director->save();

		Log::info("Director ID {$director->id} created successfully.");

		return (new DirectorResource($director))->response()->setStatusCode(Response::HTTP_CREATED);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Director  $director
	 * @return \Illuminate\Http\Response
	 */
	public function show(Director $director)
	{
		return (new DirectorResource($director))->response();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Director  $director
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Director $director)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Director  $director
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Director $director)
	{
		$request->validate([
			'name' => 'bail|required|string|max:255',
			'last_name' => 'bail|required|string|max:255',
			'born' => 'bail|required|date_format:Y-m-d'
		]);

		$director->name = $request->input('name');
		$director->last_name = $request->input('last_name');
		$director->born = $request->input('born');

		$director->save();

		Log::info("Director ID {$director->id} updated successfully.");

		return (new DirectorResource($director))->response();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Director  $director
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Director $director)
	{
		$director->delete();

		Log::info("Director ID {$director->id} deleted successfully.");

		return response(null, Response::HTTP_NO_CONTENT);
	}
}

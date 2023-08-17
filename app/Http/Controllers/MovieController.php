<?php

namespace App\Http\Controllers;

use App\Http\Resources\MovieCollection;
use App\Http\Resources\MovieResource;
use App\Models\Director;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class MovieController extends Controller
{
	/**
	 * Create a new MovieController instance.
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
	public function index(Request $request)
	{
		$query = Movie::query();

		if (request('name')) {
			$query
				->where('name', 'like', '%' . request('name') . '%');
		}
		if (request('genre')) {
			$query
				->where('genre_id', 'like', '%' . request('genre') . '%');
		}
		if ($request->has(['field', 'sortOrder']) && $request->field != null) {
			$query->orderBy(request('field'), request('sortOrder'));
		}

		// Ignore my InertiaJS implementation, will work the same with base Blade Files.
		/*return Inertia::render('Users/Index', [
			'users' => fn () => $query->paginate(10)->withQueryString(),
		]);*/

		$movies = $query->paginate();
		return (new MovieCollection($movies))->response();
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
			'duration' => 'bail|required|numeric',
			'genre' => 'bail|required|numeric',
			'director' => 'bail|required|numeric'
		]);

		$director = Director::findOrFail($request->input('director'));
		$genre = Genre::findOrFail($request->input('genre'));

		$movie = new Movie();



		$movie->name = $request->input('name');
		$movie->release = $request->input('release');
		$movie->duration = $request->input('duration');

		$movie->director()->associate($director);
		$movie->genre()->associate($genre);

		$movie->save();

		Log::info("Movie ID {$movie->id} created successfully.");

		return (new MovieResource($movie))->response()->setStatusCode(Response::HTTP_CREATED);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Movie  $movie
	 * @return \Illuminate\Http\Response
	 */
	public function show(Movie $movie)
	{
		return (new MovieResource($movie))->response();
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
		$request->validate([
			'name' => 'bail|required|string|max:255',
			'release' => 'bail|required|date_format:Y-m-d',
			'duration' => 'bail|required|numeric',
			'genre' => 'bail|required|numeric',
			'director' => 'bail|required|numeric'
		]);

		$director = Director::findOrFail($request->input('director'));
		$genre = Genre::findOrFail($request->input('genre'));

		$movie->name = $request->input('name');
		$movie->release = $request->input('release');
		$movie->duration = $request->input('duration');

		$movie->director()->associate($director);
		$movie->genre()->associate($genre);

		$movie->save();

		Log::info("Movie ID {$movie->id} updated successfully.");

		return (new MovieResource($movie))->response();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Movie  $movie
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Movie $movie)
	{
		$movie->delete();

		Log::info("Movie ID {$movie->id} deleted successfully.");

		return response(null, Response::HTTP_NO_CONTENT);
	}
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Actor extends Model
{
	use HasFactory, SoftDeletes;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'name',
		'last_name',
		'born'
	];

	/**
	 * Get the movie that owns the actor.
	 */
	public function movies()
	{
		return $this->belongsToMany(Movie::class, 'actor_movie');
	}

	/**
	 * Get the movie that owns the actor.
	 */
	public function tvshows()
	{
		return $this->belongsToMany(TvShow::class, 'actor_tvshow');
	}
}

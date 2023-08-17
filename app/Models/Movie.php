<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movie extends Model
{
	use HasFactory, SoftDeletes;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'name',
		'genre',
		'release',
		'duration',
	];

	/**
	 * Get the director associated with the movie.
	 */
	public function director()
	{
		return $this->belongsTo(Director::class);
	}

	/**
	 * Get the genre associated with the movie.
	 */
	public function genre()
	{
		return $this->belongsTo(Genre::class);
	}

	/**
	 * Get the actors for the movie.
	 */
	public function actors()
	{
		return $this->belongsToMany(Actor::class, 'actor_movie');
	}
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Genre extends Model
{
	use HasFactory, SoftDeletes;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'name',
	];

	/**
	 * Get the movies that owns the episode.
	 */
	public function movies()
	{
		return $this->hasMany(Movie::class);
	}

	/**
	 * Get the tvshows that owns the episode.
	 */
	public function tvshows()
	{
		return $this->hasMany(TvShow::class);
	}
}

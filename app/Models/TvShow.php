<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TvShow extends Model
{
	use HasFactory, SoftDeletes;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'name',
		'release'
	];

	/**
	 * Get the actors for the tvshow.
	 */
	public function actors()
	{
		return $this->hasMany(Actor::class);
	}

	/**
	 * Get the genre associated with the tvshow.
	 */
	public function genre()
	{
		return $this->belongsTo(Genre::class);
	}

	/**
	 * Get the seasons for the tvshow.
	 */
	public function seasons()
	{
		return $this->hasMany(Season::class);
	}
}

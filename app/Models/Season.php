<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Season extends Model
{
	use HasFactory, SoftDeletes;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'number'
	];

	/**
	 * Get the tvshow that owns the season.
	 */
	public function tvshow()
	{
		return $this->belongsTo(TvShow::class);
	}

	/**
	 * Get the episodes for the season.
	 */
	public function episodes()
	{
		return $this->hasMany(Episode::class);
	}
}

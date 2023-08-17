<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Episode extends Model
{
	use HasFactory, SoftDeletes;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'name',
		'number'
	];

	/**
	 * Get the director associated with the episode.
	 */
	public function director()
	{
		return $this->belongsTo(Director::class);
	}

	/**
	 * Get the season that owns the episode.
	 */
	public function season()
	{
		return $this->belongsTo(Season::class);
	}
}

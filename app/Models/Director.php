<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Director extends Model
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
	 * Get the episode that owns the director.
	 */
	public function episode()
	{
		return $this->belongsTo(Episode::class);
	}

	/**
	 * Get the movie that owns the director.
	 */
	public function movie()
	{
		return $this->belongsTo(Movie::class);
	}
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('movies', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->unsignedBigInteger('director_id');
			$table->unsignedBigInteger('genre_id');
			$table->foreign('director_id')->references('id')->on('directors');
			$table->foreign('genre_id')->references('id')->on('genres');
			$table->integer('duration');
			$table->date('release');
			$table->softDeletes();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('movies');
	}
}

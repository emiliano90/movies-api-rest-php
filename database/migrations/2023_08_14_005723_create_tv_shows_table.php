<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTvShowsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tv_shows', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->unsignedBigInteger('genre_id');
			$table->foreign('genre_id')->references('id')->on('genres');
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
		Schema::dropIfExists('tv_shows');
	}
}

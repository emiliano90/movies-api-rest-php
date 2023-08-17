<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpisodesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('episodes', function (Blueprint $table) {
			$table->id();
			$table->integer('number');
			$table->string('name');
			$table->unsignedBigInteger('season_id');
			$table->unsignedBigInteger('director_id');
			$table->foreign('season_id')->references('id')->on('seasons');
			$table->foreign('director_id')->references('id')->on('directors');
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
		Schema::dropIfExists('episodes');
	}
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActorTvshowTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('actor_tvshow', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('actor_id');
			$table->unsignedBigInteger('tvshow_id');
			$table->foreign('actor_id')->references('id')->on('actors');
			$table->foreign('tvshow_id')->references('id')->on('tv_shows');
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
		Schema::dropIfExists('actor_tvshow');
	}
}

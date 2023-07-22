<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateZoneLocationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('zone_locations', function(Blueprint $table)
        {
            $table->id();
            $table->foreignId("zone_id")->constrained()->onDelete("cascade");
            $table->foreignId("country_id")->constrained()->onDelete("cascade");
            $table->foreignId("state_id")->nullable()->constrained()->onDelete("cascade");
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
		Schema::drop('zone_locations');
	}

}

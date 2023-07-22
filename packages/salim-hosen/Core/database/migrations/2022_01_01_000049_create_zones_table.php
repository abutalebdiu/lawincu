<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateZonesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('zones', function(Blueprint $table)
        {
            $table->id();
            $table->foreignId("company_id")->nullable()->constrained()->onDelete("cascade");
            $table->string('name');
            $table->boolean("cover_whole_world")->default(false);
            $table->boolean('is_active')->default(true);
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
		Schema::drop('zones');
	}

}

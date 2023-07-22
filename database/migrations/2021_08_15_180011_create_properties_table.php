<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('property_type_id');
            $table->foreignId('country')->nullable();
            $table->foreignId('state')->nullable();
            $table->foreignId('city')->nullable();

            $table->string('title')->nullable();
            $table->string('title_ar')->nullable();
            $table->string('slug')->nullable();

            $table->string('construction_type')->nullable();
            $table->json('images')->nullable();
            $table->string('video')->nullable();
            $table->string('electricity')->nullable();
            $table->string('water')->nullable();
            $table->string('length')->nullable();
            $table->string('width')->nullable();
            $table->string('age')->nullable();
            $table->string('bedrooms')->nullable();
            $table->string('bathrooms')->nullable();
            $table->string('livingroom')->nullable();
            $table->string('guestroom')->nullable();
            $table->string('landarea')->nullable();
            $table->string('builduparea')->nullable();
            $table->longText('description')->nullable();
            $table->longText('description_ar')->nullable();
            $table->string('price')->nullable();
            $table->string('sqrprice')->nullable();
            $table->string('referenceno')->nullable();
            $table->text('map_code')->nullable();
            $table->text('features')->nullable();
            $table->text('fixtures')->nullable();

            $table->string('street')->nullable();
            $table->string('streetwidth')->nullable();
            $table->string('facing')->nullable();

            $table->enum('status',['Pending','Active'])->default('Active');
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
        Schema::dropIfExists('properties');
    }
}

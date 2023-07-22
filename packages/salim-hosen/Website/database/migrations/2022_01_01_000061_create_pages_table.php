<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Spatie\Ignition\ErrorPage\config;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string("url")->nullable();
            $table->string("language_code")->default("en");
            $table->string("name");
            $table->string("title");
            $table->text("keywords");
            $table->text("description");
            $table->string("image")->nullable();
            $table->longText("content")->nullable();
            $table->boolean('is_active')->default(true);
            $table->string('customization_route')->nullable();
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
        Schema::dropIfExists('pages');
    }
}

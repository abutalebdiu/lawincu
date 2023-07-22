<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            // $table->string('arabic_name');
            $table->foreignId('category_id')->default(0);
            // $table->string('image')->nullable();
            $table->foreignId("media_upload_id")->nullable()->comment("image");
            $table->string('icon')->default("fas fa-archive");
            $table->tinyInteger("category_for")->default(0)->comment("0=product_category, 1=blog_category");
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->string('slug');
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
        Schema::dropIfExists('categories');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreatePageColumnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_columns', function (Blueprint $table) {
            $table->id();
            $table->foreignId("page_row_id")->nullable()->constrained()->onDelete('cascade');
            $table->tinyInteger("column_index");
            $table->string("class_name")->nullable();
            $table->boolean("show_data")->default(false);
            $table->string("data_type", 100)->nullable();
            $table->string("data")->nullable();
            $table->boolean("is_active")->default(false);
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
        Schema::dropIfExists('page_columns');
    }
}

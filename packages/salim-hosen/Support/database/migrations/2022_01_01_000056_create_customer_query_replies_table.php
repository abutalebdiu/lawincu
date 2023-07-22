<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerQueryRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_query_replies', function (Blueprint $table) {
            $table->id();
            $table->foreignId("customer_query_id")->constrained()->onDelete("cascade");
            // $table->string("attachment")->nullable();
            $table->text("description");
            $table->string("message_for");
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
        Schema::dropIfExists('customer_query_replies');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailingListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mailing_lists', function (Blueprint $table) {
            $table->id();
            $table->foreignId("company_id")->nullable()->constrained()->onDelete("cascade");
            $table->foreignId("mailing_list_id")->nullable()->constrained()->onDelete("cascade");
            // $table->foreignId("folder_id")->constrained()->onDelete("cascade");
            $table->string('name');
            $table->text("api_data")->nullable();
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
        Schema::dropIfExists('mailing_lists');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->foreignId("company_id")->nullable()->constrained()->onDelete("cascade");
            $table->foreignId("contact_id")->nullable()->constrained()->onDelete("cascade")->comment("customer");
            $table->foreignId("pipeline_id")->constrained()->onDelete("cascade");
            $table->foreignId("user_id")->nullable()->comment("sales person");
            $table->string("title");
            $table->string("email")->nullable();
            $table->string("phone")->nullable();
            $table->decimal('lead_value', 12, 2)->nullable();
            $table->string('status')->default("draft");
            $table->foreignId("lead_stage_id")->constrained()->onDelete("cascade");
            // $table->foreignId("lead_source_id")->nullable()->constrained()->onDelete("cascade");
            $table->date("expected_closing_date")->nullable();
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
        Schema::dropIfExists('leads');
    }
}

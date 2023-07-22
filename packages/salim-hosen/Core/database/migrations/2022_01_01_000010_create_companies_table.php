<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('company_id')->nullable(); // useful for child companies
            $table->string("company_uid")->nullable();
            $table->string("logo")->nullable();
            $table->string("name")->nullable();
            $table->string("arabic_name")->nullable();
            // $table->string("email")->nullable();
            // $table->string("phone")->nullable();
            // $table->foreignId("country_id")->nullable();
            // $table->foreignId("state_id")->nullable();
            // $table->text("address")->nullable();
            // $table->string("zip_code")->nullable();
            // $table->string("city")->nullable();


            $table->text("main_products")->nullable();
            $table->string("business_type")->nullable();
            $table->string("number_of_employees")->nullable();
            $table->string("year_of_establishment")->nullable();
            $table->string("average_lead_time")->nullable();
            $table->string("company_size")->nullable();
            $table->string("commercial_registration_number")->nullable();
            $table->string("tax_number")->nullable();

            $table->string("trade_license")->nullable();
            $table->string("nid")->nullable();
            $table->string("commercial_register_document")->nullable();

            $table->string("website")->nullable();

            $table->longText("company_description")->nullable();
            $table->string("slug");

            $table->boolean("is_verified")->default(false);
            $table->boolean("is_approved")->default(false);
            $table->boolean("is_active")->default(false);
            $table->float("rating")->default(0);

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
        Schema::dropIfExists('companies');
    }
}

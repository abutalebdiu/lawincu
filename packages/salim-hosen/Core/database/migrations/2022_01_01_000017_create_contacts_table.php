<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId("company_id")->nullable()->constrained()->onDelete("cascade"); // main company and partner company may have many contacts
            $table->foreignId("contact_id")->nullable(); // contacts of Account or address of account/contact
            $table->foreignId("user_id")->nullable()->comment("Customer/User Contact");
            $table->tinyInteger('contact_type')->default(0)->comment("0=Account, 1=Contact, 2=Delivery Address");
            $table->string('title')->nullable();
            $table->string('name')->nullable();
            $table->tinyInteger('gender')->nullable()->comment("0=Male, 1=Female, 2=Others");
            $table->string('nationality')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('fax')->nullable();

            $table->string("person_in_charge")->nullable();

            $table->text('address')->nullable();
            $table->text('address_2')->nullable();
            $table->foreignId("country_id")->nullable();
            $table->foreignId("state_id")->nullable();
            $table->string("city")->nullable();
            $table->string("zip_code")->nullable();
            $table->text("website")->nullable();
            $table->text("tags")->nullable();
            $table->string("job_position")->nullable();
            $table->string("tax_id")->nullable();
            $table->string("image")->nullable();
            $table->string("notes")->nullable();
            $table->string("contact_source")->nullable();
            $table->string("batch_id")->nullable();
            $table->boolean("is_default_contact")->default(false);
            $table->unsignedBigInteger("zone_id")->nullable();

            $table->unsignedBigInteger('assign_to')->nullable();
            $table->foreign('assign_to')->references('id')->on('users');

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
        Schema::dropIfExists('contacts');
    }
}

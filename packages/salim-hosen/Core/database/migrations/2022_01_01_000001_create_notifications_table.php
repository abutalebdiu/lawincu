<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string("description");
            $table->string('url');
            $table->tinyInteger("notification_type")->default(0)->comment("0=message,1=reminder");
            $table->timestamp("send_at");
            $table->boolean("is_sent")->default(false);
            $table->tinyInteger("notified_by")->default(0)->comment("0=notification,1=email,2=both");
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
        Schema::dropIfExists('notifications');
    }
}

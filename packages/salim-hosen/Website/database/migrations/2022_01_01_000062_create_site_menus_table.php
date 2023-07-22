<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_menus', function (Blueprint $table) {
            $table->id();
            $table->foreignId("site_menu_id")->nullable()->constrained()->onDelete('cascade')->comment("Parent Menu ID");
            $table->string("name");
            $table->string("arabic_name");
            $table->string("icon")->nullable();
            $table->boolean("show_on_header")->default(false);
            $table->boolean("show_on_footer")->default(false);
            // $table->boolean("is_external_url")->default(false);
            // $table->boolean("open_in_new_tab")->default(false);
            $table->string("url")->nullable();
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
        Schema::dropIfExists('site_menus');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('name_en',50);
            $table->string('name_ar',50);
            $table->string('email',100);
            $table->string('logo_top',100);
            $table->string('logo_site',100);
            $table->tinyText('description')->nullable();
            $table->string('tags',200)->nullable();
            $table->tinyInteger('status')->default(0);
            $table->string('maintenance_message',250);
            $table->string('maintenance_photo',100);
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
        Schema::dropIfExists('settings');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('title_en',50);
            $table->string('title_ar',50);
            $table->string('short_description_en',255);
            $table->string('short_description_ar',255);
            $table->string('photo',100);
            $table->tinyInteger('active')->default('1');//1 active | 0 inactive
            $table->unsignedBigInteger('category_id');
            $table->string('deleted_by',50)->nullable();
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
        Schema::dropIfExists('sliders');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name_en',100);
            $table->string('name_ar',100);
            $table->string('slug',100);
            $table->text('discription_en')->nullable();
            $table->text('discription_ar')->nullable();
            $table->tinyInteger('status')->default(1); // 1 = active /0 = inactive
            $table->integer('price');
            $table->string('thumbnail',100);
            $table->integer('qantite');
            $table->unsignedBigInteger('category_id',false);
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
        Schema::dropIfExists('products');
    }
}

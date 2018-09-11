<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('type_id');
            $table->string('title');
            $table->string('slug');
            $table->text('image');
            $table->decimal('price', 60, 0);
            $table->decimal('discount', 60, 0);
            $table->text('description');
            $table->text('content');
            $table->integer('template_id');
            $table->text('template_title');
            $table->text('template_content');
            $table->tinyInteger('is_deleted')->default(0);
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

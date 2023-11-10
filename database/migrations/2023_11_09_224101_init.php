<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vat_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('languages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('email');
            $table->string('password');
            $table->string('image_path')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('description')->nullable();
            $table->integer('role_id')->unsigned();
            $table->foreign('role_id')->references('id')->on('roles');
            $table->timestamps();
            $table->softDeletes()->nullable();
        });
        Schema::create('stores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('vat_type_id')->unsigned();
            $table->foreign('vat_type_id')->references('id')->on('vat_types');
            $table->decimal('vat_value')->nullable();
            $table->decimal('shipping_cost')->nullable();
            $table->timestamps();
            $table->softDeletes()->nullable();
        });
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('store_id')->unsigned();
            $table->foreign('store_id')->references('id')->on('stores');
            $table->decimal('price');
            $table->timestamps();
            $table->softDeletes()->nullable();
        });
        Schema::create('product_names', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products');
            $table->integer('language_id')->unsigned();
            $table->foreign('language_id')->references('id')->on('languages');
            $table->string('name');
            $table->string('description')->nullable();
            $table->timestamps();
            $table->softDeletes()->nullable();
        });
        Schema::create('carts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->decimal('total_price')->nullable();
            $table->decimal('total_vat')->nullable();
            $table->timestamps();
            $table->softDeletes()->nullable();
        });
        Schema::create('cart_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products');
            $table->integer('cart_id')->unsigned();
            $table->foreign('cart_id')->references('id')->on('carts');
            $table->integer('quantity');
            $table->decimal('product_price');
            $table->integer('vat_type_id')->unsigned();
            $table->foreign('vat_type_id')->references('id')->on('vat_types');
            $table->decimal('vat_value')->nullable();
            $table->decimal('total')->nullable();
            $table->decimal('shipping_cost')->nullable();
            $table->timestamps();
            $table->softDeletes()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_products');
        Schema::dropIfExists('carts');
        Schema::dropIfExists('product_names');
        Schema::dropIfExists('products');
        Schema::dropIfExists('stores');
        Schema::dropIfExists('users');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('languages');
        Schema::dropIfExists('vat_types');
    }
};

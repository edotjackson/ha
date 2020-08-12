<?php
//New Code .edj


use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('days', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
        });

        Schema::create('cities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->float('lat');
            $table->float('lon');            
        });

        Schema::create('work', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');            
        });

        Schema::create('addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('addressLine1');
            $table->string('addressLine2')->nullable();
            $table->string('city');
            $table->string('stateAbbr');
            $table->string('postal');
        });

        Schema::create('businesses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('businessName');
            $table->unsignedBigInteger('address_id');
            $table->foreign('address_id')->references('id')->on('addresses');
        });


        Schema::create('businessHours', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('business_id');
            $table->foreign('business_id')->references('id')->on('businesses');
            $table->unsignedBigInteger('day_id');
            $table->foreign('day_id')->references('id')->on('days');
            $table->integer('openTime');
            $table->integer('closeTime');
        });

        Schema::create('operatingCities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('business_id');
            $table->foreign('business_id')->references('id')->on('businesses');
            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')->references('id')->on('cities');
        });


        Schema::create('workTypes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('business_id');
            $table->foreign('business_id')->references('id')->on('businesses');
            $table->unsignedBigInteger('work_id');
            $table->foreign('work_id')->references('id')->on('work');
        });

        
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('business_id');
            $table->foreign('business_id')->references('id')->on('businesses');
            $table->float('ratingScore');
            $table->string('customerComment');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reviews');
        Schema::drop('businessHours');
        Schema::drop('operatingCities');
        Schema::drop('workTypes');
        Schema::drop('businesses');
        Schema::drop('addresses');
        Schema::drop('days');
        Schema::drop('cities');
        Schema::drop('work');
    }
}

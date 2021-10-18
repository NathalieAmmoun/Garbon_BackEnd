<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->unsignedInteger('user_type'); // r for residential, b for businesses, c for collectors, s for SuperAdmin
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('device_token')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('industries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
			$table->softDeletes();
        });
        Schema::create('time_slots', function (Blueprint $table) {
            $table->id();
            $table->time('time_slot');
            $table->timestamps();
			$table->softDeletes();
        });
        Schema::create('user_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
			$table->softDeletes();
        });
        Schema::create('recyclables', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
			$table->softDeletes();
        });
        Schema::create('collector_recycles', function (Blueprint $table) {
            $table->unsignedInteger('collector_id');
            $table->unsignedInteger('recyclable_id');
            $table->timestamps();
			$table->softDeletes();
        });
        Schema::create('pickup_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedinteger('user_id');
            $table->unsignedinteger('address_id');
            $table->unsignedinteger('collector_id');
            $table->boolean('is_approved');
            $table->boolean('is_declined');
            $table->date("pickup_date");
            $table->time("pickup_time");
            $table->unsignedinteger("pickup_time_id");
            $table->timestamps();
			$table->softDeletes();
        });
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('city');
            $table->string('street');
            $table->string('bldg');
            $table->string('floor');
            $table->integer('user_id');
            $table->timestamps();
			$table->softDeletes();
        });
        
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('user_types');
        Schema::dropIfExists('industries');
        Schema::dropIfExists('recyclables');
        Schema::dropIfExists('pickup_requests');
        Schema::dropIfExists('time_slots');
        Schema::dropIfExists('collector_recycles');
    }
}

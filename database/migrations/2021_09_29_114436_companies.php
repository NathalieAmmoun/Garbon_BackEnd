<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Companies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedInteger("user_id");
            $table->unsignedInteger("industry_id");
            $table->text("description")->nullable();
            $table->timestamps();
			$table->softDeletes();
            
        });
        Schema::create('collectors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedInteger("user_id");
            $table->boolean('is_approved');
            $table->text("description")->nullable();
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
        Schema::dropIfExists('businesses');
        Schema::dropIfExists('collectors');
    }
}

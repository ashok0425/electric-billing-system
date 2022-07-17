<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFranchiseDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('franchise_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('state_id');
            $table->foreignId('district_id');
            $table->string('phone1');
            $table->string('phone2');
            $table->string('city');
            $table->string('address');
            $table->string('citizenship_no')->nullable();
            $table->string('citizenship_image')->nullable();
            $table->string('custom_filed_1')->nullable();
            $table->string('custom_filed_2')->nullable();
            $table->string('custom_filed_3')->nullable();
            $table->string('custom_filed_4')->nullable();
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
        Schema::dropIfExists('franchise_details');
    }
}

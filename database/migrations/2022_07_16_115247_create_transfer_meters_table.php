<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransferMetersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfer_meters', function (Blueprint $table) {
            $table->id();
            $table->integer('transfer_from');
            $table->integer('transfer_to');
            $table->float('total_unit');
            $table->integer('meter_id');
            $table->integer('transfer_amount');
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
        Schema::dropIfExists('transfer_meters');
    }
}

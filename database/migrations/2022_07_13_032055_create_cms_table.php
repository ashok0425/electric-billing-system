<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsTable extends Migration
{
    /**
  a   * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms', function (Blueprint $table) {
            $table->id();
            $table->string('meta_title');
            $table->text('meta_description');
            $table->string('keyword');
            $table->string('email1');
            $table->string('email2');
            $table->string('phone1');
            $table->string('phone2');
            $table->string('address1');
            $table->string('address2');

            $table->string('facebook');
            $table->string('instagram');
            $table->string('twitter');
            $table->string('linkedin');
            $table->string('youtube');
            $table->string('pinterest');
            $table->string('tiktok');
            $table->string('copy_right');
            $table->string('company_register_no');
            $table->string('logo');
            $table->string('fev');
            $table->longText('about');
            $table->longText('term');
            $table->longText('policy');










            
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
        Schema::dropIfExists('cms');
    }
}

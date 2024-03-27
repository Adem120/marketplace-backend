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
         schema::create('comptebancaires',function
         (Blueprint $table){
              $table->id();
              $table->string('nom');
              $table->string('numérocompte');
              $table->string('iban');
              $table->string('nomBanque');
              $table->string('codeswift');
                $table->string('document')->nullable();
              $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
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
        //
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengaduansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->unsignedInteger('user_id');
            $table->string('nohak')->nullable();
            $table->string('noberkas')->nullable();
            $table->string('tahun_berkas')->nullable();
            $table->string('alamat');
            $table->string('deskripsi');
            $table->tinyInteger('case_status')->default('1')->comment('1=new, 2=proses, 3=done');
            $table->tinyInteger('status')->default('1');
            $table->dateTime('process_at')->nullable()->comment('waktu proses');
            $table->dateTime('closed_at')->nullable()->comment('waktu selesai');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengaduans');
    }
}

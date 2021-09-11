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
            $table->string('nohak');
            $table->string('noberkas');
            $table->string('tahun_berkas');
            $table->string('alamat');
            $table->string('deskripsi');
            $table->tinyInteger('case_status')->default('1');
            $table->tinyInteger('status')->default('1');
            $table->dateTime('process_at')->nullable();
            $table->dateTime('closed_at')->nullable();
            
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

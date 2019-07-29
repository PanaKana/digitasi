<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    public function up()
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->string('nip', 50);
            $table->string('nama', 100);
            $table->string('jabatan', 100);
            $table->string('alamat', 150);
            $table->string('telepon', 13);
            $table->string('password', 50);
            $table->rememberToken();
        });
    }
    public function down()
    {
        Schema::dropIfExists('admin');
    }
}
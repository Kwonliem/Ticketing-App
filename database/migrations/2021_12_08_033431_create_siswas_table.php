<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->char('nisn', 16)->primary();
            $table->string('nama', 35);
            $table->string('email')->unique();
            $table->dateTime('email_verified_at')->nullable();
            $table->string('username', 25)->unique();
            $table->string('password')->nullable();
            $table->string('telp', 13)->nullable();
            $table->dateTime('telp_verified_at')->nullable();

            $table->string('provider_id')->nullable();
            $table->string('provider')->nullable();

            $table->rememberToken();
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
        Schema::dropIfExists('siswa');
    }
}

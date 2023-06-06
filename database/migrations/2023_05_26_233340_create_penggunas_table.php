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
        Schema::create('penggunas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kelas_id')->nullable();
            $table->string('nama');
            $table->enum('jk', ['L','P'])->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('profile')->default('/img/profile.png');
            $table->string('role')->default('user');
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
        Schema::dropIfExists('penggunas');
    }
};

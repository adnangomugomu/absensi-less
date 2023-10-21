<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('role_id')->nullable();
            $table->string('name');
            $table->string('username');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('foto')->nullable();
            $table->string('no_hp', 20)->unique()->nullable();
            $table->string('kode_prop', 10)->nullable();
            $table->string('kode_kab', 10)->nullable();
            $table->string('kode_kec', 10)->nullable();
            $table->string('kode_kel', 10)->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('role_id')->references('id')->on('role')
                ->onUpdate('cascade')->onDelete('cascade');

            // $table->foreign('kode_prop')->references('kode_wilayah')->on('ref_provinsi')
            //     ->onUpdate('cascade')->onDelete('cascade');

            // $table->foreign('kode_kab')->references('kode_wilayah')->on('ref_kabupaten')
            //     ->onUpdate('cascade')->onDelete('cascade');

            // $table->foreign('kode_kec')->references('kode_wilayah')->on('ref_kecamatan')
            //     ->onUpdate('cascade')->onDelete('cascade');

            // $table->foreign('kode_kel')->references('kode_wilayah')->on('ref_kelurahan')
            //     ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};

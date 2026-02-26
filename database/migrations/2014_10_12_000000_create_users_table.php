<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fakultas_id')->nullable()->constrained('fakultas')->onDelete('cascade');
            $table->foreignId('program_studi_id')->nullable()->constrained('program_studis')->onDelete('cascade');
            $table->string('role_as');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('nomor_induk');
            $table->tinyInteger('active')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
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
        Schema::dropIfExists('users');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('province_id')->default(32);
            $table->foreignId('regency_id')->default(3273);
            $table->foreignId('fakultas_id')->default(3);
            $table->foreignId('program_studi_id')->default(3);
            $table->string('company_name')->nullable();
            $table->string('company_address')->nullable();
            $table->string('position')->nullable();
            $table->text('domisili_address')->nullable();
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
        Schema::dropIfExists('locations');
    }
}

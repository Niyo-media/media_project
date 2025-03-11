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
        Schema::create('departments', function (Blueprint $table) {
            $table->string('department_code')->primary();
            $table->string('department_name');
            $table->string('campus_id');
            $table->timestamps();
    
            $table->foreign('campus_id')->references('campus_id')->on('campuses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departments');
    }
};

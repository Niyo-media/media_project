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
        Schema::create('projects', function (Blueprint $table) {
            $table->string('project_code')->primary();
            $table->string('project_name')->unique();
            $table->text('project_problem');
            $table->text('project_solution');
            $table->text('project_abstract');
            $table->text('project_dissertation');
            $table->text('project_source_code');
            $table->string('student_reg_number');
            $table->string('department_code');
            $table->string('faculty_code');
            $table->enum('status', ['Pending', 'Approved', 'Rejected'])->default('Pending');
            $table->text('comment')->nullable();
            $table->string('supervisor_email')->nullable();
            $table->timestamps();
    
            $table->foreign('department_code')->references('department_code')->on('departments')->onDelete('cascade');
            $table->foreign('faculty_code')->references('faculty_code')->on('faculties')->onDelete('cascade');
            $table->foreign('student_reg_number')->references('student_reg_number')->on('students')->onDelete('cascade');
            $table->foreign('supervisor_email')->references('email')->on('supervisors')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
};

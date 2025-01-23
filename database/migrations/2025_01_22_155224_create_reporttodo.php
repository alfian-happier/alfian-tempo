<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReporttodo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_todo', function (Blueprint $table) {
            $table->id('reporttodo_id');
            $table->uuid('reporttodo_uuid')->unique();
            $table->uuid('uuid'); // Foreign key to users table
            $table->string('reporttodo_title');
            $table->text('reporttodo_description');
            $table->text('reporttodo_status');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('uuid')->references('uuid')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('report_todo');
    }
}

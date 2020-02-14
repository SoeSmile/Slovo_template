<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('Имя проекта');
            $table->uuid('user_id')->comment('Владелец');
            $table->text('note')->nullable()->comment('Описание. Замечаение.');
            $table->string('url')->nullable()->comment('Сайт проекта');
            $table->jsonb('data')->nullable()->comment('Доп.данные. Резерв');
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
        Schema::dropIfExists('projects');
    }
}

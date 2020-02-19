<?php
declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('roles', static function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type')->unique()->comment('Тип роли.Коротко для перевода');
            $table->timestamps();
        });

        DB::table('roles')->insert([
            [
                'type' => 'admin',
            ],
            [
                'type' => 'new',
            ],
            [
                'type' => 'client',
            ],
        ]);
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
}

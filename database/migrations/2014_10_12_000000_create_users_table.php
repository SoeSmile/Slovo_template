<?php
declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Ramsey\Uuid\Uuid;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * @throws Exception
     */
    public function up(): void
    {
        Schema::create('users', static function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('login')->comment('Логин');
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('confirm')->default(false)->comment('Подтверждён');
            $table->string('confirm_key')->nullable()->unique()->comment('Ключ подтверждения');
            $table->integer('time_zone')->default(3)->comment('Временная зона');
            $table->string('role_type')->default('new')->comment('Роль');
            $table->text('note')->nullable()->comment('Комментарий');
            $table->timestamps();
        });

        DB::table('users')->insert([
            'id'         => 'fc2150e4-5127-4add-bad0-2394add2c060',
            'login'      => 'Admin',
            'email'      => 'admin@test.ru',
            'password'   => bcrypt('123456'),
            'role_type'  => 'admin',
            'confirm'    => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
}

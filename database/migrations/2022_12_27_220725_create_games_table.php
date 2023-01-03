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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->enum('color',['white', 'black']);
            $table->enum('play_with',
            ['computer',
            'mySelf',
            'friend',
            'online'
            ]);
            $table->enum('time',
            [
                '1 Minute',
                '3 Minutes',
                '5 Minutes',
                '10 Minutes',
                '30 Minutes',
                '90 Minutes'
            ]);
            $table->enum('level',
            [
                'easy',
                'moderate',
                'difficult',
                'master'
            ])->nullable();
            $table->string('from');
            $table->string('to')->nullable();
            $table->tinyInteger('is_win')->nullable();
            $table->longText('moves')->nullable();
            $table->longText('message')->nullable();
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
        Schema::dropIfExists('game_with_computers');
    }
};

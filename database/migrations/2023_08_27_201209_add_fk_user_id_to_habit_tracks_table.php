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
        Schema::table('habit_tracks', function (Blueprint $table) {
            $table->unsignedBigInteger('fk_user_id')->nullable();
            $table->foreign('fk_user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('no action')
                ->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('habit_tracks', function (Blueprint $table) {
            $table->dropColumn('fk_user_id');
        });
    }
};

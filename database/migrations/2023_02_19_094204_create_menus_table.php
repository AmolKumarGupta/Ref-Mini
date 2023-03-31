<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fk_section_id')->nullable();
            $table->string('name');
            $table->text('url')->nullable();
            $table->string('icon')->nullable();
            $table->integer('order')->default('0');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('fk_section_id')->references('id')->on('menu_sections');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
};

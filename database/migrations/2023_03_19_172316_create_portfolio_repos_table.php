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
        Schema::create('portfolio_repos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pid');
            $table->string('name');
            $table->unsignedInteger('sort_by')->default('100000');
            $table->tinyInteger('display')->default(0)->comment('show in portfolio');
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
        Schema::dropIfExists('portfolio_repos');
    }
};

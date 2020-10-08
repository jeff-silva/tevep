<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_migration', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('category_id')->nullable();
            $table->string('active')->nullable();
            $table->string('name')->nullable();
            $table->string('resume')->nullable();
            $table->string('photo')->nullable();
            $table->string('cover')->nullable();
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
        Schema::dropIfExists('store_migration');
    }
}

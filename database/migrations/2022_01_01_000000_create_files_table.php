<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->nullable();
            $table->string('name')->nullable();
            $table->string('folder')->nullable();
            $table->integer('size')->length(11)->nullable();
            $table->string('mime')->length(100)->nullable();
            $table->string('type')->length(20)->nullable();
            $table->string('ext')->length(5)->nullable();
            $table->integer('is_text')->length(1)->nullable();
            $table->string('url')->nullable();
            $table->longText('content')->nullable();
            $table->timestamps();
            $table->dateTime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}

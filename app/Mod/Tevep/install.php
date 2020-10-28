<?php

if (! Schema::hasTable('teveps')) {
    Schema::create('teveps', function($table) {
        $table->increments('id');
    });
}


Schema::table('teveps', function($table) {
    if (! Schema::hasColumn('teveps', 'user_id')) {
        $table->integer('user_id')->nullable();
    }
    
    if (! Schema::hasColumn('teveps', 'title')) {
        $table->string('title')->nullable();
    }

    if (! Schema::hasColumn('teveps', 'divisor')) {
        $table->string('divisor')->nullable();
    }
    
    if (! Schema::hasColumn('teveps', 'nodes')) {
        $table->text('nodes')->nullable();
    }
    
    if (! Schema::hasColumn('teveps', 'date_start')) {
        $table->dateTime('date_start')->nullable();
    }
    
    if (! Schema::hasColumn('teveps', 'date_final')) {
        $table->dateTime('date_final')->nullable();
    }
    
    if (! Schema::hasColumn('teveps', 'deleted_at')) {
        $table->dateTime('deleted_at')->nullable();
    }
});
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

/*
 * Este arquivo é gerado automaticamente, Não edite-o diretamente.
 * Para gerar este arquivo execute o comando "php artisan app:make-seed".
 * Este seeder é executado através do comando "php artisan app:deploy".
 * Arquivo gerado pela última vez em 19/02/2021 às 02:47:25
*/
class AutoSeeder extends Seeder
{

	public function run() {

		$schema = [
			'emails' => [
				'id' => function($table) { $table->id(); },
				'created_at' => function($table) { $table->timestamps(); },
				'updated_at' => function($table) { /* Gerado pela função timestamps() */ },
				'to' => function($table) { $table->text('to')->nullable(); },
				'subject' => function($table) { $table->text('subject')->nullable(); },
				'body' => function($table) { $table->text('body')->nullable(); },
			],
			'migrations' => [
				'id' => function($table) { $table->id(); },
				'migration' => function($table) { $table->string('migration', 255); },
				'batch' => function($table) { $table->integer('batch'); },
			],
			'password_resets' => [
				'email' => function($table) { $table->string('email', 255); },
				'token' => function($table) { $table->string('token', 255); },
				'created_at' => function($table) { $table->timestamps(); },
			],
			'teveps' => [
				'id' => function($table) { $table->id(); },
				'user_id' => function($table) { $table->integer('user_id')->nullable(); },
				'title' => function($table) { $table->string('title', 255)->nullable(); },
				'date_start' => function($table) { $table->text('date_start')->nullable(); },
				'date_final' => function($table) { $table->text('date_final')->nullable(); },
				'nodes' => function($table) { $table->text('nodes')->nullable(); },
				'pingpongs' => function($table) { $table->text('pingpongs')->nullable(); },
				'created_at' => function($table) { $table->timestamps(); },
				'updated_at' => function($table) { /* Gerado pela função timestamps() */ },
			],
			'user_notifications' => [
				'id' => function($table) { $table->id(); },
				'created_at' => function($table) { $table->timestamps(); },
				'updated_at' => function($table) { /* Gerado pela função timestamps() */ },
				'user_id' => function($table) { $table->integer('user_id')->nullable(); },
				'title' => function($table) { $table->string('title', 255)->nullable(); },
				'body' => function($table) { $table->text('body')->nullable(); },
				'image' => function($table) { $table->text('image')->nullable(); },
				'seen' => function($table) { $table->integer('seen')->nullable(); },
			],
			'users' => [
				'id' => function($table) { $table->id(); },
				'created_at' => function($table) { $table->timestamps(); },
				'updated_at' => function($table) { /* Gerado pela função timestamps() */ },
				'name' => function($table) { $table->string('name', 255)->nullable(); },
				'email' => function($table) { $table->string('email', 255)->nullable(); },
				'email_verified_at' => function($table) { $table->text('email_verified_at')->nullable(); },
				'password' => function($table) { $table->string('password', 255); },
				'remember_token' => function($table) { $table->string('remember_token', 100)->nullable(); },
				'meta' => function($table) { $table->text('meta')->nullable(); },
				'group' => function($table) { $table->string('group', 255)->nullable(); },
			],
		];

		foreach($schema as $table_name=>$columns) {
			if (\Schema::hasTable($table_name)) {
				\Schema::table($table_name, function($table) use($table_name, $columns) {
					foreach($columns as $column=>$callback) {
						if (\Schema::hasColumn($table_name, $column)) continue;
						call_user_func($callback, $table);
					}
				});
			}
			else {
				\Schema::create($table_name, function($table) use($columns) {
					foreach($columns as $column=>$callback) {
						call_user_func($callback, $table);
					}
				});
			}
		}
	}
}

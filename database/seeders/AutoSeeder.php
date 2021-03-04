<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

/*
 * Este arquivo é gerado automaticamente, Não edite-o diretamente.
 * Para gerar este arquivo execute o comando "php artisan app:make-seed".
 * O banco de dados contido aqui é criado ao executar o comando "php artisan app:deploy".
 * Arquivo gerado pela última vez em 04/03/2021 às 06:21:11
*/

class AutoSeeder extends Seeder
{

	public function run() {

		$schema = [
			'email_sents' => [
				'comment' => '',
				'fields' => [
					'id' => function($table) { $table->id(); },
					'to' => function($table) { $table->text('to')->nullable(); },
					'subject' => function($table) { $table->text('subject')->nullable(); },
					'body' => function($table) { $table->text('body')->nullable(); },
					'created_at' => function($table) { $table->nullableTimestamps(); },
					'updated_at' => function($table) { /* Gerado pela função nullableTimestamps() dentro de created_at */; },
				],
			],
			'emails' => [
				'comment' => '',
				'fields' => [
					'id' => function($table) { $table->id(); },
					'name' => function($table) { $table->string('name', 255)->nullable(); },
					'subject' => function($table) { $table->string('subject', 255)->nullable(); },
					'body' => function($table) { $table->text('body')->nullable(); },
					'params' => function($table) { $table->text('params')->nullable(); },
					'updated_at' => function($table) { /* Gerado pela função nullableTimestamps() dentro de created_at */; },
					'created_at' => function($table) { $table->nullableTimestamps(); },
				],
			],
			'migrations' => [
				'comment' => '',
				'fields' => [
					'id' => function($table) { $table->id(); },
					'migration' => function($table) { $table->string('migration', 255); },
					'batch' => function($table) { $table->integer('batch'); },
				],
			],
			'password_resets' => [
				'comment' => '',
				'fields' => [
					'email' => function($table) { $table->string('email', 255); },
					'token' => function($table) { $table->string('token', 255); },
					'created_at' => function($table) { $table->nullableTimestamps(); },
				],
			],
			'settings' => [
				'comment' => '',
				'fields' => [
					'id' => function($table) { $table->id(); },
					'name' => function($table) { $table->string('name', 255)->nullable(); },
					'value' => function($table) { $table->text('value')->nullable(); },
					'value_default' => function($table) { $table->text('value_default')->nullable(); },
					'description' => function($table) { $table->string('description', 255)->nullable(); },
				],
			],
			'tevep_invites' => [
				'comment' => '',
				'fields' => [
					'id' => function($table) { $table->id(); },
					'tevep_id' => function($table) { $table->integer('tevep_id')->nullable(); },
					'tevep_node' => function($table) { $table->string('tevep_node', 50)->nullable(); },
					'user_id' => function($table) { $table->integer('user_id')->nullable(); },
					/* status: accepted|rejected */
					'status' => function($table) { $table->string('status', 50)->comment('accepted|rejected')->nullable(); },
					'created_at' => function($table) { $table->nullableTimestamps(); },
					'updated_at' => function($table) { /* Gerado pela função nullableTimestamps() dentro de created_at */; },
				],
			],
			'teveps' => [
				'comment' => '',
				'fields' => [
					'id' => function($table) { $table->id(); },
					'user_id' => function($table) { $table->integer('user_id')->nullable(); },
					'title' => function($table) { $table->string('title', 255)->nullable(); },
					'date_start' => function($table) { $table->text('date_start')->nullable(); },
					'date_final' => function($table) { $table->text('date_final')->nullable(); },
					'nodes' => function($table) { $table->text('nodes')->nullable(); },
					'pingpongs' => function($table) { $table->text('pingpongs')->nullable(); },
					'created_at' => function($table) { $table->nullableTimestamps(); },
					'updated_at' => function($table) { /* Gerado pela função nullableTimestamps() dentro de created_at */; },
				],
			],
			'user_notifications' => [
				'comment' => '',
				'fields' => [
					'id' => function($table) { $table->id(); },
					'user_id' => function($table) { $table->integer('user_id')->nullable(); },
					'title' => function($table) { $table->string('title', 255)->nullable(); },
					'body' => function($table) { $table->text('body')->nullable(); },
					'image' => function($table) { $table->text('image')->nullable(); },
					'seen' => function($table) { $table->integer('seen')->nullable(); },
					'created_at' => function($table) { $table->nullableTimestamps(); },
					'updated_at' => function($table) { /* Gerado pela função nullableTimestamps() dentro de created_at */; },
				],
			],
			'users' => [
				'comment' => '',
				'fields' => [
					'id' => function($table) { $table->id(); },
					'created_at' => function($table) { $table->nullableTimestamps(); },
					'updated_at' => function($table) { /* Gerado pela função nullableTimestamps() dentro de created_at */; },
					'name' => function($table) { $table->string('name', 255)->nullable(); },
					'email' => function($table) { $table->string('email', 255)->nullable(); },
					'email_verified_at' => function($table) { $table->text('email_verified_at')->nullable(); },
					'password' => function($table) { $table->string('password', 255); },
					'remember_token' => function($table) { $table->string('remember_token', 100)->nullable(); },
					'whatsapp' => function($table) { $table->string('whatsapp', 20)->nullable(); },
					'meta' => function($table) { $table->text('meta')->nullable(); },
					'group' => function($table) { $table->string('group', 255)->nullable(); },
				],
			],
		];

		foreach($schema as $table_name=>$table_data) {
			if (\Schema::hasTable($table_name)) {
				\Schema::table($table_name, function($table) use($table_name, $table_data) {
					foreach($table_data['fields'] as $column=>$callback) {
						if (\Schema::hasColumn($table_name, $column)) continue;
						call_user_func($callback, $table);
					}
				});
				\DB::statement("ALTER TABLE `$table_name` comment '{$table_data['comment']}'");
			}
			else {
				\Schema::create($table_name, function($table) use($table_name, $table_data) {
					foreach($table_data['fields'] as $column=>$callback) {
						call_user_func($callback, $table);
					}
				});
				\DB::statement("ALTER TABLE `$table_name` comment '{$table_data['comment']}'");
			}
		}
	}
}

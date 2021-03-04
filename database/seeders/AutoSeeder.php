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
 * Arquivo gerado pela última vez em 04/03/2021 às 06:17:58
*/

class AutoSeeder extends Seeder
{

	public function run() {

		$schema = [
			'email_sents' => [
				'comment' => '',
				'fields' => [
					'id' => function($table) { $table->id(); },
					'to' => function($table) { $table->nullable()->text('to'); },
					'subject' => function($table) { $table->nullable()->text('subject'); },
					'body' => function($table) { $table->nullable()->text('body'); },
					'created_at' => function($table) { $table->nullable()->timestamps(); },
					'updated_at' => function($table) { /* Gerado pela função timestamps() dentro de created_at */; },
				],
			],
			'emails' => [
				'comment' => '',
				'fields' => [
					'id' => function($table) { $table->id(); },
					'name' => function($table) { $table->nullable()->string('name', 255); },
					'subject' => function($table) { $table->nullable()->string('subject', 255); },
					'body' => function($table) { $table->nullable()->text('body'); },
					'params' => function($table) { $table->nullable()->text('params'); },
					'updated_at' => function($table) { /* Gerado pela função timestamps() dentro de created_at */; },
					'created_at' => function($table) { $table->nullable()->timestamps(); },
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
					'created_at' => function($table) { $table->nullable()->timestamps(); },
				],
			],
			'settings' => [
				'comment' => '',
				'fields' => [
					'id' => function($table) { $table->id(); },
					'name' => function($table) { $table->nullable()->string('name', 255); },
					'value' => function($table) { $table->nullable()->text('value'); },
					'value_default' => function($table) { $table->nullable()->text('value_default'); },
					'description' => function($table) { $table->nullable()->string('description', 255); },
				],
			],
			'tevep_invites' => [
				'comment' => '',
				'fields' => [
					'id' => function($table) { $table->id(); },
					'tevep_id' => function($table) { $table->nullable()->integer('tevep_id'); },
					'tevep_node' => function($table) { $table->nullable()->string('tevep_node', 50); },
					'user_id' => function($table) { $table->nullable()->integer('user_id'); },
					/* status: accepted|rejected */
					'status' => function($table) { $table->nullable()->string('status', 50)->comment('accepted|rejected'); },
					'created_at' => function($table) { $table->nullable()->timestamps(); },
					'updated_at' => function($table) { /* Gerado pela função timestamps() dentro de created_at */; },
				],
			],
			'teveps' => [
				'comment' => '',
				'fields' => [
					'id' => function($table) { $table->id(); },
					'user_id' => function($table) { $table->nullable()->integer('user_id'); },
					'title' => function($table) { $table->nullable()->string('title', 255); },
					'date_start' => function($table) { $table->nullable()->text('date_start'); },
					'date_final' => function($table) { $table->nullable()->text('date_final'); },
					'nodes' => function($table) { $table->nullable()->text('nodes'); },
					'pingpongs' => function($table) { $table->nullable()->text('pingpongs'); },
					'created_at' => function($table) { $table->nullable()->timestamps(); },
					'updated_at' => function($table) { /* Gerado pela função timestamps() dentro de created_at */; },
				],
			],
			'user_notifications' => [
				'comment' => '',
				'fields' => [
					'id' => function($table) { $table->id(); },
					'user_id' => function($table) { $table->nullable()->integer('user_id'); },
					'title' => function($table) { $table->nullable()->string('title', 255); },
					'body' => function($table) { $table->nullable()->text('body'); },
					'image' => function($table) { $table->nullable()->text('image'); },
					'seen' => function($table) { $table->nullable()->integer('seen'); },
					'created_at' => function($table) { $table->nullable()->timestamps(); },
					'updated_at' => function($table) { /* Gerado pela função timestamps() dentro de created_at */; },
				],
			],
			'users' => [
				'comment' => '',
				'fields' => [
					'id' => function($table) { $table->id(); },
					'created_at' => function($table) { $table->nullable()->timestamps(); },
					'updated_at' => function($table) { /* Gerado pela função timestamps() dentro de created_at */; },
					'name' => function($table) { $table->nullable()->string('name', 255); },
					'email' => function($table) { $table->nullable()->string('email', 255); },
					'email_verified_at' => function($table) { $table->nullable()->text('email_verified_at'); },
					'password' => function($table) { $table->string('password', 255); },
					'remember_token' => function($table) { $table->nullable()->string('remember_token', 100); },
					'whatsapp' => function($table) { $table->nullable()->string('whatsapp', 20); },
					'meta' => function($table) { $table->nullable()->text('meta'); },
					'group' => function($table) { $table->nullable()->string('group', 255); },
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

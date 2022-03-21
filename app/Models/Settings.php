<?php

namespace App\Models;

class Settings extends \Illuminate\Database\Eloquent\Model
{
	use \Illuminate\Database\Eloquent\Factories\HasFactory;
	use \App\Traits\Model;

	protected $table = 'settings';
	protected $fillable = ['id', 'name', 'value', 'created_at', 'updated_at'];

	public static $settingsKeys = [
		'app.name',
		'app.timezone',
		'app.locale',
		'jwt.ttl',
		'mail.default',
		'mail.mailers.smtp.host',
		'mail.mailers.smtp.port',
		'mail.mailers.smtp.username',
		'mail.mailers.smtp.password',
		'mail.from.address',
		'mail.from.name',
		'app_model_files.storage_type',
		'app_model_files.max_upload_size',
	];


	public static function saveAll($settings = [])
	{
		$return = [];

		foreach(self::$settingsKeys as $key) {
			$value = isset($settings[ $key ])? $settings[ $key ]: false;

			$testkey = str_replace('.', '_', $key);
			if (isset($settings[ $testkey ])) {
				$value = $settings[ $testkey ];
			}

			Settings::updateOrCreate(['name' => $key], ['value' => $value]);
			$return[ $key ] = $value;
		}

		return $return;
	}


	public static function getAll()
	{
		$settings = self::select(['name', 'value'])->whereIn('name', self::$settingsKeys)->get()->pluck('value', 'name')->toArray();

		$return = [];
		foreach(self::$settingsKeys as $key) {
			$return[ $key ] = isset($settings[$key])? $settings[$key]: config($key);
		}

		return $return;
	}
}

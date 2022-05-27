<?php

namespace App\Models;

class Settings extends \Illuminate\Database\Eloquent\Model
{
	use \Illuminate\Database\Eloquent\Factories\HasFactory;
	use \App\Traits\Model;

	protected $singular = 'Configuração';
	protected $plural = 'Configurações';
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
		'app_models_files.storage_type',
		'app_models_files.max_upload_size',
	];


	public function schemaFields()
	{
		return [
			'id' => 'default',
			'name' => 'VARCHAR(255) NULL DEFAULT NULL',
			'value' => 'TEXT NULL DEFAULT NULL',
			'created_at' => 'default',
			'updated_at' => 'default',
		];
	}


	public static function getSettingsKeys($showAll = false)
	{
		$front = config('app_models_settings.front', []);
		if (!$showAll) return $front;
		$back = config('app_models_settings.back', []);
		return array_merge($front, $back);
	}


	public static function saveAll($settings = [])
	{
		$return = [];

		foreach(self::getSettingsKeys(true) as $key) {
			$value = isset($settings[ $key ])? $settings[ $key ]: '';

			$testkey = str_replace('.', '_', $key);
			if (isset($settings[ $testkey ])) {
				$value = $settings[ $testkey ];
			}

			Settings::updateOrCreate(['name' => $key], ['value' => $value]);
			$return[ $key ] = $value;
		}

		return $return;
	}


	public static function getAll($showAll = false)
	{
		$settingsKeys = self::getSettingsKeys($showAll);

		$settings = self::select(['name', 'value'])
			->whereIn('name', $settingsKeys)
			->get()->pluck('value', 'name')->toArray();

		$return = [];
		foreach($settingsKeys as $key) {
			$return[ $key ] = isset($settings[$key])? $settings[$key]: config($key);
		}

		return $return;
	}


	static function getValue($name, $default = null)
	{
		$set = static::firstOrNew(['name' => $name]);

		if ($set->value===null) {
			if (is_callable($default)) {
				$set->value = call_user_func($default);
			}
			else {
				$set->value = $default;
			}
		}

		return $set->value;
	}


	static function setValue($name, $value)
	{
		$set = static::firstOrNew(['name' => $name]);
		$set->value = $value;
		$set->save();
		return $set;
	}
}

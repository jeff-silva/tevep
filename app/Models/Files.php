<?php

namespace App\Models;

class Files extends \Illuminate\Database\Eloquent\Model
{
	use \Illuminate\Database\Eloquent\Factories\HasFactory;
	use \App\Traits\Model;

	protected $table = 'files';

	protected $fillable = [
		'id',
		'slug',
		'name',
		'folder',
		'size',
		'mime',
		'type',
		'ext',
		'is_text',
		'url',
		'content',
		'created_at',
		'updated_at',
		'deleted_at',
	];

	protected $hidden = [
	    'content',
	];


	public function toOutput()
	{
		$this->slug = $this->slug? $this->slug: \Str::slug($this->name .'-'. uniqid());
		$this->name = $this->name? $this->name: $this->slug;
		$this->folder = trim($this->folder, '/');
		$this->size = $this->size? $this->size: 0;
		$this->mime = $this->mime? $this->mime: null;
		$this->type = $this->type? $this->type: null;
		$this->ext = $this->ext? $this->ext: null;
		$this->is_text = $this->is_text? $this->is_text: null;
		$this->url = $this->url? $this->url: null;

		if ($file = request()->file('content')) {
			$storage_type = config('app_model_files.storage_type');

			$this->size = $file->getSize();
			$this->mime = strtolower($file->getClientMimeType());
			$this->type = preg_replace('/\/.+/', '', $this->mime);
			$this->ext = strtolower($file->getClientOriginalExtension());
			$this->is_text = ($this->type=='text' OR in_array($this->ext, ['svg', 'csv']))? 1: null;
			$this->url = $storage_type=='database'? "/api/files/view/{$this->slug}.{$this->ext}": $this->url;
			$this->url = $storage_type=='file'? "/uploads/{$this->slug}.{$this->ext}": $this->url;
		}
	}


	public function validationRules()
	{
		return [];
	}


	public function searchParams()
	{
		return [
			'folder' => '',
		];
	}


	public function searchQuery($query, $params)
	{
		if ($params->folder) {
			$query->where(function($q) use($params) {
				$q->where('folder', $params->folder);
				$q->orWhere('folder', 'like', "{$params->folder}%");
			});
		}

		// dd($query->toRawSql());

		return $query;
	}


	public static function folders()
	{
		$files = self::query()
			->select(['folder'])
			->notEmpty(['folder'])
			->orderBy('folder', 'asc')
			->groupBy('folder')
			->get();

		$folders = [''];

		foreach($files as $file) {
			$folderpath = [];
			foreach(explode("/", $file->folder) as $folder) {
				$folderpath[] = $folder;
				$folders[] = implode("/", $folderpath);
			}
		}

		$folders = array_unique($folders);
		$folders = array_values($folders);

		return array_map(function($folder) {
			return [
				'name' => $folder,
			];
		}, $folders);
	}


	public function user()
	{
		return $this->belongsTo(App\Models\User::class, 'photo_id', 'id');
	}
}

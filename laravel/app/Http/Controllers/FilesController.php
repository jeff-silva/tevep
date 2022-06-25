<?php

namespace App\Http\Controllers;

class FilesController extends Controller
{
	public function boot()
	{
		$this->model = new \App\Models\Files;

		$this->middleware('auth:api', [
			'except' => ['view'],
		]);

		$this->defaultRoutes();

		// GET: api/files/view/file-name-image.jpg
		$this->route('get', '/view/{slug}.{ext}', 'view');
	}

	
	public function onDashboard($data)
	{
		$data['filesTotal'] = \App\Models\Files::select(['id'])->count('size') ?? 0;
		$data['filesTotalSize'] = \App\Models\Files::select(['size'])->get()->sum('size') ?? 0;
		$data['filesFormats'] = \App\Models\Files::query()
			->select('files.ext', \DB::raw('count(files.id) as total'))
			->groupBy('files.ext')
			->get()
			->map(function($item) { return [
				'ext' => ($item->ext? $item->ext: 'Indefinido'),
				'total' => $item->total,
			]; });
		return $data;
	}

	
	public function view($slug, $ext=false) {
		$file = \App\Models\Files::where('slug', $slug)->first();

		if (! $file) return '';

		if (\Str::startsWith($file->content, 'data:')) {
			$content = explode(',', $file->content);
			$file->content = base64_decode($content[1]);
		}

		return response($file->content)->withHeaders([
			'Content-Type' => $file->mime,
			// 'Cache-Control' => 'no-store, no-cache',
			// 'Content-Disposition' => 'attachment; filename="logs.txt',
		]);
	}
}

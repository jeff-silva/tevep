<?php

namespace App\Http\Controllers;

class FilesController extends Controller
{
	public function __construct()
	{
		$this->model = new \App\Models\Files;

		$this->middleware('auth:api', [
			'except' => ['view'],
		]);

		$this->defaultRoutes();

		// GET: api/files/view/file-name-image.jpg
		$this->route('get', '/view/{slug}.{ext}', 'view');
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
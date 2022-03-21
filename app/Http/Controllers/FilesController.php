<?php

namespace App\Http\Controllers;

class FilesController extends Controller
{
	public function __construct()
	{
		$this->model = new \App\Models\Files;

		$this->middleware('auth:api', [
			'except' => ['search', 'find', 'view'],
		]);

		$this->defaultRoutes();
		$this->route('get', '/view/{slug}.{ext}', '@view');
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
	

	public function search()
    {
        $search = $this->model->search()->paginate(request('per_page', 15))->toArray();
		$search['folders'] = \App\Models\Files::folders();
		return $search;
    }
}

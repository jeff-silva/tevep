<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppController extends Controller
{
    /**
     * Lista todas as rotas de API
     */
    public function getRoutes() {
        $routes = [];

        foreach(\Route::getRoutes() as $route) {
            foreach($route->methods() as $method) {
                if (in_array($method, ['HEAD'])) continue;
                $routes[] = [
                    'method' => $method,
                    'uri' => $route->uri(),
                ];
            }
        }

        return $routes;
    }


    /**
     * Upload geral
     */
    public function getUpload($request) {
        $folder = $request->input('folder', 'uploads');
        $file = $request->file('file');
        
        $info = pathinfo($file->getClientOriginalName());
        $filename = \Str::slug($info['filename'], '-') .'.'. $info['extension'];
        $path = $file->storeAs($folder, $filename, 'public');

        return [
            'path' => "storage/{$path}",
            'name' => $filename,
            'ext' => $info['extension'],
            'size' => Storage::disk('public')->size($path),
            'mime' => Storage::disk('public')->getMimeType($path),
            'url' => Storage::disk('public')->url($path),
        ];
    }

    public function getCron() {
        return \Artisan::call('schedule:run');
    }

    public function getDashboard() {
        $data = [];

        $data['counts'] = [];

        $data['counts'][] = [
            'title' => 'Projetos criados',
            'total' => \App\Models\Tevep::count(),
        ];

        $data['counts'][] = [
            'title' => 'Usuários cadastrados',
            'total' => \App\Models\User::count(),
        ];

        return $data;
    }
}
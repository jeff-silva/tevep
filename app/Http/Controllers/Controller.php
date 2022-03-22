<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    

    public function route($methods, $path, $callback)
    {   
        $prefix = (new \ReflectionClass($this))->getShortName();
        $prefix = (string) \Str::of(str_replace('Controller', '', $prefix))->studly()->kebab();
        $path = $prefix .'/'. trim($path, '/');

        return \Illuminate\Support\Facades\Route::match($methods, $path, [get_class($this), $callback])
            ->middleware(['permission'])
            ->name($prefix .'-'. (string) \Str::of($callback)->kebab());
    }


    // Gera automaticamente os métodos abaixo para todos os controllers:
    // search, find, save, valid, delete, restore, clone, import, export
    public function defaultRoutes($params=[])
    {
        $params = (object) array_merge([
            'except' => [],
        ], $params);

        $name = (new \ReflectionClass($this->model))->getShortName();
        $prefix = (string) \Str::of($name)->studly()->kebab();

        if (! in_array('search', $params->except)) {
            $this->route('get', "/search", 'search');
        }

        if (! in_array('find', $params->except)) {
            $this->route('get', "/find/{id}", 'find');
        }

        if (! in_array('save', $params->except)) {
            $this->route('post', "/save", 'save');
        }

        if (! in_array('valid', $params->except)) {
            $this->route('post', "/valid", 'valid');
        }

        if (! in_array('delete', $params->except)) {
            $this->route('post', "/delete", 'delete');
        }

        if (! in_array('restore', $params->except)) {
            $this->route('post', "/restore", 'restore');
        }

        if (! in_array('clone', $params->except)) {
            $this->route('get', "/clone/{id}", 'clone');
        }

        if (! in_array('import', $params->except)) {
            $this->route('post', "/import", 'import');
        }

        if (! in_array('export', $params->except)) {
            $this->route('get', "/export", 'export');
        }
    }


    public function search()
    {
        return $this->model->search()->paginate(request('per_page', 15));
    }


    public function find($id)
    {
        return $this->model->whereDeleted(false)->findIdOrSlug($id);
    }


    public function save()
    {
        return $this->model->updateOrCreate(['id' => request('id')], request()->all());
    }


    public function valid()
    {
        return ['valid'];
    }


    public function delete()
    {
        return $this->model->search()->deleteAll();
    }


    public function restore()
    {
        return $this->model->search()->restoreAll();
    }


    public function clone($id)
    {
        return $this->model->clone($id, request()->all());
    }


    public function import()
    {
        return ['import'];
    }


    public function export()
    {
        return $this->model->search()->export();
    }
}

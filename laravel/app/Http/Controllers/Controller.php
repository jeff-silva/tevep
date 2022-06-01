<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $generatedRoutes = [];

    public function getGeneratedRoutes()
    {
        return $this->generatedRoutes;
    }
    

    public function route($methods, $path, $callback, $info=[])
    {
        $methods = is_array($methods)? $methods: [$methods];
        $prefix = (new \ReflectionClass($this))->getShortName();
        $prefix = (string) \Str::of(str_replace('Controller', '', $prefix))->studly()->kebab();
        $path = $prefix .'/'. trim($path, '/');
        $name = $prefix .'-'. (string) \Str::of($callback)->kebab();

        $is_public = !empty(array_filter($this->getMiddleware(), function($middle) use($callback) {
            $except = (isset($middle['options']) AND isset($middle['options']['except']))? $middle['options']['except']: [];
            $except = is_array($except)? $except: [];
            if (empty($except)) return false;
            return in_array($callback, $middle['options']['except']);
        }));

        $this->generatedRoutes[] = (object) array_merge([
            'description' => '',
            'query' => false,
            'body' => false,
            'path' => false,
        ], $info, [
            'prefix' => $prefix,
            'path' => $path,
            'name' => $name,
            'methods' => $methods,
            'is_public' => $is_public,
        ]);

        return \Illuminate\Support\Facades\Route
            ::match($methods, $path, [get_class($this), $callback])
            ->middleware(['permission'])->name($name);
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
        $body = collect(array_flip($this->model->getFillable()))->map(function($value, $key) { return ''; })->toArray();

        if (! in_array('search', $params->except)) {
            $this->route('get', "/search", 'search', [
                'description' => 'Busca',
                'query' => $this->model->searchParamsDefault(),
            ]);
        }

        if (! in_array('find', $params->except)) {
            $this->route('get', "/find/{id}", 'find', [
                'description' => 'Encontrar por ID',
                'path' => ['id' => ''],
            ]);
        }

        if (! in_array('save', $params->except)) {
            $this->route('post', "/save", 'save', [
                'description' => 'Salvar',
                'body' => $body,
            ]);
        }

        if (! in_array('valid', $params->except)) {
            $this->route('post', "/valid", 'valid', [
                'description' => 'Verificar validação',
                'body' => $body,
            ]);
        }

        if (! in_array('delete', $params->except)) {
            $this->route('post', "/delete", 'delete', [
                'description' => 'Deletar',
                'query' => $this->model->searchParamsDefault(),
            ]);
        }

        if (! in_array('restore', $params->except)) {
            $this->route('post', "/restore", 'restore', [
                'description' => 'Restaurar',
                'query' => $this->model->searchParamsDefault(),
            ]);
        }

        // if (! in_array('import', $params->except)) {
        //     $this->route('post', "/import", 'import', [
        //         'description' => 'Importar',
        //     ]);
        // }

        if (! in_array('export', $params->except)) {
            $this->route('get', "/export", 'export', [
                'description' => 'Exportar',
                'query' => $this->model->searchParamsDefault(),
            ]);
        }
    }


    public function search()
    {
        $query = $this->model->search();
        $search = $query->paginate(request('per_page', 15))->toArray();
        $search['params'] = $this->model->searchParamsDefault(request()->all());
        $search['attributes'] = $this->model->searchAttributes(request()->all());
        $search['exportUrls'] = $this->model->exportUrls(request()->all());

        if ('production' != config('app.env')) {
            $search['sql'] = $query->toRawSql();
        }
        return $search;
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
        return $this->model->validate(request()->all());
    }


    public function delete()
    {
        return $this->model->search()->deleteAll();
    }


    public function restore()
    {
        $params = request()->all();
        $params['deleted'] = 1;
        return $this->model->search($params)->restoreAll();
    }


    public function import()
    {
        return ['import'];
    }


    public function export()
    {
        return $this->model->search()->export(request('format'));
    }
}

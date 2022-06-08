<?php

namespace App;

class Utils {

    static function bladeCompile($html, $data=[])
    {
        $html = \Blade::compileString($html);
        ob_start() and extract($data, EXTR_SKIP);
        try { eval('?>'.$html); }
        catch (\Exception $e) { ob_get_clean(); dd($e->getMessage(), $html); }
        return ob_get_clean();
    }

    static function getModels()
    {
        $models = array_map('realpath', glob(base_path("/app/Models/*")));
		$models = array_map(function($model) {
			$model = str_replace(base_path(), '', $model);
			$model = str_replace('\\app', '\App', $model);
			$model = str_replace('.php', '', $model);
			return app($model);
		}, $models);
        return collect($models);
    }

    static function swagger()
    {
        $swagger = [
            'swagger' => '2.0',
            'info' => [
                'description' => '',
                'version' => '1.0.0',
                'title' => '',
                'termsOfService' => 'https://swagger.io/terms',
                'contact' => ['email' => 'contact@grr.la'],
                'license' => ['name' => 'Apache 2.0', 'url' => 'https://www.apache.org/licenses/LICENSE-2.0.html'],
            ],
            'host' => url('/'),
            'basePath' => '/api',
            'tags' => [],
            'schemes' => ['https'],
            'paths' => [],
        ];

        // $swagger['paths']['/test'] = [
        //     'get' => [
        //         'tags' => [],
        //         'summary' => '',
        //         'description' => '',
        //         'operationId' => '',
        //         'consumes' => ['application/json'],
        //         'parameters' => [
        //             [
        //                 'in' => 'query',
        //                 'name' => 'aaa',
        //             ],
        //         ],
        //         'responses' => [
        //             '200' => ['description' => 'Sucesso'],
        //             '500' => ['description' => 'Erro'],
        //         ],
        //     ],
        // ];

        foreach(\Route::getRoutes() as $i => $item) {
            $itemData = (object) [
                'uri' => str_replace('api', '', $item->uri()),
            ];
            
            if (in_array($itemData->uri, ['{path}']) OR \Str::startsWith($itemData->uri, '_ignition') OR \Str::startsWith($itemData->uri, 'sanctum')) {
                continue;
            }

            $itemData->actionName = $item->getActionName();
            $itemData->actionComment = '';
            $itemData->actionClass = false;
            $itemData->actionMethod = false;
            $itemData->model = false;
            $itemData->modelTags = [];
            $itemData->controller = $item->getController();

            if (is_string($itemData->actionName) AND \Str::contains($itemData->actionName, '@')) {
                list($itemData->actionClass, $itemData->actionMethod) = explode('@', $itemData->actionName);
            }

            try {
                $itemData->model = $itemData->controller->model;
                $itemData->modelTags[] = $itemData->model->getPlural();
            }
            catch(\Exception $e) {}

            if ($itemData->actionClass AND $itemData->actionMethod) {
                $netteFile = (new \ReflectionClass($itemData->actionClass))->getFileName();
                $netteFile = \Nette\PhpGenerator\PhpFile::fromCode(file_get_contents($netteFile));
                $netteClasses = $netteFile->getClasses();
                if (isset($netteClasses[ $itemData->actionClass ])) {
                    $netteClass = $netteClasses[ $itemData->actionClass ];
                    try {
                        if ($netteMethod = $netteClass->getMethod($itemData->actionMethod)) {
                            $itemData->actionComment = $netteMethod->getComment();
                            $itemData->actionComment = $itemData->actionComment ?? 'none';
                        }
                    }
                    catch(\Exception $e) {
                        // 
                    }
                }
            }

            $path = [];
            foreach($item->methods() as $method) {
                $method = strtolower($method);
                if (in_array($method, ['head'])) continue;
                $path[ $method ] = [
                    'tags' => $itemData->modelTags,
                    'summary' => '',
                    'description' => $itemData->actionComment,
                    'operationId' => '',
                    'consumes' => ['application/json'],
                    'produces' => ['application/json'],
                    'parameters' => [
                        [
                            'in' => 'query',
                            'name' => 'aaa',
                        ],
                    ],
                    'responses' => [
                        '200' => ['description' => 'Sucesso'],
                        '404' => ['description' => 'Item not found'],
                        '500' => ['description' => 'Erro'],
                    ],
                ];
            }

            $swagger['paths'][ $itemData->uri ] = $path;
        }
        
        return $swagger;
    }
}
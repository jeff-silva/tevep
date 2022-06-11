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
            // 'host' => url('/'),
            'host' => 'localhost:5000',
            'basePath' => '/api',
            'tags' => [],
            'schemes' => ['http', 'https'],
            'paths' => [],
            'definitions' => [],
        ];

        foreach(\Route::getRoutes() as $i => $item) {
            if (! \Str::startsWith($item->uri(), 'api')) {
                continue;
            }
            
            $itemData = (object) [ 'uri' => str_replace('api', '', $item->uri()) ];
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
            catch(\Exception $e) {
                if (\Str::contains($itemData->actionClass, 'AppController')) {
                    $itemData->modelTags[] = 'App';
                }
                else if (\Str::contains($itemData->actionClass, 'AuthController')) {
                    $itemData->modelTags[] = 'Autenticação';
                }
            }

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
                $path_item = [
                    'tags' => $itemData->modelTags,
                    'summary' => '',
                    'description' => $itemData->actionComment,
                    'operationId' => '',
                    'consumes' => ['application/json'],
                    'produces' => ['application/json'],
                    'parameters' => [],
                    'responses' => [
                        '200' => ['description' => 'Sucesso'],
                        '404' => ['description' => 'Item not found'],
                        '500' => ['description' => 'Erro'],
                    ],
                ];

                foreach($item->parameterNames() as $param_name) {
                    $path_item['parameters'][] = [
                        'in' => 'path',
                        'name' => $param_name,
                    ];
                }

                if ($itemData->model AND 'search'==$itemData->actionMethod) {
                    foreach($itemData->model->searchParamsDefault() as $param_name => $param_value) {
                        $path_item['parameters'][] = [
                            'in' => 'query',
                            'name' => $param_name,
                        ];
                    }
                }

                $path[ $method ] = $path_item;
            }

            $swagger['paths'][ $itemData->uri ] = $path;

            // Definitions
            if ($itemData->model AND !isset($swagger['definitions'][ $itemData->model->getTable() ])) {
                $definition = [
                    'type' => 'object',
                    'properties' => [],
                ];

                foreach($itemData->model->getSchemaFields() as $field => $mysql_type) {
                    $type = 'string';

                    if (in_array($field, ['id'])) {
                        $type = 'integer';
                    }
                    else if (\Str::contains($mysql_type, 'INT')) {
                        $type = 'integer';
                    }
                    else if (in_array($field, ['created_at', 'updated_at', 'deleted_at'])) {
                        $type = 'date-time';
                    }

                    $definition['properties'][ $field ] = [
                        'type' => $type,
                        'description' => '',
                    ];
                }

                $swagger['definitions'][ $itemData->model->getTable() ] = $definition;
            }
        }

        return $swagger;
    }
}
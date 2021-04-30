<?php

namespace App\Http;

class RouteController {

    static function load($controller, $params=[]) {
        $params = array_merge([
            'prefix' => false,
        ], $params);

        $routes = [];

        $r = new \ReflectionClass($controller);
        foreach ($r->getMethods() as $rmethod) {
            $method_name = $rmethod->getName();

            $ignore = [
                'middleware',
                'getMiddleware',
                'callAction',
                '__call',
                'authorize',
                'authorizeForUser',
                'parseAbilityAndArguments',
                'normalizeGuessedAbilityName',
                'authorizeResource',
                'resourceAbilityMap',
                'resourceMethodsWithoutModels',
                'dispatch',
                'dispatchNow',
                'validateWith',
                'validate',
                'validateWithBag',
                'getValidationFactory',
            ];

            if (in_array($method_name, $ignore)) continue;
            $route = [];
            $route['method'] = 'get';
            $route['route'] = [$params['prefix']];
            $route['name'] = '';
            $route['class'] = $controller;
            $route['classMethod'] = $method_name;

            $has_method = false;
            foreach(['any', 'get', 'post', 'put'] as $method) {
                if (\Str::startsWith($method_name, $method)) {
                    $has_method = true;
                    $route['route'][] = \Str::of(str_replace($method, '', $method_name))->studly()->kebab();
                    $route['method'] = $method;
                    break;
                }
            }

            if (! $has_method) {
                $route['route'][] = \Str::of($method_name)->studly()->kebab();
            }

            foreach($rmethod->getParameters() as $param) {
                if (in_array($param->name, ['request'])) continue;
                $route['route'][] = '{'. $param->name .'}';
            }

            $route['route'] = implode('/', $route['route']);
            $route['name'] = str_replace('/', '.', $route['route']);

            $routes[] = $route;
        }

        foreach($routes as $route) {
            list($method, $route, $name, $class, $classMethod) = array_values($route);
            call_user_func(['\Illuminate\Support\Facades\Route', $method], $route, "{$class}@{$classMethod}");
        }
    }
}
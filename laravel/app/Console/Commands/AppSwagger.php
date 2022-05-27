<?php

// composer require nette/php-generator
// https://github.com/nette/php-generator

namespace App\Console\Commands;

class AppSwagger extends AppBase
{

    protected $signature = 'app:swagger';
    protected $description = 'Gera documentação Swagger';

    public function handle() {
        return;
        
        $json = [
            'swagger' => '2.0',
            'info' => [
                'description' => 'Descrição',
                'version' => '1.0.0',
                'title' => env('APP_NAME'),
                'termsOfService' => 'http://swagger.io/terms/',
                'contact' => [
                    'email' => 'contact@grr.la',
                ],
                'license' => [
                    'name' => 'Apache 2.0',
                    'url' => 'http://www.apache.org/licenses/LICENSE-2.0.html',
                ],
            ],
            'host' => '__swagger_host__',
            'basePath' => '/api',
            'tags' => [],
            'schemes' => ['https'],
            'paths' => [],
        ];

        foreach($this->getTables() as $table) {
            if ($this->isIgnoredTable($table->Name)) continue;
            foreach(app($table->Controller->NameFull)->getGeneratedRoutes() as $route) {

                $json['tags'][ $route->prefix ] = [
                    'name' => $route->prefix,
                    // 'description' => $route->prefix,
                ];

                foreach($route->methods as $method) {
                    if (in_array($method, ['HEAD'])) continue;
                    $method = strtolower($method);
    
                    $parameters = [];

                    if (is_array($route->query)) {
                        foreach($route->query as $key=>$val) {
                            $parameters[] = [
                                'in' => 'query',
                                'name' => $key,
                            ];
                        }
                    }

                    if (is_array($route->body)) {
                        foreach($route->body as $key=>$val) {
                            $parameters[] = [
                                'in' => 'body',
                                'name' => $key,
                            ];
                        }
                    }

                    if (is_array($route->path)) {
                        foreach($route->path as $key=>$val) {
                            $parameters[] = [
                                'in' => 'path',
                                'name' => $key,
                            ];
                        }
                    }

                    $json['paths']["/{$route->path}"] = [
                        $method => [
                            'tags' => [ $route->prefix ],
                            'summary' => $route->path,
                            'description' => $route->description,
                            'operationId' => $route->name,
                            'consumes' => ['application/json'],
                            'parameters' => $parameters,
                            'responses' => [
                                '200' => ['description' => 'Sucesso'],
                                '500' => ['description' => 'Erro'],
                            ],
                        ],
                    ];
                }
            }
        }

        $json['tags'] = array_values($json['tags']);
        $json = json_encode($json);
        $json = str_replace('"__swagger_host__"', '(new URL(location.href)).host', $json);

        $content[] = '<template>';
        $content[] = '  <div ref="swagger"></div>';
        $content[] = '</template>';
        $content[] = '';
        $content[] = '<script>';
        $content[] = "import { SwaggerUIBundle, SwaggerUIStandalonePreset } from 'swagger-ui-dist';";
        $content[] = "import 'swagger-ui-dist/swagger-ui.css';";
        $content[] = '';
        $content[] = 'export default {';
        $content[] = '  head() {';
        $content[] = '      return {';
        $content[] = '          title: "Swagger",';
        $content[] = '      };';
        $content[] = '  },';
        $content[] = '';
        $content[] = '  mounted() {';
        $content[] = '      this.swaggerInit();';
        $content[] = '  },';
        $content[] = '';
        $content[] = '  methods: {';
        $content[] = '      swaggerInit() {';
        $content[] = '          new SwaggerUIBundle({';
        $content[] = '              domNode: this.$refs.swagger,';
        $content[] = '              deepLinking: true,';
        $content[] = '              presets: [SwaggerUIBundle.presets.apis, SwaggerUIStandalonePreset],';
        $content[] = '              layout: "StandaloneLayout",';
        $content[] = "              spec: {$json},";
        $content[] = '          });';
        $content[] = '      },';
        $content[] = '  },';
        $content[] = '}';
        $content[] = '</script>';

        file_put_contents(base_path('client/pages/admin/dev/index/swagger.vue'), implode("\n", $content));
    }
}

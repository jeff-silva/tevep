<?php

namespace App\Console\Commands;

class AppNuxtGenerate extends AppBase
{

    protected $signature = 'app:nuxt-generate';
    protected $description = 'Generate nuxt files';

    public function handle() {
        $this->makeStore();
        $this->makeViews();
    }


    public function makeStore()
    {
        $env['exportFormats'] = \App\Converters\Converter::formats();
        $env = json_encode($env);
        file_put_contents(base_path('client/store/env.js'), "export const state = {$env};");
    }
    
    
    public function makeViews()
    {
        foreach($this->getTables() as $table) {
            if ($this->isIgnoredTable($table->Name)) continue;

            $model_name = (string) \Str::of($table->Name=='users'? 'user': $table->Name)->studly()->kebab();
            
            $nuxt_admin_folder = base_path("client/pages/admin/{$model_name}");

            $nuxt_admin_search_file = $nuxt_admin_folder .'/index.vue';
            $nuxt_admin_search_content = implode("\n", [
                "<template>",
                "\t<ui-model-search",
                "\t\tmodel-name=\"{$model_name}\"",
                "\t\tsingular=\"Item\"",
                "\t\tplural=\"Itens\"",
                "\t>",
                "\t\t<template #table-header>",
                "\t\t\t<th data-orderby=\"name\">Nome</th>",
                "\t\t</template>",
                "\t\t",
                "\t\t<template #table-row=\"{item}\">",
                "\t\t\t<td>{{ item.name }}</td>",
                "\t\t</template>",
                "\t</ui-model-search>",
                "</template>",
                "",
                "<script>",
                "export default {",
                "\tlayout: \"admin\",",
                "\tmiddleware: [\"auth\", \"permission\"],",
                "\t",
                "\thead() {",
                "\t\treturn {",
                "\t\t\ttitle: \"Buscar\",",
                "\t\t};",
                "\t},",
                "}",
                "</script>",
            ]);

            $nuxt_admin_edit_file = $nuxt_admin_folder .'/_id.vue';
            $nuxt_admin_edit_content = implode("\n", [
                "<template>",
                "\t<ui-model-edit",
                "\t\tmodel-name=\"{$model_name}\"",
                "\t\t:model-id=\"\$route.params.id\"",
                "\t\tsingular=\"Item\"",
                "\t\tplural=\"Itens\"",
                "\t\t#default=\"{value, errorFields}\"",
                "\t>",
                "\t\t<ui-field label=\"Nome\" :error=\"errorFields.name\">",
                "\t\t\t<input type=\"text\" class=\"form-control\" v-model=\"value.name\">",
                "\t\t</ui-field>",
                "\t</ui-model-edit>",
                "</template>",
                "",
                "<script>",
                "export default {",
                "\tlayout: \"admin\",",
                "\tmiddleware: [\"auth\", \"permission\"],",
                "\t",
                "\thead() {",
                "\t\treturn {",
                "\t\t\ttitle: \"Editar\",",
                "\t\t};",
                "\t},",
                "}",
                "</script>",
            ]);

            if (! file_exists($nuxt_admin_folder)) {
                mkdir($nuxt_admin_folder, 0755, true);
                file_put_contents($nuxt_admin_search_file, $nuxt_admin_search_content);
                file_put_contents($nuxt_admin_edit_file, $nuxt_admin_edit_content);
            }
        }
    }
}

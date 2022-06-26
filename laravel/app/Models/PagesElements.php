<?php

namespace App\Models;

class PagesElements extends \Illuminate\Database\Eloquent\Model
{
	use \Illuminate\Database\Eloquent\Factories\HasFactory;
	use \App\Traits\Model;

	protected $singular = 'Elemento de Página';
	protected $plural = 'Elementos de Páginas';
	protected $table = 'pages_elements';
	protected $fillable = ['id', 'slug', 'name', 'type', 'view', 'edit', 'created_at', 'updated_at', 'deleted_at'];


	public function schemaFields()
	{
		return [
			'id' => 'default',
			'slug' => 'VARCHAR(255) NOT NULL',
			'name' => 'VARCHAR(255) NOT NULL',
			'type' => 'VARCHAR(20) NULL DEFAULT NULL',
			'view' => 'LONGTEXT NULL DEFAULT NULL',
			'edit' => 'LONGTEXT NULL DEFAULT NULL',
			'created_at' => 'default',
			'updated_at' => 'default',
			'deleted_at' => 'default',
		];
	}


	public function mutatorRetrieve()
	{
		$this->view = $this->vueComponent($this->view);
		$this->edit = $this->vueComponent($this->edit);
	}

	public function mutatorSave()
	{
		$this->view = $this->vueCompile($this->view, $this);
		$this->edit = $this->vueCompile($this->edit, $this);
	}


	public function vueComponent($component)
	{
		$component = is_array($component)? $component: json_decode($component, true);
		$component = is_array($component)? $component: [];
		return array_merge([
			'template' => '<div>Hello {{ modelValue.hello || \'World\' }}</div>',
			'script' => "export default {\n\tprops: {\n\t\tmodelValue: {\n\t\t\ttype: Object,\n\t\t\tdefault: () => ({}),\n\t\t}\n\t}\n};",
			'style' => '',
			'compiled' => '',
		], $component);
	}


	public function vueCompile($component, $model)
	{
		$component = $this->vueComponent($component);
		
		$compiled = $component['script']? $component['script']: '{}';
		$compiled = preg_replace('/^.*\{/', "{\n\tgid: '{$model->id}',\n", $compiled);
		$compiled = preg_replace('/\}.*$/', "\n\ttemplate: `<div>{$component['template']}</div>`,\n}", $compiled);
		$component['compiled'] = $compiled;

		return $component;
	}
}

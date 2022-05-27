<?php

// composer require nette/php-generator
// https://github.com/nette/php-generator

namespace App\Console\Commands;

class AppModelsGenerate extends AppBase
{

    protected $signature = 'app:models-generate';
    protected $description = 'Generate models based on database tables';

    public function handle() {
        
        return;
        foreach($this->getTables() as $table) {
            if (! $table->Model->FileExists) {
                $file = new \Nette\PhpGenerator\PhpFile();
                $class = $file->addClass($table->Model->NameFull);
                $class->setExtends('\Illuminate\Database\Eloquent\Model');
                $class->addTrait('\Illuminate\Database\Eloquent\Factories\HasFactory');
                $class->addTrait('\App\Traits\Model');
                file_put_contents(base_path($table->Model->File), $file->__toString());
            }

            $file = \Nette\PhpGenerator\PhpFile::fromCode(file_get_contents(base_path($table->Model->File)), true);
            $classes = $file->getClasses();
            if (isset($classes[ $table->Model->NameFull ])) {
                $class = $classes[ $table->Model->NameFull ];

                $protected_table = $class->hasProperty('table')? $class->getProperty('table'): $class->addProperty('table', []);
                $protected_table->setProtected();
                $protected_table->setValue($table->Name);

                $protected_fillable = $class->hasProperty('fillable')? $class->getProperty('fillable'): $class->addProperty('fillable', []);
                $protected_fillable->setProtected();
                $protected_fillable->setValue((array) array_keys($table->Fields));
                
                file_put_contents(base_path($table->Model->File), $file->__toString());
            }
        }

        foreach($this->getFks() as $fk) {
            if ($this->isIgnoredTable($fk->TABLE_NAME)) continue;
            if ($this->isIgnoredTable($fk->REFERENCED_TABLE_NAME)) continue;

            $tableReferenced = $this->classInfo([
                'name' => $fk->REFERENCED_TABLE_NAME,
                'namespace' => 'App\Models',
                'path' => 'app\Models',
            ]);

            $tableClass = $this->classInfo([
                'name' => $fk->TABLE_NAME,
                'namespace' => 'App\Models',
                'path' => 'app\Models',
            ]);


            // HasOne
            $file = \Nette\PhpGenerator\PhpFile::fromCode(file_get_contents(base_path($tableClass->File)));
            $classes = $file->getClasses();
            if (isset($classes[ $tableClass->NameFull ])) {
                $class = $classes[ $tableClass->NameFull ];
                $method = (string) \Str::of(str_replace('_id', '', $fk->COLUMN_NAME))->singular()->kebab()->camel();
                $method = $class->addMethod($method);
                $method->setBody("return \$this->hasOne(\\{$tableReferenced->NameFull}::class, '{$fk->REFERENCED_COLUMN_NAME}', '{$fk->COLUMN_NAME}');");
                $method->setPublic();
                file_put_contents(base_path($tableClass->File), $file->__toString());
            }
            
            // HasMany
            $file = \Nette\PhpGenerator\PhpFile::fromCode(file_get_contents(base_path($tableClass->File)));
            $classes = $file->getClasses();
            if (isset($classes[ $tableClass->NameFull ])) {
                $class = $classes[ $tableClass->NameFull ];
                $method = (string) \Str::of(str_replace('_id', '', $fk->COLUMN_NAME))->plural()->kebab()->camel();
                $method = $class->addMethod($method);
                $method->setBody("return \$this->hasMany(\\{$tableReferenced->NameFull}::class, '{$fk->REFERENCED_COLUMN_NAME}', '{$fk->COLUMN_NAME}');");
                $method->setPublic();
                file_put_contents(base_path($tableClass->File), $file->__toString());
            }

            // BelongsTo
            $file = \Nette\PhpGenerator\PhpFile::fromCode(file_get_contents(base_path($tableReferenced->File)));
            $classes = $file->getClasses();
            if (isset($classes[ $tableReferenced->NameFull ])) {
                $class = $classes[ $tableReferenced->NameFull ];
                $method = (string) \Str::of($tableClass->Name)->singular()->kebab()->camel();
                $method = $class->addMethod($method);
                $method->setBody("return \$this->belongsTo({$tableClass->NameFull}::class, '{$fk->COLUMN_NAME}', '{$fk->REFERENCED_COLUMN_NAME}');");
                $method->setPublic();
                file_put_contents(base_path($tableReferenced->File), $file->__toString());
            }
        }
    }
}

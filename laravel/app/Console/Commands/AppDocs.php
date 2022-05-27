<?php

// composer require nette/php-generator
// https://github.com/nette/php-generator

namespace App\Console\Commands;

class AppDocs extends AppBase
{

    protected $signature = 'app:docs';
    protected $description = 'Gera documentação';

    public function handle() {
        $content_base = file_get_contents(base_path('resources/views/docs/_base.blade.php'));
        $content_base = \App\Utils::bladeCompile($content_base, ['command' => $this]);

        foreach(glob(base_path('/resources/views/docs/*.blade.php')) as $file) {
            $file_basename = pathinfo($file, PATHINFO_BASENAME);
            if ($file_basename[0]=='_') continue;
            
            $content = file_get_contents($file);
            $content = \App\Utils::bladeCompile($content, ['command' => $this]);
            $content = str_replace('[php', '<?php', $content);
            $content = str_replace('php]', '?>', $content);
            
            $filename_md = base_path('docs/'. str_replace('.blade.php', '.md', $file_basename));
            file_put_contents($filename_md, $content_base ."\n\n\n". $content);
        }
    }

    public function cmd($type, $code)
    {
        $code = is_array($code)? implode("\n", $code): $code;
        return "```{$type}\n{$code}\n```";
    }
}

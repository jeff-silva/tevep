<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AppSchema extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:schema';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cria schema do banco de dados';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {   
        $this->comment('⚙️  Gerando config/database-schema.php');

        $database_schema = [
            'tables' => [],
            'fks' => [],
        ];

        foreach(\DB::select('SHOW TABLE STATUS') as $table) {
            $database_schema['tables'][ $table->Name ] = $table;
        }

        $database = env('DB_DATABASE');
        foreach(\DB::select("SELECT * FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE CONSTRAINT_SCHEMA='{$database}' ") as $fk) {
            $database_schema['fks'][ $fk->TABLE_NAME ] = $fk;
        }

        $database_schema = json_encode($database_schema);
        $database_schema = json_decode($database_schema, true);
        file_put_contents(config_path('database-schema.php'), '<?php return '. $this->varExport($database_schema) .';');


        $this->comment('⚙️  Gerando config/database-settings.php');
        $database_settings_default = [
            'models' => [],
        ];

        $database_settings = $database_settings_default;
        foreach($database_schema['tables'] as $table_name=>$table) {
            $database_settings['models'][ $table_name ] = false;
        }

        $database_settings2 = config('database-settings', $database_settings_default);
        foreach($database_settings as $name=>$value) {
            $database_settings2[$name] = array_merge($database_settings[$name], $database_settings2[$name]);
        }

        file_put_contents(config_path('database-settings.php'), '<?php return '. $this->varExport($database_settings2) .';');
    }

    public function varExport($data) {
        $dump = var_export($data, true);
        $dump = preg_replace('#(?:\A|\n)([ ]*)array \(#i', '[', $dump); // Starts
        $dump = preg_replace('#\n([ ]*)\),#', "\n$1],", $dump); // Ends
        $dump = preg_replace('#=> \[\n\s+\],\n#', "=> [],\n", $dump); // Empties
        if (gettype($data) == 'object') { // Deal with object states
            $dump = str_replace('__set_state(array(', '__set_state([', $dump);
            $dump = preg_replace('#\)\)$#', "])", $dump);
        }
        else {  $dump = preg_replace('#\)$#', "]", $dump); }
        return $dump;
    }
}

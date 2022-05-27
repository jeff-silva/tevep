const shell = require('shelljs');
const base = require('./base');
const readline = require('readline');

const inter = readline.createInterface({
    input: process.stdin,
    output: process.stdout
});

inter.question('Database table name: ', function (table_name) {
    shell.cd(base.env.LARAVEL_PATH);
    shell.exec(`php artisan app:model-delete ${table_name}`);
    inter.close();
});

inter.on('close', function () {
    process.exit(0);
});
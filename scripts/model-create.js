const shell = require('shelljs');
const base = require('./base');
const readline = require('readline');

const inter = readline.createInterface({
    input: process.stdin,
    output: process.stdout
});

inter.question('Database table name: ', (table_name) => {
    inter.question('Table singular name: ', (singular) => {
        inter.question('Table plural name: ', (plural) => {
            shell.cd(base.env.SERVER_PATH);
            shell.exec(`php artisan app:model-create ${table_name} ${singular} ${plural}`);
            inter.close();
        });
    });
});

inter.on('close', () => {
    process.exit(0);
});
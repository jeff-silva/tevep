const base = require('./base');

base.serverCmd(`php artisan serve --port=${base.server.port}`);
base.clientCmd(`npm run dev -- --port ${base.client.port}`);

const chokidar = require('chokidar');
chokidar.watch([
    `${base.server.path}/app/Console/Commands`,
    `${base.server.path}/app/Http/Controllers`,
    `${base.server.path}/app/Models`,
    `${base.server.path}/app/Traits`,
    `${base.server.path}/config`,
]).on('change', (path) => {
    base.serverCmd(`php artisan app:sync`);
});
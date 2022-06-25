const chokidar = require('chokidar');
const base = require('./base');

const laravelPort = (new URL(base.laravel.href)).port;
base.laravelCmd(`php artisan serve --port=${laravelPort}`);

chokidar.watch([
    `${base.laravel.path}/app/Console/Commands`,
    `${base.laravel.path}/app/Http/Controllers`,
    `${base.laravel.path}/app/Models`,
    `${base.laravel.path}/app/Traits`,
    `${base.laravel.path}/config`,
]).on('change', (path) => {
    base.laravelCmd(`php artisan app:sync`);
});

const nuxtPort = (new URL(base.nuxt.href)).port;
base.nuxtCmd(`npm run dev -- --port ${nuxtPort}`);
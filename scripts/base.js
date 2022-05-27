const p = require('child_process');
const path = require('path');
const fs = require('fs');
require('dotenv').config({ path: '../.env' });

const envDefault = {
    APP_NAME: 'AppName',
    CORDOVA_PATH: 'cordova',
    ELECTRON_PATH: 'electron',
    LARAVEL_PATH: 'laravel',
    LARAVEL_HOST: 'http://localhost:4999',
    NUXT_PATH: 'nuxt',
    NUXT_HOST: 'http://localhost:5000',
};

let env = {};
for(let attr in envDefault) {
    const value = envDefault[attr];
    env[ attr ] = process.env[attr] || value;
}


// Run command in folder
const run = (cwd, command) => {
    let child = p.exec(command, { cwd }, (e, o, r) => console.log(e, o, r));
    child.stdout.pipe(process.stdout);
};


// Laravel start server
const laravelServe = () => {
    const servePath = path.join(__dirname, '..', env.LARAVEL_PATH);
    const serveHost = new URL(env.LARAVEL_HOST);
    run(servePath, `php artisan serve --port=${serveHost.port}`);
};


// Nuxt start server
const nuxtServe = () => {
    const servePath = path.join(__dirname, '..', env.NUXT_PATH);
    const serveHost = new URL(env.NUXT_HOST);
    run(servePath, `npm run dev -- --port ${serveHost.port}`);
};


// Nuxt build application
const nuxtBuild = () => {
    const servePath = path.join(__dirname, '..', env.NUXT_PATH);
    run(servePath, `npm run build`);
};


// .env.example sync
(() => {
    let content = [];
    for(let attr in envDefault) { let value = envDefault[attr]; content.push(`${attr}=${value}`); }
    fs.writeFile(path.join(__dirname, '../.env.example'), content.join("\n"), err => {});
})();


module.exports = {
    run,
    laravelServe,
    nuxtServe,
    nuxtBuild,
    env,
};
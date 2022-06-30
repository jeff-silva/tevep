const p = require('child_process');
const path = require('path');
const fs = require('fs');
require('dotenv').config();

const envDefault = {
    APP_NAME: 'AppName',
    SERVER_PATH: 'laravel',
    SERVER_HOST: 'http://localhost:4999',
    CLIENT_PATH: 'nuxt3',
    CLIENT_HOST: 'http://localhost:5000',
    CORDOVA_PATH: 'cordova',
    ELECTRON_PATH: 'electron',
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


// Backend start server
const serverCmd = (cmd) => {
    const servePath = path.join(__dirname, '..', env.SERVER_PATH);
    run(servePath, cmd);
};


// Nuxt start server
const clientCmd = (cmd) => {
    const servePath = path.join(__dirname, '..', env.CLIENT_PATH);
    run(servePath, cmd);
};


const server = (() => {
    const u = new URL(env.SERVER_HOST);
    return {
        path: path.join(__dirname, '..', env.SERVER_PATH),
        href: u.href,
        protocol: u.protocol,
        username: u.username,
        password: u.password,
        host: u.host,
        hostname: u.hostname,
        port: u.port,
        pathname: u.pathname,
    };
})();


const client = (() => {
    const u = new URL(env.CLIENT_HOST);
    return {
        path: path.join(__dirname, '..', env.CLIENT_PATH),
        href: u.href,
        protocol: u.protocol,
        username: u.username,
        password: u.password,
        host: u.host,
        hostname: u.hostname,
        port: u.port,
        pathname: u.pathname,
    };
})();


// .env.example sync
(() => {
    let content = [];
    for(let attr in envDefault) { let value = envDefault[attr]; content.push(`${attr}=${value}`); }
    fs.writeFile(path.join(__dirname, '../.env.example'), content.join("\n"), err => {});
})();


module.exports = {
    run,
    env,
    server,
    serverCmd,
    client,
    clientCmd,
};
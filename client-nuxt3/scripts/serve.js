const consola = require('consola');
const chalk = require('chalk');
const run = require('./run');
const path = require('path');

require('dotenv').config({
  path: path.join(__dirname, '../../.env'),
});

let front = new URL(process.env.APP_URL);

let back = Object.assign(new URL(process.env.APP_URL), {
  port: parseInt(front.port)+1,
});

run('../../', `php artisan serve --port=${back.port}`).then((error, stdout, stderr) => {
  console.log(error, stdout, stderr);
});

run('../', `npm run dev -- --port ${front.port}`).then((error, stdout, stderr) => {
  console.log(error, stdout, stderr);
});
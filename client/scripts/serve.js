const p = require('child_process');
const path = require('path');
const boxen = require('../node_modules/boxen');
const opener = require('../node_modules/opener');

require('dotenv').config({
    path: path.join(__dirname, '../../.env')
});

let client = new URL(process.env.CLIENT_URL);
client.port = client.port || 5000;

let app = new URL(process.env.APP_URL);
app.port = app.port || 5001;

const _command = function(dirname, command) {
    return new Promise((resolve, reject) => {
        let params = { cwd: path.join(__dirname, dirname) };
        
        let child = p.exec(command, params, function(error, stdout, stderr) {
            resolve({stdout, stderr});
            if (error == null) return;
        });
    
        child.stdout.pipe(process.stdout);
    });
};

console.clear();

_command('/../..', `php artisan serve --port=${app.port}`);
_command('/..', `npm run dev -- --port ${client.port}`);

console.log(boxen(client.href, {
    padding: 1,
    margin: 1,
    title: '🚀',
    titleAlignment: 'center',
    borderStyle: 'double',
}));

opener(client.href);
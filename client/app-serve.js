const p = require('child_process');
const path = require('path');

require('dotenv').config({
    path: path.join(__dirname, '../.env')
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
_command('/..', `php artisan serve --port=${app.port}`);
_command('', `npm run dev -- --port ${client.port}`);
console.log(`\n >> CLIENT: ${client.href} << \n`);

var start = (process.platform == 'darwin'? 'open': (process.platform == 'win32'? 'start': 'xdg-open'));
require('child_process').exec(`${start} ${client.href}`);
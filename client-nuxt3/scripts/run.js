const p = require('child_process');
const path = require('path');
// const fs = require('fs');

module.exports = (dirname, command) => {
    return new Promise((resolve, reject) => {
        let params = { cwd: path.join(__dirname, dirname) };
        
        let child = p.exec(command, params, function(error, stdout, stderr) {
            resolve({stdout, stderr});
            // if (error == null) return;
        });
    
        child.stdout.pipe(process.stdout);
    });
};
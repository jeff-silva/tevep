const p = require('child_process');
const path = require('path');
const fs = require('fs');

require('dotenv').config({
    path: path.join(__dirname, '../../.env')
});

const _path = function(filepath) {
    return path.join.apply(null, filepath.split(/\//g).filter(item => item)).replace(/^\@/g, __dirname);
};

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

const _files = function(filepath, files=[], level=0) {
    filepath = _path(filepath);
    if (level==0) files.push({isDirectory:true, level, file:filepath});

    fs.readdirSync(filepath).forEach(function(file) {
        let subpath = path.join(filepath, file);
        let isDirectory = fs.lstatSync(subpath).isDirectory();
        files.push({ isDirectory, level, file: subpath });
        if (isDirectory) { files = _files(subpath, files, level+1); }
    });

    return files;
}

_command('', 'npm run generate').then(resp => {

    // Renomear /client/dist/index.html para /client/dist/app.html
    if (fs.existsSync(_path('@/dist/index.html'))) {
        fs.renameSync(_path('@/dist/index.html'), _path('@/dist/app.html'));
    }

    // Mover todos os arquivos de /client/dist para /public
    _files('@/dist').forEach(file => {
        file.newfile = file.file.replace(_path('client/dist'), 'public');
        if (file.isDirectory) {
            if (!fs.existsSync(file.newfile)) {
                fs.mkdirSync(file.newfile, '777');
            }
            return;
        }
        fs.renameSync(file.file, file.newfile);
    });

    // Deletar pasta /client/dist/
    _files('@/dist').reverse().forEach(file => {
        fs.rmdirSync(file.file);
    });
});
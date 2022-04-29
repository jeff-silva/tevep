const consola = require('consola');
const chalk = require('chalk');

// for(let i=0; i<10; i++) {
//     consola.success(`hello world ${i}`);
//     console.log(chalk.blue(`hello world ${i}`));
// }


const { exec } = require('child_process');
let run = (command) => {
  exec(command, (err, stdout, stderr) => {
    console.log(err, stdout, stderr);
  });
};

run('cd ../..');
run('ls');
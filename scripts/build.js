const shell = require('shelljs');
const base = require('./base');
// base.nuxtBuild();

shell.cd(base.env.NUXT_PATH);
shell.exec('npm run generate');
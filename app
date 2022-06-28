let file = Array.from(process.argv).splice(-1, 1);
file = __dirname +'/scripts/'+ file.join('/') +'.js';
console.clear();
console.log('run:', file);
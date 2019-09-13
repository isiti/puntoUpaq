'use strict'

console.log('entre en app.js');

var url = window.location.href;
var swLocation = '/cadete/sw.js'; // donde se encuentra el sw en producción.

console.log(url);

// invocamos al Service Worker.
if ( navigator.serviceWorker ) {
    console.log('incluimos sw.js file.');

    if(url.includes('localhost')){
        console.log('sw en local');
        swLocation = '/sw.js';
    }

    navigator.serviceWorker.register(swLocation);
}

'use strict'

// Guardar  en el cache dinamico
// imports js files.
// importScripts('js/sw-utils.js');



// Caches.
const STATIC_CACHE = 'static-v3';
const DYNAMIC_CACHE = 'dynamic-v2';
const INMUTABLE_CACHE = 'inmutable-v1';


// App-shell -> necesario para el funcionamiento de la app (static)
// const APP_SHELL = [
//     '/',
//     'index.php',
//     'assets/scss/styles-global.css',
//     'assets/scss/styles-general.css',
//     // 'assets/scss/plugins/animate.css',
//     'assets/scss/plugins/neon-effect.css',
//     'js/plugins/notie-master/dist/notie.css',
//     'assets/scss/styles-navigation/styles-nav-top.css',
//     'assets/scss/styles-navigation/styles-side-bar.css',
//     'assets/scss/styles-pages/styles-login.css',
//     'assets/scss/styles-pages/styles-footer.css',
//     'assets/scss/styles-pages/styles-home.css',
//     'assets/scss/styles-pages/styles-perfil.css',
//     'assets/scss/styles-pages/styles-end.css',
//     'assets/scss/styles-pages/styles-pedidos.css',
//     'assets/scss/styles-pages/styles-info.css',
//     'assets/scss/styles-pages/styles-action.css',
//     'assets/scss/styles-pages/styles-btn-float.css',
//     'assets/scss/styles-components/styles-vue-components/styles-vue-basic-components.css',
//     'assets/scss/styles-components/styles-vue-components/styles-TableScroll.css',
//     'js/plugins/routing-machine/leaflet-routing-machine.css',
//     'js/plugins/slick/slick/slick.css',
//     'js/plugins/jquery-ui/jquery-ui.min.css',
//     'js/plugins/jquery-ui/jquery-ui.structure.min.css',
//     'js/plugins/jquery-ui/jquery-ui.theme.min.css',
//     'assets/images/icon/faviconBox.ico',
//     'manifest.json',
//     'js/plugins/moment-js/moment.js',
//     'js/plugins/slick/slick/slick.js',
//     'js/plugins/notie-master/dist/notie.min.js',
//     'js/plugins/jscolor/jscolor.js',
//     'js/plugins/routing-machine/leaflet-routing-machine.js',
//     'js/plugins/vuex/vuex.js',
//     'components/vue-components/vuex/store.js',
//     'components/vue-components/vue-basic-components.js',
//     'components/vue-components/EditorTexto.js',
//     'components/vue-components/ColorPicker.js',
//     'components/vue-components/Carousel.js',
//     'components/vue-components/TableScroll.js',
//     'js/vue/vue-functions.js',
//     'js/app.js',
//     'js/functions.js'
// ];


// // todo lo que no se va a modificar jamas.
// const APP_SHELL_INMUTABLE = [
//     'https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css',
//     'https://unpkg.com/simplebar@latest/dist/simplebar.css',
//     'https://unpkg.com/leaflet@1.4.0/dist/leaflet.css',
//     'https://cdn.quilljs.com/1.3.6/quill.snow.css',
//     'https://cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.0/slick/slick-theme.css',
//     'https://use.fontawesome.com/releases/v5.6.3/css/all.css',
//     'https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css',
//     'https://fonts.googleapis.com/css?family=Abel',
//     'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js',
//     'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js',
//     'https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js',
//     'https://cdn.quilljs.com/1.3.6/quill.js',
//     'https://unpkg.com/simplebar@latest/dist/simplebar.js',
//     'https://unpkg.com/leaflet@1.4.0/dist/leaflet.js',
//     'https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js',
//     'https://cdn.jsdelivr.net/npm/vue/dist/vue.js'
// ];


// instalación
self.addEventListener('install', e => {

    console.log('sw-instalado');

    // // creamos promesa para almacenamos APP_SHELS en cache static.
    // const cacheStatic = caches.open(STATIC_CACHE).then(cache => {
    //     cache.addAll(APP_SHELL)
    // });

    // // creamos promesa para almacenamos APP_SHELS_INMUTABLE en cache inmutable.
    // const cacheInmutable = caches.open(INMUTABLE_CACHE).then(cache => {
    //     cache.addAll(APP_SHELL_INMUTABLE)
    // });

    // e.waitUntil(Promise.all([cacheStatic, cacheInmutable]));
});

// activación
self.addEventListener('active', e => {

    console.log('sw-activado');
    // // creamos promesa para verificar si la version de cache a instalar es diferente a la actual, eliminar la que ya no se utiliza.
    // const respuesta = caches.keys().then(keys => {
    //     keys.forEach(keys => {
                                
    //         if(key !== STATIC_CACHE && key.includes('static')) {
    //             return caches.delete(key);
    //         }

    //         if(key !== DYNAMIC_CACHE && key.includes('dynamic')) {
    //             return caches.delete(key);
    //         }
            
    //     })
    // });
    
    // e.waitUntil(resupesta);        
});

// // estrategias
// self.addEventListener('fetch', e => {

//     // Cache only
//     const respuesta = caches.match(e.request).then(res => {
//         if (res){ 
//             return res; 
//         } else {

//             // cache with network fallback.
//             return fetch(e.request)
//                 .then(newRes =>{
//                     return actualizarcacheDinamico(DYNAMIC_CACHE, e.request, newRes);
//                 })            
//         }
//     })

//     e.respondWith(respuesta);
// });
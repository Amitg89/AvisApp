
// Call install event
const cacheName = 'v1';

// const cacheAssets = [
//     'AvisApp.php',
//     'AvisAppScripts.js',
//     'AvisAppAdmin.php',
//      'AvisApp_files/AvisAppManifest.json',
//      'https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css',
//      'https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js'
// ]

self.addEventListener('install', e => {
    console.log('Service Worker Installed');

    // e.waitUntil(
    //     caches.open(cacheName)
    //         .then(cache => {
    //             console.log('Service Worker: Caching Files');
    //             cache.addAll(cacheAssets);
    //         })
    //         .then(() => self.skipWaiting())
    // );
});

self.addEventListener('activate', e => {
    console.log('Service Worker Activated');
    //Remove unwanted caches

    e.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames.map(cache => {
                    if (cache !== cacheName) {
                        console.log('Service Worker: Clearing Old Cache');
                        return caches.delete(cache)
                    }
                })
            );
        })
    )
});

//cal fetch event

self.addEventListener('fetch', e => {
    console.log('Service Worker: Fetching...');
    e.respondWith(
        // fetch(e.request).catch(() => caches.match(e.request))
        fetch(e.request)
        .then(res => {
            //clone response
            const resClone = res.clone();
            //open cache
            caches.open(cacheName)
            .then(cache => {
                //Add Response to cache
                cache.put(e.request, resClone);
            });
            return res;
        }).catch(err => caches.match(e.request).then(res => res))
    )
})
var cacheName="comexperu";
var currentCacheNames = [ cacheName];
var fileToCache = [];

self.addEventListener('install',function(e){
  console.log('serviceWorker Install');
  e.waitUntil(
    caches.open(cacheName).then(function(cache){
      console.log('serviceWorker Caching app shell');
      return cache.addAll(fileToCache);
    })
  );
});

self.addEventListener('activate', function(e) {
  console.log('[ServiceWorker] Activate');
  e.waitUntil(
    caches.keys().then(function(keyList) {
      return Promise.all(keyList.map(function(key) {
        if (key !== cacheName) {
          console.log('[ServiceWorker] Removing old cache', key);
          return caches.delete(key);
        }
      }));
    })
  );
  return self.clients.claim();
});



// ------------------------------------------------------
//                   FETCH ANTERIOR
// ------------------------------------------------------

//   self.addEventListener('fetch', function(event) {
//     console.log("fetch");
//   event.respondWith(
//     caches.open(cacheName).then(function(cache) {
//       return cache.match(event.request).then(function(response) {
//         var fetchPromise = fetch(event.request).then(function(networkResponse) {
//           cache.put(event.request, networkResponse.clone());
//           return networkResponse;
//         })
//         return response || fetchPromise;
//       })
//     })
//   );
// });

var isMobile = {
     Android: function() {
         return navigator.userAgent.match(/Android/i);
     },
     BlackBerry: function() {
         return navigator.userAgent.match(/BlackBerry/i);
     },
     iOS: function() {
         return navigator.userAgent.match(/iPhone|iPad|iPod/i);
     },
     Opera: function() {
         return navigator.userAgent.match(/Opera Mini/i);
     },
     Windows: function() {
         return navigator.userAgent.match(/IEMobile/i);
     },
     any: function() {
         return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
     }
 };
 if(isMobile.any()) {
   console.log('fetchcache');
    self.addEventListener('fetch', function(event) {
      event.respondWith(
        caches.open(cacheName).then(function(cache) {
          return fetch(event.request).then(function(response) {
            cache.put(event.request, response.clone());
            return response;
          }).catch(function() {
                return caches.match(event.request);
          })
        })
      );
    });
    }
// self.addEventListener('fetch', function(event) {
//   console.log('fetch');
//   event.respondWith(
//       fetch(event.request).then(function(response) {
//           return response;
//           caches.open(cacheName).then(function(cache) {
//             console.log('cache');
//             cache.put(event.request, response.clone());
//           });
//     }).catch(function() {
//       return caches.match(event.request);
//     })
//   );
// });







// ----------------------------------------------------------------------
//                               EVENTO PUSH
// ----------------------------------------------------------------------

var linknotificacion;

self.addEventListener('push', function(event) {
  if (event.data) {
    var data = event.data.json();
    self.registration.showNotification(data.title,{
      body: data.body,
      icon: data.icon
    });
    console.log('This push event has data: ', event.data.text());
    linknotificacion=data.actions[0].action;
  } else {
    console.log('This push event has no data.');
  }
});

// ----------------------------------------------------------------------
//                           click  EVENTO PUSH
// ----------------------------------------------------------------------

self.addEventListener('notificationclick', function(event) {
  console.log(linknotificacion);
  console.log('[Service Worker] Notification click Received.');
  event.notification.close();

  event.waitUntil(
    clients.openWindow(linknotificacion)
  );
});

// ----------------------------------------------------------------------
//                           BANNER PWA
// ----------------------------------------------------------------------


// window.addEventListener('beforeinstallprompt', function(e) {
//   // beforeinstallprompt Event fired
//
//   // e.userChoice will return a Promise.
//   // For more details read: https://developers.google.com/web/fundamentals/getting-started/primers/promises
//   e.userChoice.then(function(choiceResult) {
//
//     console.log(choiceResult.outcome);
//
//     if(choiceResult.outcome == 'dismissed') {
//       console.log('User cancelled home screen install');
//     }
//     else {
//       console.log('User added to home screen');
//     }
//   });
// });
//
//
// var deferredPrompt;
//
// window.addEventListener('beforeinstallprompt', function(e) {
//   console.log('beforeinstallprompt Event fired');
//   e.preventDefault();
//
//   // Stash the event so it can be triggered later.
//   deferredPrompt = e;
//
//   return false;
// });
//
// btnSave.addEventListener('click', function() {
//   if(deferredPrompt !== undefined) {
//     // The user has had a postive interaction with our app and Chrome
//     // has tried to prompt previously, so let's show the prompt.
//     deferredPrompt.prompt();
//
//     // Follow what the user has done with the prompt.
//     deferredPrompt.userChoice.then(function(choiceResult) {
//
//       console.log(choiceResult.outcome);
//
//       if(choiceResult.outcome == 'dismissed') {
//         console.log('User cancelled home screen install');
//       }
//       else {
//         console.log('User added to home screen');
//       }
//
//       // We no longer need the prompt.  Clear it up.
//       deferredPrompt = null;
//     });
//   }
// });
//
// window.addEventListener('beforeinstallprompt', function(e) {
//   console.log('beforeinstallprompt Event fired');
//   e.preventDefault();
//   return false;
// });

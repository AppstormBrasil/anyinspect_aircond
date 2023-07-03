const CACHE = 'Any-v1.1'; // name of the current cache
const OFFLINE = '/assets/fonts'; // URL to offline HTML document
const OFFLINE2 = '/assets/img'; // URL to offline HTML document

const AUTO_CACHE = [ // URLs of assets to immediately cache
  'index.html',
  'pages/atividade-grupo.html',
  'pages/atividade.html',
  'pages/calendario.html',
  'pages/comments-atividade.html',
  'pages/dashboard.html',
  'pages/forgot-password.html',
  'pages/gps-signin.html',
  'pages/imagem-atividade.html',
  'pages/info_ativo.html',
  'pages/manuais.html',
  'pages/new_image.html',
  'pages/nova-imagem.html',
  'pages/pa-atividade.html',
  'pages/qr-info.html',
  'pages/qr-signin.html',
  'pages/sign-in.html',
  'pages/signature-page-user.html',
  'pages/signature-page.html',
  'pages/userprofile.html',
  'assets/css/framework7.bundle.min.css',
  'assets/css/framework7-icons.css',
  'assets/plugins/fontawesome2/css/font-awesome.css',
  'assets/css/style.min.css',
  'assets/css/leaflet.min.css',
  'assets/js/jquery-3.5.1.min.js',
  'assets/js/qr/html5-qrcode.min.js',
  'assets/js/qr/qrcode.min.js',
  'assets/js/framework7.bundle.min.js',
  'assets/js/Utils.js',
  'assets/js/web-animations.min.js',
  'assets/js/animatelo.min.js',
  'assets/js/jq-signature.min.js',
  'assets/js/signature_pad.min.js',
  'assets/js/leaflet.js',
  'assets/js/apex/apexcharts.min.js',
  'voice/pi.wav',
  'voice/pi2.wav',
  'assets/img/icons/arrow.png',
  'assets/img/icons/send-message.png',
  'assets/img/icons/search.png',
  'assets/img/load_cont.gif',
  'assets/img/no_image.jpg',
];

// Iterate AUTO_CACHE and add cache each entry
self.addEventListener('install', event => {
  event.waitUntil(
    caches.open(CACHE)
      .then(cache => cache.addAll(AUTO_CACHE))
      .then(self.skipWaiting())
  );
});

// Destroy inapplicable caches
self.addEventListener('activate', event => {
  event.waitUntil(
    caches.keys().then(cacheNames => {
      return cacheNames.filter(cacheName => CACHE !== cacheName);
    }).then(unusedCaches => {
      console.log('DESTROYING CACHE', unusedCaches.join(','));
      return Promise.all(unusedCaches.map(unusedCache => {
        return caches.delete(unusedCache);
      }));
    }).then(() => self.clients.claim())
  );
});


self.addEventListener('push', event => {
  let body;

  if (event.data) {
    body = event.data.text();
  } else {
    body = 'Mensagem AnyInspect';
  }

  const options = {
    body: body,
    icon: 'assets/img/logo.png',
    vibrate: [100, 50, 100],
    data: {
      dateOfArrival: Date.now(),
      primaryKey: 1
    },
    actions: [
      {action: 'explore', title: 'Visualizar Mensagem',
        icon: 'images/checkmark.png'},
      {action: 'close', title: 'Fechar Notificação',
        icon: 'images/xmark.png'},
    ]
  };

  event.waitUntil(
    self.registration.showNotification('Mensagem AnyInspect', options)
  );
});

self.addEventListener('notificationclick', function(event) {
  console.log('[Service Worker] Notification click Received.');
  event.notification.close();
  event.waitUntil(
    clients.openWindow('https://tecnoair.appstorm.online/')
  );
});


self.addEventListener('fetch', event => {
  if (!event.request.url.startsWith(self.location.origin) || event.request.method !== 'GET') {
    // External request, or POST, ignore
    return void event.respondWith(fetch(event.request));
  }

  event.respondWith(
    // Always try to download from server first
    fetch(event.request).then(response => {
      caches.open(CACHE).then(cache => {
        cache.put(event.request, response)
      });
      return response.clone();
    }).catch((_err) => {
      return caches.match(event.request).then(cachedResponse => {
        if (cachedResponse) {
          return cachedResponse;
        }
        return caches.open(CACHE).then((cache) => {
          const offlineRequest = new Request(OFFLINE);
          return cache.match(offlineRequest);
        });
      
      });
    })
  );
});


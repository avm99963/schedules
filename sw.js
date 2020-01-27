var CACHE_NAME = 'linia-cache-v1';
var urlsToCache = [
  '.',
  'js/index.js',
  'css/index.css',
  'info.php?view=0',
  'info.php?view=1',
  'js/views/l9n.js',
  'css/views/l9n.css'
];

self.addEventListener('install', function(event) {
  // Perform install steps
  event.waitUntil(
    caches.open(CACHE_NAME).then(cache => {
      return cache.addAll(urlsToCache);
    })
  );
});

self.addEventListener('fetch', function(event) {
  var request = event.request;
  var url = new URL(request.url);
  url.searchParams.delete("station");
  request = new Request(url.toString());

  event.respondWith(
    caches.match(request).then(response => {
      // Cache hit - return response
      if (response) {
        return response;
      }

      return fetch(event.request);
    }).catch(err => {
      console.error(err);
    })
  );
});

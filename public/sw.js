/*
 | Service worker Portal Syifa.
 | Sengaja minimal: semua request tetap ke jaringan (data portal harus selalu
 | terbaru). Halaman beranda disimpan hanya sebagai cadangan saat offline.
 */

const CACHE = 'portal-shell-v1';
const START_URL = new URL('./', self.location).href;

self.addEventListener('install', (event) => {
    event.waitUntil(
        caches.open(CACHE)
            .then((cache) => cache.add(START_URL))
            .catch(() => {})
            .then(() => self.skipWaiting())
    );
});

self.addEventListener('activate', (event) => {
    event.waitUntil(
        caches.keys()
            .then((keys) => Promise.all(
                keys.filter((key) => key !== CACHE).map((key) => caches.delete(key))
            ))
            .then(() => self.clients.claim())
    );
});

self.addEventListener('fetch', (event) => {
    if (event.request.mode !== 'navigate') {
        return;
    }

    event.respondWith(
        fetch(event.request).catch(() =>
            caches.match(START_URL).then((cached) => cached || Response.error())
        )
    );
});

/**
 * Copyright 2016 Google Inc. All rights reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
*/

// DO NOT EDIT THIS GENERATED OUTPUT DIRECTLY!
// This file should be overwritten as part of your build process.
// If you need to extend the behavior of the generated service worker, the best approach is to write
// additional code and include it using the importScripts option:
//   https://github.com/GoogleChrome/sw-precache#importscripts-arraystring
//
// Alternatively, it's possible to make changes to the underlying template file and then use that as the
// new base for generating output, via the templateFilePath option:
//   https://github.com/GoogleChrome/sw-precache#templatefilepath-string
//
// If you go that route, make sure that whenever you update your sw-precache dependency, you reconcile any
// changes made to this original template file with your modified copy.

// This generated service worker JavaScript will precache your site's resources.
// The code needs to be saved in a .js file at the top-level of your site, and registered
// from your pages in order to be used. See
// https://github.com/googlechrome/sw-precache/blob/master/demo/app/js/service-worker-registration.js
// for an example of how you can register this script and handle various service worker events.

/* eslint-env worker, serviceworker */
/* eslint-disable indent, no-unused-vars, no-multiple-empty-lines, max-nested-callbacks, space-before-function-paren, quotes, comma-spacing */
'use strict';

var precacheConfig = [["barcode.php", "93e3f358d0b3dc7eb52e3a99c490f570"], ["barcode/barcode.php", "63d407ca24330716246fa2adc706db49"], ["barcode/generate.php", "2e458f4bb553708509db5a9c48884b2f"], ["barcode/index.php", "6bc1a35f2be8e4bacf9569a80a44ac26"], ["barcode/print.php", "98d084c03207b86c1923669169bc7221"], ["barcode/slike/kutije/792.png", "4b82d2a3a5069587cbeb89fae5534ec4"], ["barcode/slike/logo.png", "09f699e43319c8b3e3be5648538e62b9"], ["barcode/style.css", "60a7c7ae9ef6137875e5d46b634cdeba"], ["composer.json", "68f2978ce81bcf1c223e07fca171e3f5"], ["composer.lock", "70b253d5c9c48aa163a5f3eb54bf5766"], ["conn.php", "e40e74d7e79a47040c9e8bd907d7c793"], ["dodajkutiju.php", "0eada5f5bb793ef575b56dbfb0864a39"], ["dodajpaletu.php", "836a9f5920790bb60df65893ad73ddb9"], ["dodajregal.php", "270cce863f119b611032c2d414e1208d"], ["historija.php", "d41d8cd98f00b204e9800998ecf8427e"], ["ikone/arrow.png", "cfbc6c305c365a84b6aa38fb09de419a"], ["ikone/artikal.png", "3d4dfb614779590f04b5ab5d1f1f3589"], ["ikone/artikalkutija.png", "c9d440919fcd236ce9cdb12a184e77f6"], ["ikone/artikalpaleta.png", "754a345f3a1a319112417c9a55858788"], ["ikone/artikalpaletaa.png", "38f11a687b4da89f6a903489144e00b6"], ["ikone/artikalregal.png", "5283141b8747352cec18e59b53ac64a8"], ["ikone/hala.png", "bd694377226e8c55f06f9793306bfdd5"], ["ikone/ikona1.png", "a391c117627a5577f803a634faf7c798"], ["ikone/ikona10.png", "9ad7a74f626610ffaac0c5271832829d"], ["ikone/ikona11.png", "3f10f5620a8d8020daa30d844a379e7a"], ["ikone/ikona2.png", "0d6c799a33b6a62be88bf5510c7b39ff"], ["ikone/ikona3.png", "621f2a710be9fe81b591da2e189ab555"], ["ikone/ikona4.png", "f84cdb7debcc1add3ce21e293f5d446b"], ["ikone/ikona5.png", "3053af3f6409fde816080f1757d1fb5a"], ["ikone/ikona6.png", "fe819286be7d9a4551b423374b1d37fa"], ["ikone/ikona7.png", "fe819286be7d9a4551b423374b1d37fa"], ["ikone/ikona8.png", "fc15a1779e7a78365f72628c8ee4fd0c"], ["ikone/ikona9.png", "fc15a1779e7a78365f72628c8ee4fd0c"], ["ikone/izvjestaj.png", "5a84b7dda08830fe5b2264f6ff500834"], ["ikone/kutija.png", "ce79b76810c0f43edd17286612d66731"], ["ikone/kutijapaleta.png", "3d8db856ac17eb06c38b445a6ee68e60"], ["ikone/kutijaregal.png", "9ada38ba9db923787e9c147bbad389aa"], ["ikone/nazad.png", "5672875617d16f69bb63a77b8244592b"], ["ikone/paleta.png", "bc265c98ea990479a00fb67d694592c9"], ["ikone/paletaregal.png", "e4a71ea354218c9c8574a53b2de9b7dd"], ["ikone/postavke.png", "4008c5acda0e7eb33df4276ba161f6d0"], ["ikone/pretraga.png", "2aaa6f1be965eb98de80e55286525ff6"], ["ikone/regal.png", "7f8de3a1c86d681919d58388af9428d0"], ["ikone/regalkutija.png", "d0652f7309a9c80538ab40ff9dd41c23"], ["ikone/regalregal.png", "16b9852880cbaa6373d0de2803fc1935"], ["ikone/temp.png", "f029c9981300d14bb2bbe51b85a3c281"], ["index.php", "6e12ff8b194d61ec3a8a20b8ad433b14"], ["izvjestaj.php", "d41d8cd98f00b204e9800998ecf8427e"], ["koncept.txt", "29b29559a125f89ab1368dd01c6795ef"], ["kutija.css", "356652410c8b981d6a8dbc14828767ef"], ["kutija.php", "55cb088979cea7cd666621782ad35f2e"], ["login.php", "c76b50b0a0773d3c98ac4e092151e4de"], ["login_logika.php", "75b4e5ecc3ac51bc4bd084e027ef19af"], ["login_style.css", "dbfe65c0942895aa38fd6bc8fe850ea8"], ["logout.php", "abbed5eb9ab746a02536a73a16014b35"], ["manfest.json", "45861a6ac5676470cf7cde293c84e4ed"], ["odjava.php", "d41d8cd98f00b204e9800998ecf8427e"], ["paleta.php", "ad961da2948433fae2bb946bbf510f07"], ["postavke.php", "d41d8cd98f00b204e9800998ecf8427e"], ["premjestanje.php", "81aca80cde786ccadcea6ab2f768db33"], ["premjestanje/artikalkutija.php", "ad1b08226639d3f0a26ddea77e481e5d"], ["premjestanje/logika/artikalkutija.php", "76ce741eb53342c95cefe25510b91d40"], ["premjestanje/style.css", "1f522a6092086a70dd9034ce03c578f7"], ["pretraga.php", "d41d8cd98f00b204e9800998ecf8427e"], ["qrcode.php", "ec94622145ef66f5ed1e9e16b11f7a05"], ["racun.php", "d41d8cd98f00b204e9800998ecf8427e"], ["radnik.php", "d41d8cd98f00b204e9800998ecf8427e"], ["regal.php", "007b265e6d5e1fda374f9c9522305f14"], ["save.php", "ac162eb96f1eadb9b45a8d35114c5fa5"], ["script.js", "aced5a5edbf60a3415ec778e5a1f3b02"], ["slike/logo.png", "09f699e43319c8b3e3be5648538e62b9"], ["smjena.php", "d41d8cd98f00b204e9800998ecf8427e"], ["styles.css", "a15b18151c2cecc4227bf241738a0b40"], ["unos.php", "1dbd9b542f11fb28d149267766f2d2d1"], ["unosArtikla.php", "ade2100207eb00d8801dacc2d0f6250c"], ["unosHale.php", "3b8be294df03686cc5527d41369aa376"], ["unosKutije.php", "da37deab396b970b968ef6a0d8f970d0"], ["unosPalete.php", "53ac356c5becba8f19507ca90334af66"], ["unosRegala.php", "91006efd5f2e88c8f1235a8d4534ba2a"], ["vendor/composer/ClassLoader.php", "c02be6d96671f88d28aad3ffa134c8ae"], ["vendor/composer/InstalledVersions.php", "182d5924ff0b528f008a83d1f5809d02"], ["vendor/composer/autoload_classmap.php", "5615b29a1f5688414d56a1515d954a91"], ["vendor/composer/autoload_namespaces.php", "224007c97efb82c7b45b0e92f240af41"], ["vendor/composer/autoload_psr4.php", "f6e543ffcdfb642e2ebc81a759dcfc75"], ["vendor/composer/autoload_real.php", "b41141dfe60e8e998c37429bbe2d9d00"], ["vendor/composer/autoload_static.php", "363694a1d77afffcd6de4d04ff7f4181"], ["vendor/composer/installed.json", "f58f22b9947a91e51b9ceec8664c4c91"], ["vendor/composer/installed.php", "0875ab90c548e485ff0f0b386fefb62d"], ["vendor/composer/platform_check.php", "f3aa60e94ab1f27ada6ee4c37ec41cd0"], ["vendor/container-interop/container-interop/README.md", "a950808c5e0eda159f4d5274b3992177"], ["vendor/container-interop/container-interop/composer.json", "44cb4895f2d451d2edfb5cee23af187a"], ["vendor/container-interop/container-interop/docs/ContainerInterface-meta.md", "2ed555cf50dd31245e5c6f4df20b9e7a"], ["vendor/container-interop/container-interop/docs/ContainerInterface.md", "2b2deb44973f35f23d1b5b523572a55f"], ["vendor/container-interop/container-interop/docs/Delegate-lookup-meta.md", "b16790ab12a633c6ec66dd0d6a81694e"], ["vendor/container-interop/container-interop/docs/Delegate-lookup.md", "59ddb12dee345fdd9c3e6bdedca26d7c"], ["vendor/container-interop/container-interop/docs/images/interoperating_containers.png", "122912be5695a1bf566893d9b0352ff5"], ["vendor/container-interop/container-interop/docs/images/priority.png", "120b2c7c1e0b72fcd3857dec9598e29d"], ["vendor/container-interop/container-interop/docs/images/side_by_side_containers.png", "f37868e897c3984e87c5b3567b82b089"], ["vendor/container-interop/container-interop/src/Interop/Container/ContainerInterface.php", "4f79e07574d3dac64bdb533ab5d042d7"], ["vendor/container-interop/container-interop/src/Interop/Container/Exception/ContainerException.php", "ffcdc43f36fc0e4059e38a74556360c5"], ["vendor/container-interop/container-interop/src/Interop/Container/Exception/NotFoundException.php", "17e1c040e0dc5a1ca06d92a34fb8774c"], ["vendor/psr/container/README.md", "a5ea5b4c0d40c6efe15a38e01b2dfc35"], ["vendor/psr/container/composer.json", "a3ce98fae7b3e59240a1eb1c853429b7"], ["vendor/psr/container/src/ContainerExceptionInterface.php", "3a46c5e6a407e9fe5d88c95965b945b3"], ["vendor/psr/container/src/ContainerInterface.php", "92acc5bc9b91c9d86ba7acce85386ccc"], ["vendor/psr/container/src/NotFoundExceptionInterface.php", "625acbd6fc8bbdc39c34e3a99047894a"]];
var cacheName = 'sw-precache-v3-sw-precache-' + (self.registration ? self.registration.scope : '');


var ignoreUrlParametersMatching = [/^utm_/];



var addDirectoryIndex = function (originalUrl, index) {
  var url = new URL(originalUrl);
  if (url.pathname.slice(-1) === '/') {
    url.pathname += index;
  }
  return url.toString();
};

var cleanResponse = function (originalResponse) {
  // If this is not a redirected response, then we don't have to do anything.
  if (!originalResponse.redirected) {
    return Promise.resolve(originalResponse);
  }

  // Firefox 50 and below doesn't support the Response.body stream, so we may
  // need to read the entire body to memory as a Blob.
  var bodyPromise = 'body' in originalResponse ?
    Promise.resolve(originalResponse.body) :
    originalResponse.blob();

  return bodyPromise.then(function (body) {
    // new Response() is happy when passed either a stream or a Blob.
    return new Response(body, {
      headers: originalResponse.headers,
      status: originalResponse.status,
      statusText: originalResponse.statusText
    });
  });
};

var createCacheKey = function (originalUrl, paramName, paramValue,
  dontCacheBustUrlsMatching) {
  // Create a new URL object to avoid modifying originalUrl.
  var url = new URL(originalUrl);

  // If dontCacheBustUrlsMatching is not set, or if we don't have a match,
  // then add in the extra cache-busting URL parameter.
  if (!dontCacheBustUrlsMatching ||
    !(url.pathname.match(dontCacheBustUrlsMatching))) {
    url.search += (url.search ? '&' : '') +
      encodeURIComponent(paramName) + '=' + encodeURIComponent(paramValue);
  }

  return url.toString();
};

var isPathWhitelisted = function (whitelist, absoluteUrlString) {
  // If the whitelist is empty, then consider all URLs to be whitelisted.
  if (whitelist.length === 0) {
    return true;
  }

  // Otherwise compare each path regex to the path of the URL passed in.
  var path = (new URL(absoluteUrlString)).pathname;
  return whitelist.some(function (whitelistedPathRegex) {
    return path.match(whitelistedPathRegex);
  });
};

var stripIgnoredUrlParameters = function (originalUrl,
  ignoreUrlParametersMatching) {
  var url = new URL(originalUrl);
  // Remove the hash; see https://github.com/GoogleChrome/sw-precache/issues/290
  url.hash = '';

  url.search = url.search.slice(1) // Exclude initial '?'
    .split('&') // Split into an array of 'key=value' strings
    .map(function (kv) {
      return kv.split('='); // Split each 'key=value' string into a [key, value] array
    })
    .filter(function (kv) {
      return ignoreUrlParametersMatching.every(function (ignoredRegex) {
        return !ignoredRegex.test(kv[0]); // Return true iff the key doesn't match any of the regexes.
      });
    })
    .map(function (kv) {
      return kv.join('='); // Join each [key, value] array into a 'key=value' string
    })
    .join('&'); // Join the array of 'key=value' strings into a string with '&' in between each

  return url.toString();
};


var hashParamName = '_sw-precache';
var urlsToCacheKeys = new Map(
  precacheConfig.map(function (item) {
    var relativeUrl = item[0];
    var hash = item[1];
    var absoluteUrl = new URL(relativeUrl, self.location);
    var cacheKey = createCacheKey(absoluteUrl, hashParamName, hash, false);
    return [absoluteUrl.toString(), cacheKey];
  })
);

function setOfCachedUrls(cache) {
  return cache.keys().then(function (requests) {
    return requests.map(function (request) {
      return request.url;
    });
  }).then(function (urls) {
    return new Set(urls);
  });
}

self.addEventListener('install', function (event) {
  event.waitUntil(
    caches.open(cacheName).then(function (cache) {
      return setOfCachedUrls(cache).then(function (cachedUrls) {
        return Promise.all(
          Array.from(urlsToCacheKeys.values()).map(function (cacheKey) {
            // If we don't have a key matching url in the cache already, add it.
            if (!cachedUrls.has(cacheKey)) {
              var request = new Request(cacheKey, { credentials: 'same-origin' });
              return fetch(request).then(function (response) {
                // Bail out of installation unless we get back a 200 OK for
                // every request.
                if (!response.ok) {
                  throw new Error('Request for ' + cacheKey + ' returned a ' +
                    'response with status ' + response.status);
                }

                return cleanResponse(response).then(function (responseToCache) {
                  return cache.put(cacheKey, responseToCache);
                });
              });
            }
          })
        );
      });
    }).then(function () {

      // Force the SW to transition from installing -> active state
      return self.skipWaiting();

    })
  );
});

self.addEventListener('activate', function (event) {
  var setOfExpectedUrls = new Set(urlsToCacheKeys.values());

  event.waitUntil(
    caches.open(cacheName).then(function (cache) {
      return cache.keys().then(function (existingRequests) {
        return Promise.all(
          existingRequests.map(function (existingRequest) {
            if (!setOfExpectedUrls.has(existingRequest.url)) {
              return cache.delete(existingRequest);
            }
          })
        );
      });
    }).then(function () {

      return self.clients.claim();

    })
  );
});


self.addEventListener('fetch', function (event) {
  if (event.request.method === 'GET') {
    // Should we call event.respondWith() inside this fetch event handler?
    // This needs to be determined synchronously, which will give other fetch
    // handlers a chance to handle the request if need be.
    var shouldRespond;

    // First, remove all the ignored parameters and hash fragment, and see if we
    // have that URL in our cache. If so, great! shouldRespond will be true.
    var url = stripIgnoredUrlParameters(event.request.url, ignoreUrlParametersMatching);
    shouldRespond = urlsToCacheKeys.has(url);

    // If shouldRespond is false, check again, this time with 'index.html'
    // (or whatever the directoryIndex option is set to) at the end.
    var directoryIndex = 'index.html';
    if (!shouldRespond && directoryIndex) {
      url = addDirectoryIndex(url, directoryIndex);
      shouldRespond = urlsToCacheKeys.has(url);
    }

    // If shouldRespond is still false, check to see if this is a navigation
    // request, and if so, whether the URL matches navigateFallbackWhitelist.
    var navigateFallback = '';
    if (!shouldRespond &&
      navigateFallback &&
      (event.request.mode === 'navigate') &&
      isPathWhitelisted([], event.request.url)) {
      url = new URL(navigateFallback, self.location).toString();
      shouldRespond = urlsToCacheKeys.has(url);
    }

    // If shouldRespond was set to true at any point, then call
    // event.respondWith(), using the appropriate cache key.
    if (shouldRespond) {
      event.respondWith(
        caches.open(cacheName).then(function (cache) {
          return cache.match(urlsToCacheKeys.get(url)).then(function (response) {
            if (response) {
              return response;
            }
            throw Error('The cached response that was expected is missing.');
          });
        }).catch(function (e) {
          // Fall back to just fetch()ing the request if some unexpected error
          // prevented the cached response from being valid.
          console.warn('Couldn\'t serve response for "%s" from cache: %O', event.request.url, e);
          return fetch(event.request);
        })
      );
    }
  }
});








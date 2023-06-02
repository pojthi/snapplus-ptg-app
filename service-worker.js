self.addEventListener("install", function(event) {
	event.waitUntil(
		caches.open("webtime").then(function(cache) {
			return cache.addAll([
				"index.php",
				"hr.php",
				"manager.php",
				"report-hr-activity.php",
				"report-hr.php",
				"report.php",
				"saveimage-config.php",
				"saveimage-rpt.php",
				"saveimage.php"	
			]);
		})
	);
});

self.addEventListener('fetch', function(event) {
  if (event.request.clone().method === 'GET') {
    event.respondWith(
      // check all the caches in the browser and find
      // out whether our request is in any of them
      caches.match(event.request.clone())
        .then(function(response) {
          if (response) {
            // if we are here, that means there's a match
            //return the response stored in browser
            return response;
          }
          // no match in cache, use the network instead
          return fetch(event.request.clone());
        }
      )
    );
  } else if (event.request.clone().method === 'POST') {
	//Check if online or offline
	//offline save datato indexDB	
    event.respondWith(fetch(event.request.clone()).catch(function(error) {
		//Offline Save To IndexDb
		savePostRequests(event.request.clone().url, form_data);
	}))
  }
});

self.addEventListener('message', function (event) {
	//console.log('form data =============>', event.data)
	if (event.data.hasOwnProperty('form_data')) {
	  form_data = event.data.form_data
	}
  })

  self.addEventListener('sync', function (event) {
	console.log('now online')
	if (event.tag === 'sendFormData') { // event.tag name checked
	  // here must be the same as the one used while registering
	  // sync
	  event.waitUntil(
		// Send our POST request to the server, now that the user is
		// online
		sendPostToServer()
		)
	}
	else {
		console.log('Offline')	
	}
  })

function sendPostToServer () {
	var savedRequests = []
	let FOLDER_NAME = 'WEB_TIME_DB';
	var req = getObjectStore(FOLDER_NAME).openCursor() // FOLDERNAME DB 
	req.onsuccess = async function (event) {
		var cursor = event.target.result
	 if (cursor) {
	  // Keep moving the cursor forward and collecting saved
	  // requests.
	  savedRequests.push(cursor.value)
		cursor.continue()
	 } else {
	   // At this point, we have collected all the post requests in
	   // indexedb.
	   for (let savedRequest of savedRequests) {
		 // send them to the server one after the other
		 console.log('saved request', savedRequest)
		 var requestUrl = savedRequest.url
		 var payload = JSON.stringify(savedRequest.payload)
		 var method = savedRequest.method
		 var headers = {
		   'Accept': 'application/json',
		   'Content-Type': 'application/json'
		 } // if you have any other headers put them here
		 fetch(requestUrl, {
		   headers: headers,
		   method: method,
		   body: payload
		 }).then(function (response) {
		   console.log('server response', response)
		   if (response.status < 400) {
			// If sending the POST request was successful, then
			// remove it from the IndexedDB.
			getObjectStore(FOLDER_NAME,'readwrite').delete(savedRequest.id)
		   } 
		}).catch(function (error) {
		   // This will be triggered if the network is still down. 
		  // The request will be replayed again
		 // the next time the service worker starts up.
		 console.error('Send to Server failed:', error)
		  // since we are in a catch, it is important an error is
		  //thrown,so the background sync knows to keep retrying 
		  // the send to server
		  throw error
		})
	   }
	  }
	}
  }

  function getObjectStore (storeName, mode) {
	// retrieve our object store
	return our_db.transaction(storeName,mode
	 ).objectStore(storeName)
  }
  function savePostRequests (url, payload) {
	// get object_store and save our payload inside it
	let FOLDER_NAME = 'WEB_TIME_DB';
	var request = getObjectStore(FOLDER_NAME, 'readwrite').add({
	  url: url,
	  payload: payload,
	  method: 'POST'
	})
	request.onsuccess = function (event) {
	  console.log('a new pos_ request has been added to indexedb')
	}
	request.onerror = function (error) {
	  console.error(error)
	}
  }  


  function openDatabase () {
	let IDB_VERSION = '1';
	var indexedDBOpenRequest = indexedDB.open('flask-form',IDB_VERSION)
	indexedDBOpenRequest.onerror = function (error) {
	  console.error('IndexedDB error:', error)
	}
   indexedDBOpenRequest.onupgradeneeded = function () {
	   this.result.createObjectStore('WEB_TIME_DB', {
		   autoIncrement:  true, keyPath: 'id' })
   }
	// This will execute each time the database is opened.
	indexedDBOpenRequest.onsuccess = function () {
		our_db = this.result
	}
  }
  var form_data
  var our_db
  openDatabase()  

if ('serviceWorker' in navigator) {
	window.addEventListener('load', () => {
		navigator.serviceWorker.register('service-worker.js').then(registration => {
			console.log('Service Worker is registered', registration);
		}).catch(err => {
			console.error('Registration failed:', err);
		});
		
		navigator.serviceWorker.ready.then(function(registration) {
			console.log('Service Worker Ready')
			return registration.sync.register('sendFormData')
		}).then(function () {
			console.log('sync event registered')
		}).catch(function() {
			console.log('sync registration failed')
		});	

		if (navigator.onLine) {
			console.log('Service Worker Online')
		}else
		{
			console.log('Service Worker Offline')
		}
	});
}
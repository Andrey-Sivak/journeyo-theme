(function () {
	import('./Header.js').then(({ default: Header }) => new Header());
	import('./Footer.js').then(({ default: Footer }) => new Footer());
})();

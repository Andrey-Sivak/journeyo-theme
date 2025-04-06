(function () {
	const elements = {
		footer: document.querySelector(
			'.wp-block-journeyo-hero-section__header',
		),
		header: document.querySelector('.wp-block-journeyo-footer'),
		form: document.querySelector('.wpcf7-form'),
	};

	if (elements.header) {
		import('./Header.js').then(({ default: Header }) => new Header());
	}

	if (elements.form) {
		import('./Form.js').then(({ default: Form }) => new Form());
	}

	if (elements.footer) {
		import('./Footer.js').then(({ default: Footer }) => new Footer());
	}
})();

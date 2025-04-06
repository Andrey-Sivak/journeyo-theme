class Form {
	form = null;
	submitBtn = null;
	formUID = null;
	loaderContainer = null;
	successContainer = null;

	constructor() {
		this.block = document.querySelector('.wp-block-journeyo-form-section');
		if (!this.block) return;

		this.form = this.block.querySelector('.wpcf7-form');
		if (!this.form) return;

		this.submitBtn = this.form.querySelector('input[type="submit"]');
		this.formUID = this.form.getAttribute('action').substring(1);
		this.loaderContainer = this.form.querySelector('.jn-form-loading');
		this.successContainer = this.form.querySelector('.jn-form-success');

		this.init();
	}

	init() {
		this.submitBtn.addEventListener('click', () => {
			this.block.classList.add('loading');
		});

		document.addEventListener('wpcf7mailsent', (e) => {
			const formUID = e.detail.apiResponse.into;

			if (formUID !== this.formUID) return;

			this.handleSuccess();
		});
		document.addEventListener('wpcf7mailfailed', (e) => {
			const formUID = e.detail.apiResponse.into;

			if (formUID !== this.formUID) return;

			this.block.classList.remove('loading');
		});
		document.addEventListener('wpcf7invalid', (e) => {
			const formUID = e.detail.apiResponse.into;

			if (formUID !== this.formUID) return;

			this.block.classList.remove('loading');
		});
	}

	handleSuccess() {
		this.block.classList.remove('loading');
		setTimeout(() => {
			this.block.classList.add('success');

			setTimeout(() => {
				this.form.reset();
			}, 250);
		}, 300);
	}
}

export default Form;

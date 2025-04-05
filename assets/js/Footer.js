import scrollToElement from './utils/scrollToElement.js';

class Footer {
	footerEl = document.querySelector('footer.wp-block-journeyo-footer');

	constructor() {
		if (!this.footerEl) return;

		this.menuLinks = this.footerEl.querySelectorAll(
			'.wp-block-journeyo-footer__menu-item',
		);

		this.init();
	}

	init() {
		this.menuLinks.forEach((link) => {
			link.addEventListener('click', scrollToElement);
		});
	}
}

export default Footer;

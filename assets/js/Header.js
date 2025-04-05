import scrollToElement from './utils/scrollToElement.js';

class Header {
	headerEl = document.querySelector(
		'header.wp-block-journeyo-hero-section__header',
	);
	// scrollPrev = 0;

	constructor() {
		if (!this.headerEl) return;

		// this.boundScrollHandler = this.scrollHandler.bind(this);
		// this.menuLinks = this.headerEl.querySelectorAll('.rl-header-menu a');
		this.boundDisplayMobMenuHandler = this.displayMobMenu.bind(this);
		this.mobBurgerBtn = document.querySelector('.mob-burger-btn');
		this.contactUsBtn = document.querySelector(
			'.wp-block-journeyo-hero-section__header-button',
		);
		this.langs = document.querySelector(
			'.wp-block-journeyo-hero-section__header-langs',
		);
		this.activeLang = document.querySelector(
			'.wp-block-journeyo-hero-section__header-langs-active',
		);

		this.init();
	}

	init() {
		// this.boundScrollHandler();
		// window.addEventListener('scroll', this.boundScrollHandler);

		if (this.mobBurgerBtn) {
			this.mobBurgerBtn.addEventListener(
				'click',
				this.boundDisplayMobMenuHandler,
			);
		}

		if (this.contactUsBtn) {
			this.contactUsBtn.addEventListener(
				'click',
				this.scrollToContactSection,
			);
		}

		if (this.activeLang) {
			this.activeLang.addEventListener(
				'click',
				this.displayLangsSwitcher.bind(this),
			);
		}

		window.addEventListener('click', this.closeLangsSwitcher.bind(this));

		// this.menuLinks.forEach((link) => {
		// 	link.addEventListener('click', (e) => {
		// 		scrollToElement(e);
		//
		// 		if (document.body.classList.contains('mob-menu-active')) {
		// 			document.body.classList.remove('mob-menu-active');
		// 		}
		// 	});
		// });
	}

	// isHeaderHide(scrolled) {
	// 	return scrolled > 100 && scrolled > this.scrollPrev;
	// }

	// isHeaderScrolled(scrolled) {
	// 	return scrolled > 100;
	// }

	// scrollHandler() {
	// 	const scrolled = window.scrollY;
	//
	// 	if (this.isHeaderHide(scrolled)) {
	// 		this.headerEl.classList.add('out');
	// 	} else {
	// 		this.headerEl.classList.remove('out');
	// 	}
	//
	// 	if (this.isHeaderScrolled(scrolled)) {
	// 		this.headerEl.classList.add('scrolled');
	// 	} else {
	// 		this.headerEl.classList.remove('scrolled');
	// 	}
	//
	// 	this.scrollPrev = scrolled;
	// }

	displayMobMenu() {
		document.body.classList.toggle('mob-menu-active');
	}

	displayLangsSwitcher() {
		this.langs.classList.toggle('active');
	}

	scrollToContactSection(e) {
		scrollToElement(e);

		if (document.body.classList.contains('mob-menu-active')) {
			document.body.classList.remove('mob-menu-active');
		}
	}

	closeLangsSwitcher(e) {
		if (
			e.target.classList.contains(
				'wp-block-journeyo-hero-section__header-langs-active',
			) ||
			e.target.classList.contains('wpml-flag') ||
			e.target.classList.contains('wpml-lang-code')
		) {
			return;
		}

		if (this.langs.classList.contains('active')) {
			this.langs.classList.remove('active');
		}
	}
}

export default Header;

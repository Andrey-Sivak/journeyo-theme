class Animations {
	observer = null;
	observerPromoBanner = null;
	observerFormSection = null;

	constructor() {
		this.itemsToAnimate = [...document.querySelectorAll('.jn-animate')];
		this.promoBanner = document.querySelector(
			'.wp-block-journeyo-promo-banner-section__wrap-out',
		);
		this.promoBannerPaths = [
			...document.querySelectorAll(
				'.wp-block-journeyo-promo-banner-section__arrow-svg svg path',
			),
		];
		this.locationMarkPaths = [
			...document.querySelectorAll(
				'.wp-block-journeyo-promo-banner-section__location-mark svg path',
			),
		];
		this.allPaths = [...this.promoBannerPaths, ...this.locationMarkPaths];
		this.bannerImg1 = this.promoBanner.querySelector(
			'.wp-block-journeyo-promo-banner-section__image-1',
		);
		this.bannerImg2 = this.promoBanner.querySelector(
			'.wp-block-journeyo-promo-banner-section__image-2',
		);
		this.section = document.querySelector(
			'.wp-block-journeyo-form-section',
		);
		this.arrow = document.querySelector(
			'.wp-block-journeyo-form-section__arrow',
		);
		this.formDecors = [
			...document.querySelectorAll(`
				.wp-block-journeyo-form-section__block-big-rt,
				.wp-block-journeyo-form-section__block-big-lt,
				.wp-block-journeyo-form-section__block-small-rt,
				.wp-block-journeyo-form-section__block-small-lt
			`),
		];

		this.paths = [...this.arrow.querySelectorAll('path')];

		this.initCommonAnimations();
		this.initPromoBannerAnimations();
		this.initFormSectionAnimations();
		this.init();
	}

	initFormSectionAnimations() {
		if (this.paths.length) {
			this.observerFormSection = new IntersectionObserver(
				(entries, observer) => {
					entries.forEach((entry) => {
						if (entry.isIntersecting) {
							if (this.formDecors.length) {
								this.formDecors.forEach((item) => {
									console.log(item);
									item.classList.add('visible');
								});
							}

							const totalDuration = 1500;
							const step = totalDuration / this.paths.length;

							this.paths.forEach((item, index) => {
								setTimeout(() => {
									item.style.opacity = 1;
								}, index * step);
							});
							observer.unobserve(entry.target);
						}
					});
				},
				{
					root: null,
					rootMargin: '0px',
					threshold: 0.5,
				},
			);
		}
	}

	initPromoBannerAnimations() {
		if (this.promoBanner && this.allPaths.length) {
			this.observerPromoBanner = new IntersectionObserver(
				(entries, observer) => {
					entries.forEach((entry) => {
						if (entry.isIntersecting) {
							const totalDuration = 2000;
							const step = totalDuration / this.allPaths.length;

							if (this.bannerImg1) {
								this.bannerImg1.classList.add('animate');
							}
							if (this.bannerImg2) {
								this.bannerImg2.classList.add('animate');
							}

							this.allPaths.forEach((item, index) => {
								setTimeout(() => {
									item.style.opacity = 1;
								}, index * step);
							});
							observer.unobserve(entry.target);
						}
					});
				},
				{
					root: null,
					rootMargin: '0px',
					threshold: 0.5,
				},
			);
		}
	}

	initCommonAnimations() {
		if (this.itemsToAnimate.length) {
			this.observer = new IntersectionObserver(
				(entries, observer) => {
					entries.forEach((entry) => {
						if (entry.isIntersecting) {
							entry.target.classList.add('visible');
							observer.unobserve(entry.target);
						}
					});
				},
				{
					root: null,
					rootMargin: '0px',
					threshold: 0.5,
				},
			);
		}
	}

	init() {
		document.addEventListener('DOMContentLoaded', () => {
			this.itemsToAnimate.forEach((item) => {
				this.observer.observe(item);
			}, this);

			this.observerPromoBanner.observe(this.promoBanner);
			this.observerFormSection.observe(this.section);
		});
	}
}

export default Animations;

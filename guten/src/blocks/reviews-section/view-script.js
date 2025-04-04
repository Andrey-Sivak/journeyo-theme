import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay } from 'swiper/modules';

const config = {
	initSlidesCount: 3,
};

document.addEventListener('DOMContentLoaded', () => {
	const sliders = document.querySelectorAll(
		'.wp-block-journeyo-reviews-section__items',
	);

	sliders.forEach((slider) => {
		const slideCount = slider.querySelectorAll('.swiper-slide').length;

		new Swiper(slider, {
			modules: [Navigation, Pagination, Autoplay],
			slidesPerView: config.initSlidesCount,
			spaceBetween: 30,
			loop: slideCount > config.initSlidesCount + 1,
			// autoplay: {
			// 	delay: 3000,
			// },
			// navigation: {
			// 	nextEl: '.wp-block-journeyo-reviews-section__button-next',
			// 	prevEl: '.wp-block-journeyo-reviews-section__button-prev',
			// },
			pagination: {
				el: '.wp-block-journeyo-reviews-section__pagination',
				clickable: true,
			},
			// breakpoints: {
			// 	320: { slidesPerView: 1 },
			// 	768: { slidesPerView: 2 },
			// 	1024: { slidesPerView: 3 },
			// },
		});
	});
});

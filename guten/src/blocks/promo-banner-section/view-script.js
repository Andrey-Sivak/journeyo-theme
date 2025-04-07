document.addEventListener('DOMContentLoaded', () => {
	const arrowPaths = [
		...document.querySelectorAll(
			'.wp-block-journeyo-promo-banner-section__arrow-svg svg path',
		),
	];

	const locationMarkPaths = [
		...document.querySelectorAll(
			'.wp-block-journeyo-promo-banner-section__location-mark svg path',
		),
	];

	if (!arrowPaths.length && !locationMarkPaths.length) return;

	const allPaths = [...arrowPaths, ...locationMarkPaths];

	// const totalDuration = 2000;
	// const step = totalDuration / allPaths.length;
	//
	// allPaths.forEach((item, index) => {
	// 	setTimeout(() => {
	// 		item.style.opacity = 1;
	// 	}, index * step);
	// });
});

document.addEventListener('DOMContentLoaded', () => {
	const langs = document.querySelector(
		'.wp-block-journeyo-hero-section__header-langs',
	);

	if (!langs) return;

	const activeLang = document.querySelector(
		'.wp-block-journeyo-hero-section__header-langs-active',
	);

	activeLang.addEventListener('click', () => {
		langs.classList.toggle('active');
	});

	window.addEventListener('click', (e) => {
		if (
			e.target.classList.contains(
				'wp-block-journeyo-hero-section__header-langs-active',
			) ||
			e.target.classList.contains('wpml-flag') ||
			e.target.classList.contains('wpml-lang-code')
		) {
			return;
		}

		if (langs.classList.contains('active')) {
			langs.classList.remove('active');
		}
	});
});

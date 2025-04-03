document.addEventListener('DOMContentLoaded', () => {
	const itemsContainer = document.querySelector(
		'.wp-block-journeyo-faq-section__items',
	);

	if (!itemsContainer) return;

	const toggleButtons = itemsContainer.querySelectorAll(
		'.wp-block-journeyo-faq-section__item-toggle',
	);

	toggleButtons.forEach((button) => {
		button.addEventListener('click', () => {
			const isExpanded = button.getAttribute('aria-expanded') === 'true';
			const answerId = button.getAttribute('aria-controls');
			const answer = document.getElementById(answerId);

			if (!answer) return;

			button.setAttribute('aria-expanded', !isExpanded);

			if (isExpanded) {
				answer.style.maxHeight = null;
				answer.style.opacity = '0';
			} else {
				answer.style.maxHeight = answer.scrollHeight + 'px';
				answer.style.opacity = '1';
			}

			const icon = button.querySelector(
				'.wp-block-journeyo-faq-section__item-icon',
			);
			if (icon) {
				icon.style.transform = isExpanded
					? 'rotate(0deg)'
					: 'rotate(180deg)';
			}
		});
	});
});

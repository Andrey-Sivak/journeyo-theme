import { RichText } from '@wordpress/block-editor';
import ImageUploader from '../../utils/ImageUploader.js';
import QuoteIcon from './QuoteIcon.js';
import RemoveButtonCross from '../../utils/RemoveButtonCross.js';
import RatingStar from './RatingStar.js';

const sliderItemConfig = {
	imageUploaderButtonText: 'Select Photo',
	namePlaceholder: 'Name...',
	locationPlaceholder: 'Location...',
	reviewTextPlaceholder: 'Text...',
	emptyRatingWarning: 'Click the stars to set a rating',
};

const SliderItem = ({ item, index, baseClass, updateItem, removeItem }) => {
	const handleRatingClick = (rating) => {
		updateItem(index, 'rating', rating);
	};

	return (
		<div className={`${baseClass}__item`}>
			<div className={`${baseClass}__item-wrap`}>
				<div className={`${baseClass}__item-photo`}>
					<ImageUploader
						buttonText={sliderItemConfig.imageUploaderButtonText}
						image={item.photo.url}
						onSelect={(media) => {
							const photoData = {
								id: media.id,
								url: media.url,
								alt: media.alt || '',
							};

							updateItem(index, 'photo', photoData);
						}}
					/>
				</div>
				<div className={`${baseClass}__item-photo-helper`} />
				<div className={`${baseClass}__item-quote`}>
					<QuoteIcon />
				</div>
				<div className={`${baseClass}__item-quote-helper`} />
				<div className={`${baseClass}__item-content`}>
					<RichText
						tagName="p"
						className={`${baseClass}__item-name`}
						value={item.name}
						onChange={(newName) =>
							updateItem(index, 'name', newName)
						}
						placeholder={sliderItemConfig.namePlaceholder}
					/>
					<RichText
						tagName="p"
						className={`${baseClass}__item-location`}
						value={item.location}
						onChange={(newLocation) =>
							updateItem(index, 'location', newLocation)
						}
						placeholder={sliderItemConfig.locationPlaceholder}
					/>
					<RichText
						tagName="p"
						className={`${baseClass}__item-text`}
						value={item.text}
						onChange={(newText) =>
							updateItem(index, 'text', newText)
						}
						placeholder={sliderItemConfig.reviewTextPlaceholder}
					/>

					<div className={`${baseClass}__item-rating`}>
						{!item.rating && (
							<p className="empty-rating-warn">
								{sliderItemConfig.emptyRatingWarning}
							</p>
						)}
						{[1, 2, 3, 4, 5].map((star) => (
							<RatingStar
								key={star}
								filled={star <= item.rating}
								onClick={() => handleRatingClick(star)}
							/>
						))}
					</div>
					<RemoveButtonCross
						handleClick={() => removeItem(index)}
						color="#000"
					/>
				</div>
			</div>
		</div>
	);
};

export default SliderItem;

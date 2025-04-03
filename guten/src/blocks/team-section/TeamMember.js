import { RichText } from '@wordpress/block-editor';
import ImageUploader from '../../utils/ImageUploader.js';
import RemoveButtonCross from '../../utils/RemoveButtonCross.js';
import DashCircle from './DashCircle.js';

const teamMemberConfig = {
	imageUploaderButtonText: 'Select Photo',
	namePlaceholder: 'Name...',
	positionPlaceholder: 'Position...',
	textPlaceholder: 'Text...',
};

const TeamMember = ({ item, index, baseClass, updateItem, removeItem }) => {
	return (
		<div className={`${baseClass}__item`}>
			<div className={`${baseClass}__item-wrap`}>
				<div className={`${baseClass}__item-photo`}>
					<DashCircle cssClass={`${baseClass}__item-photo-helper`} />
					<ImageUploader
						buttonText={teamMemberConfig.imageUploaderButtonText}
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
				<div className={`${baseClass}__item-content`}>
					<RichText
						tagName="p"
						className={`${baseClass}__item-name`}
						value={item.name}
						onChange={(newName) =>
							updateItem(index, 'name', newName)
						}
						placeholder={teamMemberConfig.namePlaceholder}
					/>
					<RichText
						tagName="p"
						className={`${baseClass}__item-position`}
						value={item.position}
						onChange={(newPosition) =>
							updateItem(index, 'position', newPosition)
						}
						placeholder={teamMemberConfig.positionPlaceholder}
					/>
					<RichText
						tagName="p"
						className={`${baseClass}__item-text`}
						value={item.text}
						onChange={(newText) =>
							updateItem(index, 'text', newText)
						}
						placeholder={teamMemberConfig.textPlaceholder}
					/>
				</div>
				<RemoveButtonCross
					handleClick={() => removeItem(index)}
					color="#000"
				/>
			</div>
		</div>
	);
};

export default TeamMember;

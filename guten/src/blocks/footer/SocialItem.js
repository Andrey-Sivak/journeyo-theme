import ImageUploader from '../../utils/ImageUploader.js';
import LinkEditor from '../../utils/LinkEditor.js';

const SocialItem = ({ baseClass, updateSocialItem, index, item }) => {
	return (
		<div
			className={`${baseClass}__social-item`}
			style={{ position: 'relative' }}
		>
			<LinkEditor
				index={index}
				url={item.url}
				target={item.target}
				onChange={updateSocialItem}
			>
				<ImageUploader
					key={index}
					buttonText={`Select Icon`}
					image={item.icon.url}
					onSelect={(media) => {
						const iconData = {
							id: media.id,
							url: media.url,
							alt: media.alt || '',
						};

						updateSocialItem(index, 'icon', iconData);
					}}
				/>
			</LinkEditor>
		</div>
	);
};

export default SocialItem;

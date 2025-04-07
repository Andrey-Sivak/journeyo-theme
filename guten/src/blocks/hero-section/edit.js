import { useBlockProps, RichText } from '@wordpress/block-editor';
import { TextControl } from '@wordpress/components';
import { Button } from '@wordpress/components';
import './editor.scss';
import { Fragment, useState } from '@wordpress/element';
import ImageUploader from '../../utils/ImageUploader.js';
import BgSvg from './BgSvg.js';
import ButtonArrow from './ButtonArrow.js';
import AppStoreButton from '../../common-components/AppStoreButton.js';
import GooglePlayButton from '../../common-components/GooglePlayButton.js';
import InspectorPanel from './InspectorPanel.js';
import WarnButtonFillNeed from '../../common-components/WarnButtonFillNeed.js';
import MenuItem from './MenuItem.js';

const Edit = (props) => {
	const { attributes, setAttributes } = props;
	const {
		title,
		text,
		buttonText,
		image,
		logo,
		logo2,
		appStoreLink,
		googlePlayLink,
		menuItems,
	} = attributes;

	const [isButtonFocus, setIsButtonFocus] = useState(false);

	const baseClass = 'wp-block-journeyo-hero-section';

	const blockProps = useBlockProps({
		className: baseClass,
	});

	const onSelectImage = (media) => {
		setAttributes({
			image: {
				id: media.id,
				url: media.url,
				alt: media.alt || '',
			},
		});
	};

	const onSelectLogo = (media) => {
		setAttributes({
			logo: {
				id: media.id,
				url: media.url,
				alt: media.alt || '',
			},
		});
	};

	const onSelectLogo2 = (media) => {
		setAttributes({
			logo2: {
				id: media.id,
				url: media.url,
				alt: media.alt || '',
			},
		});
	};

	const updateMenuItem = (index, fieldOrFields, value) => {
		const updatedItems = [...menuItems];
		if (typeof fieldOrFields === 'string') {
			updatedItems[index] = {
				...updatedItems[index],
				[fieldOrFields]: value,
			};
		} else {
			updatedItems[index] = { ...updatedItems[index], ...fieldOrFields };
		}
		setAttributes({ menuItems: updatedItems });
	};

	const addMenuItem = () => {
		setAttributes({
			menuItems: [...menuItems, { text: '', url: '', target: '' }],
		});
	};

	const removeMenuItem = (index) => {
		const newItems = menuItems.filter((_, i) => i !== index);
		setAttributes({ menuItems: newItems });
	};

	return (
		<Fragment>
			<InspectorPanel
				setAttributes={setAttributes}
				appStoreLink={appStoreLink}
				googlePlayLink={googlePlayLink}
			/>
			<div {...blockProps}>
				<div className={`${baseClass}__wrap-out`}>
					<BgSvg cssClass={`${baseClass}__bg`} />
					<div className={`${baseClass}__wrap`}>
						<div className={`${baseClass}__header`}>
							<div className={`${baseClass}__header-logo`}>
								<ImageUploader
									buttonText={`Base Logo`}
									image={logo.url}
									onSelect={onSelectLogo}
								/>
								<ImageUploader
									buttonText={`Color Logo for white Header`}
									image={logo2.url}
									onSelect={onSelectLogo2}
								/>
							</div>

							<div className={`${baseClass}__menu-items`}>
								{menuItems.map((item, index) => (
									<MenuItem
										key={index}
										item={item}
										baseClass={baseClass}
										updateMenuItem={updateMenuItem}
										index={index}
									/>
								))}
								<Button
									isPrimary
									onClick={addMenuItem}
									className="journeyo-admin-button"
								>
									{menuItems.length ? '+' : 'Add Item'}
								</Button>
							</div>

							<div
								className={`${baseClass}__header-button`}
								onClick={() => setIsButtonFocus(true)}
							>
								{isButtonFocus ? (
									<TextControl
										value={buttonText}
										onChange={(newButtonText) =>
											setAttributes({
												buttonText: newButtonText,
											})
										}
										onBlur={() => setIsButtonFocus(false)}
										placeholder="Enter button text"
									/>
								) : (
									<span>
										{buttonText
											? buttonText
											: 'Enter button text'}
									</span>
								)}
								<ButtonArrow />
							</div>
						</div>

						<div className={`${baseClass}__content`}>
							<div
								className={`${baseClass}__content-image ${image.url ? '' : 'empty'}`}
							>
								<ImageUploader
									image={image.url}
									onSelect={onSelectImage}
								/>
							</div>

							<div className={`${baseClass}__content-text`}>
								<RichText
									tagName="h1"
									className={`${baseClass}__title`}
									value={title}
									onChange={(newTitle) =>
										setAttributes({ title: newTitle })
									}
									placeholder="Input section title..."
								/>

								<RichText
									tagName="p"
									className={`${baseClass}__text`}
									value={text}
									onChange={(newText) =>
										setAttributes({ text: newText })
									}
									placeholder="Input short description..."
								/>

								<div className={`${baseClass}__buttons`}>
									<div>
										{!appStoreLink && (
											<WarnButtonFillNeed
												text={`Enter the AppStore link<br />in the side panel`}
											/>
										)}
										<AppStoreButton />
									</div>
									<div>
										{!googlePlayLink && (
											<WarnButtonFillNeed
												text={`Enter the Google Play link<br />in the side panel`}
											/>
										)}
										<GooglePlayButton />
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</Fragment>
	);
};

export default Edit;

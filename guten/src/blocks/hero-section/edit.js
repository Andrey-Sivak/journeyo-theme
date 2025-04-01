import { useBlockProps, RichText } from '@wordpress/block-editor';
import { Button, TextControl } from '@wordpress/components';
import './editor.scss';
import { Fragment, useState } from '@wordpress/element';
import ImageUploader from '../../utils/ImageUploader.js';
import BgSvg from './BgSvg.js';
import ButtonArrow from './ButtonArrow.js';
import AppStoreButton from '../../common-components/AppStoreButton.js';
import GooglePlayButton from '../../common-components/GooglePlayButton.js';
import InspectorPanel from './InspectorPanel.js';

const Edit = (props) => {
	const { attributes, setAttributes } = props;
	const {
		title,
		text,
		buttonText,
		image,
		logo,
		appStoreLink,
		googlePlayLink,
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
									buttonText={`Select Logo`}
									image={logo.url}
									onSelect={onSelectLogo}
								/>
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
											<div
												style={{
													color: 'red',
												}}
											>
												Enter the AppStore link
												<br />
												in the side panel
											</div>
										)}
										<AppStoreButton />
									</div>
									<div>
										{!googlePlayLink && (
											<div
												style={{
													color: 'red',
												}}
											>
												Enter the Google Play link
												<br />
												in the side panel
											</div>
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

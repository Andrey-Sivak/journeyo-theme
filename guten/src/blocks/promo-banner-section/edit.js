import { useBlockProps, RichText } from '@wordpress/block-editor';
import './editor.scss';
import { Fragment } from '@wordpress/element';
import ImageUploader from '../../utils/ImageUploader.js';
import BgSvg from './BgSvg.js';
import AppStoreButton from '../../common-components/AppStoreButton.js';
import GooglePlayButton from '../../common-components/GooglePlayButton.js';
import InspectorPanel from './InspectorPanel.js';
import LocationMark from './LocationMark.js';
import ArrowVector from './ArrowVector.js';
import WarnButtonFillNeed from '../../common-components/WarnButtonFillNeed.js';

const Edit = (props) => {
	const { attributes, setAttributes } = props;
	const {
		title,
		phoneImage1,
		phoneImage2,
		appStoreLink,
		googlePlayLink,
		blockId,
	} = attributes;

	const baseClass = 'wp-block-journeyo-promo-banner-section';

	const blockProps = useBlockProps({
		className: baseClass,
	});

	const onSelectImage1 = (media) => {
		setAttributes({
			phoneImage1: {
				id: media.id,
				url: media.url,
				alt: media.alt || '',
				w: media.width,
				h: media.height,
			},
		});
	};

	const onSelectImage2 = (media) => {
		setAttributes({
			phoneImage2: {
				id: media.id,
				url: media.url,
				alt: media.alt || '',
				w: media.width,
				h: media.height,
			},
		});
	};

	return (
		<Fragment>
			<InspectorPanel
				setAttributes={setAttributes}
				appStoreLink={appStoreLink}
				googlePlayLink={googlePlayLink}
				blockId={blockId}
			/>
			<div {...blockProps}>
				<div className={`${baseClass}__wrap-out`}>
					<BgSvg cssClass={`${baseClass}__bg`} />
					<div className={`${baseClass}__wrap`}>
						<div
							className={`${baseClass}__image-1 ${phoneImage1.url ? '' : 'empty'}`}
						>
							<ImageUploader
								image={phoneImage1.url}
								onSelect={onSelectImage1}
							/>
						</div>
						<div
							className={`${baseClass}__image-2 ${phoneImage2.url ? '' : 'empty'}`}
						>
							<ImageUploader
								image={phoneImage2.url}
								onSelect={onSelectImage2}
							/>
						</div>

						<div className={`${baseClass}__location-mark`}>
							<LocationMark />
						</div>
						<div className={`${baseClass}__arrow-svg`}>
							<ArrowVector />
						</div>

						<div className={`${baseClass}__content`}>
							<RichText
								tagName="h1"
								className={`${baseClass}__title`}
								value={title}
								onChange={(newTitle) =>
									setAttributes({ title: newTitle })
								}
								placeholder="Input section title..."
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
		</Fragment>
	);
};

export default Edit;

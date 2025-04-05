import { useBlockProps, RichText } from '@wordpress/block-editor';
import { Button } from '@wordpress/components';
import './editor.scss';
import { Fragment } from '@wordpress/element';
import ImageUploader from '../../utils/ImageUploader.js';
import RemoveButtonCross from '../../utils/RemoveButtonCross.js';
import LinkEditor from '../../utils/LinkEditor.js';
import MenuItem from './MenuItem.js';
import SocialItem from './SocialItem.js';
// import InspectorPanel from './InspectorPanel.js';

const Edit = (props) => {
	const { attributes, setAttributes } = props;
	const {
		logo,
		menuItems,
		socials,
		privacyPolicyText,
		termsOfUsePolicyText,
		copyrightText,
	} = attributes;

	const baseClass = 'wp-block-journeyo-footer';

	const blockProps = useBlockProps({
		className: baseClass,
	});

	const onSelectLogo = (media) => {
		setAttributes({
			logo: {
				id: media.id,
				url: media.url,
				alt: media.alt || '',
				w: media.width || 0,
				h: media.height || 0,
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

	// const addMenuItem = () => {
	// 	setAttributes({
	// 		menuItems: [...menuItems, { text: '', url: '', target: '' }],
	// 	});
	// };
	//
	// const removeMenuItem = (index) => {
	// 	const newItems = menuItems.filter((_, i) => i !== index);
	// 	setAttributes({ menuItems: newItems });
	// };

	const updateSocialItem = (index, fieldOrFields, value) => {
		const newItems = [...socials];
		if (typeof fieldOrFields === 'string') {
			newItems[index] = {
				...newItems[index],
				[fieldOrFields]: value,
			};
		} else {
			newItems[index] = { ...newItems[index], ...fieldOrFields };
		}
		setAttributes({ socials: newItems });
	};

	// const addSocialItem = () => {
	// 	const icon = {
	// 		id: null,
	// 		url: '',
	// 		alt: '',
	// 	};
	// 	const newItems = [...socials, { url: '', icon, target: '' }];
	// 	setAttributes({ socials: newItems });
	// };
	//
	// const removeSocialItem = (index) => {
	// 	const newItems = socials.filter((_, i) => i !== index);
	// 	setAttributes({ socials: newItems });
	// };

	return (
		<Fragment>
			{/*<InspectorPanel*/}
			{/*	setAttributes={setAttributes}*/}
			{/*	appStoreLink={appStoreLink}*/}
			{/*	googlePlayLink={googlePlayLink}*/}
			{/*/>*/}
			<div {...blockProps}>
				<div className={`${baseClass}__wrap`}>
					<div className={`${baseClass}__top`}>
						<div className={`${baseClass}__logo`}>
							<ImageUploader
								buttonText={`Select Logo`}
								image={logo.url}
								onSelect={onSelectLogo}
							/>
						</div>

						<div className={`${baseClass}__top-right`}>
							<div className={`${baseClass}__top-right-top`}>
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
									{/*<Button*/}
									{/*	isPrimary*/}
									{/*	onClick={addMenuItem}*/}
									{/*	className="journeyo-admin-button"*/}
									{/*>*/}
									{/*	Add Item*/}
									{/*</Button>*/}
								</div>

								<div className={`${baseClass}__social-items`}>
									{socials.map((item, index) => (
										<SocialItem
											key={index}
											item={item}
											baseClass={baseClass}
											index={index}
											updateSocialItem={updateSocialItem}
										/>
									))}
									{/*<Button*/}
									{/*	isPrimary*/}
									{/*	onClick={addSocialItem}*/}
									{/*	className="journeyo-admin-button"*/}
									{/*>*/}
									{/*	Add Social*/}
									{/*</Button>*/}
								</div>
							</div>

							<div className={`${baseClass}__top-right-bottom`}>
								<RichText
									tagName="p"
									className={`${baseClass}__link`}
									value={privacyPolicyText}
									onChange={(newPrivacyPolicyText) =>
										setAttributes({
											privacyPolicyText:
												newPrivacyPolicyText,
										})
									}
									placeholder="Privacy Policy..."
								/>

								<RichText
									tagName="p"
									className={`${baseClass}__link`}
									value={termsOfUsePolicyText}
									onChange={(newTermsOfUsePolicyText) =>
										setAttributes({
											termsOfUsePolicyText:
												newTermsOfUsePolicyText,
										})
									}
									placeholder="Terms of Service..."
								/>
							</div>
						</div>
					</div>

					<RichText
						tagName="p"
						className={`${baseClass}__copyright`}
						value={copyrightText}
						onChange={(newCopyrightText) =>
							setAttributes({ copyrightText: newCopyrightText })
						}
						placeholder="Copyright..."
					/>
				</div>
			</div>
		</Fragment>
	);
};

export default Edit;

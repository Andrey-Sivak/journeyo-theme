import { useBlockProps, RichText } from '@wordpress/block-editor';
import { Button } from '@wordpress/components';
import { TextControl } from '@wordpress/components';
import './editor.scss';
import { Fragment, useState } from '@wordpress/element';
import ImageUploader from '../../utils/ImageUploader.js';
import RemoveButtonCross from '../../utils/RemoveButtonCross.js';
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

	const updateMenuItem = (index, newValue) => {
		const updatedItems = [...menuItems];
		updatedItems[index] = newValue;
		setAttributes({ menuItems: updatedItems });
	};

	// const addMenuItem = () => {
	// 	setAttributes({ menuItems: [...menuItems, ''] });
	// };
	//
	// const removeMenuItem = (index) => {
	// 	const newItems = menuItems.filter((_, i) => i !== index);
	// 	setAttributes({ menuItems: newItems });
	// };

	const updateSocialItem = (index, field, value) => {
		const newItems = [...socials];
		newItems[index] = { ...newItems[index], [field]: value };
		setAttributes({ socials: newItems });
	};

	// const addSocialItem = () => {
	// 	const icon = {
	// 		id: null,
	// 		url: '',
	// 		alt: '',
	// 	};
	// 	const newItems = [...socials, { url: '', icon }];
	// 	setAttributes({ socials: newItems });
	// };

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
										<div style={{ position: 'relative' }}>
											<RichText
												tagName="p"
												key={index}
												className={`${baseClass}__menu-item`}
												value={item}
												onChange={(newValue) =>
													updateMenuItem(
														index,
														newValue,
													)
												}
												placeholder="Link text..."
											/>
											{/*<RemoveButtonCross*/}
											{/*	handleClick={() =>*/}
											{/*		removeMenuItem(index)*/}
											{/*	}*/}
											{/*	color="#000"*/}
											{/*/>*/}
										</div>
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
										<div
											className={`${baseClass}__social-item`}
											style={{ position: 'relative' }}
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

													updateSocialItem(
														index,
														'icon',
														iconData,
													);
												}}
											/>
											{/*<RemoveButtonCross*/}
											{/*	handleClick={() =>*/}
											{/*		removeSocialItem(index)*/}
											{/*	}*/}
											{/*	color="#000"*/}
											{/*/>*/}
										</div>
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

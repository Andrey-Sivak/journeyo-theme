import { useBlockProps, RichText } from '@wordpress/block-editor';
import { Button } from '@wordpress/components';
import './editor.scss';
import { Fragment } from '@wordpress/element';
import ImageUploader from '../../utils/ImageUploader.js';
import RemoveButtonCross from '../../utils/RemoveButtonCross.js';

const Edit = (props) => {
	const { attributes, setAttributes } = props;
	const { title, subtitle, items } = attributes;

	const baseClass = 'wp-block-journeyo-benefits-section';

	const blockProps = useBlockProps({
		className: baseClass,
	});

	const updateItem = (index, field, value) => {
		const newItems = [...items];
		newItems[index] = { ...newItems[index], [field]: value };
		setAttributes({ items: newItems });
	};

	const addItem = () => {
		const icon = {
			id: null,
			url: '',
			w: 0,
			h: 0,
			alt: '',
		};
		const newItems = [...items, { title: '', subtitle: '', icon }];
		setAttributes({ items: newItems });
	};

	const removeItem = (index) => {
		const newItems = items.filter((_, i) => i !== index);
		setAttributes({ items: newItems });
	};

	const itemCount = items.length;
	let colsClass = '';
	const remainder = itemCount % 3;
	if (remainder === 0) {
		colsClass = 'jn-cols-3';
	} else if (remainder === 1) {
		colsClass = 'jn-cols-4';
	} else if (remainder === 2) {
		colsClass = 'jn-cols-5';
	}

	const itemsClasses = `${baseClass}__items ${colsClass}`.trim();

	return (
		<Fragment>
			<div {...blockProps}>
				<div className={`${baseClass}__wrap`}>
					<RichText
						tagName="h2"
						className={`${baseClass}__title`}
						value={title}
						onChange={(newTitle) =>
							setAttributes({ title: newTitle })
						}
						placeholder="Enter title..."
					/>

					<RichText
						tagName="p"
						className={`${baseClass}__subtitle`}
						value={subtitle}
						onChange={(newSubtitle) =>
							setAttributes({ subtitle: newSubtitle })
						}
						placeholder="Enter subtitle..."
					/>
					<div className={itemsClasses}>
						{items.map((item, index) => (
							<div
								key={index}
								className={`${baseClass}__item`}
								style={{ position: 'relative' }}
							>
								<div className={`${baseClass}__item-content`}>
									<RichText
										tagName="h3"
										className={`${baseClass}__item-title`}
										value={item.title}
										onChange={(newTitle) =>
											updateItem(index, 'title', newTitle)
										}
										placeholder="Enter title..."
									/>

									<RichText
										tagName="p"
										className={`${baseClass}__item-subtitle`}
										value={item.subtitle}
										onChange={(newDescription) =>
											updateItem(
												index,
												'subtitle',
												newDescription,
											)
										}
										placeholder="Enter subtitle..."
									/>
								</div>

								<div
									className={`${baseClass}__item-icon-white-border`}
								/>
								<div
									className={`${baseClass}__item-icon-helper-top`}
								/>
								<div
									className={`${baseClass}__item-icon-helper-right`}
								/>
								<div className={`${baseClass}__item-icon`}>
									<ImageUploader
										buttonText={`Select Icon`}
										image={item.icon.url}
										onSelect={(media) => {
											const iconData = {
												id: media.id,
												url: media.url,
												w: media.width,
												h: media.height,
												alt: media.alt || '',
											};

											updateItem(index, 'icon', iconData);
										}}
									/>
								</div>

								<RemoveButtonCross
									handleClick={() => removeItem(index)}
									color="#000"
								/>
							</div>
						))}

						<Button
							isPrimary
							onClick={addItem}
							className="journeyo-admin-button"
						>
							Add new item
						</Button>
					</div>
				</div>
			</div>
		</Fragment>
	);
};

export default Edit;

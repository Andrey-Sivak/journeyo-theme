import {
	useBlockProps,
	RichText,
	InspectorControls,
} from '@wordpress/block-editor';
import { PanelBody, TextControl } from '@wordpress/components';
import './editor.scss';
import { Fragment } from '@wordpress/element';
import ItemsBg from './ItemsBg.js';

const Edit = (props) => {
	const { attributes, setAttributes } = props;
	const { title, subtitle, items, blockId } = attributes;

	const baseClass = 'wp-block-journeyo-plan-section';

	const blockProps = useBlockProps({
		className: baseClass,
	});

	if (items.length !== 3) {
		setAttributes({
			items: [
				{
					title: items[0]?.title || '',
					subtitle: items[0]?.subtitle || '',
				},
				{
					title: items[1]?.title || '',
					subtitle: items[1]?.subtitle || '',
				},
				{
					title: items[2]?.title || '',
					subtitle: items[2]?.subtitle || '',
				},
			],
		});
	}

	const updateItem = (index, field, value) => {
		const newItems = [...items];
		newItems[index] = { ...newItems[index], [field]: value };
		setAttributes({ items: newItems });
	};

	return (
		<Fragment>
			<InspectorControls>
				<PanelBody title="Block Settings">
					<TextControl
						label="Block ID"
						value={blockId}
						onChange={(newId) => {
							const sanitizedId = newId
								.toLowerCase()
								.replace(/\s+/g, '-')
								.replace(/[^a-z0-9-]/g, '');
							setAttributes({ blockId: sanitizedId });
						}}
						help="Enter a unique ID for this section (e.g. 'support-section-1'). Use only lowercase letters, numbers and hyphens"
					/>
				</PanelBody>
			</InspectorControls>
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
					<div className={`${baseClass}__items`}>
						<ItemsBg cssClass={`${baseClass}__items-bg`} />
						<div className={`${baseClass}__items-wrap`}>
							{items.map((item, index) => (
								<div
									key={index}
									className={`${baseClass}__item`}
								>
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
							))}
						</div>
					</div>
				</div>
			</div>
		</Fragment>
	);
};

export default Edit;

import {
	useBlockProps,
	RichText,
	InspectorControls,
} from '@wordpress/block-editor';
import { Button, PanelBody, TextControl } from '@wordpress/components';
import './editor.scss';
import { Fragment } from '@wordpress/element';
import SliderItem from './SliderItem.js';

const Edit = (props) => {
	const { attributes, setAttributes } = props;
	const { title, items, blockId } = attributes;

	const baseClass = 'wp-block-journeyo-reviews-section';

	const blockProps = useBlockProps({
		className: baseClass,
	});

	if (!items.length) {
		setAttributes({
			items: [
				{
					name: items[0]?.name || '',
					location: items[0]?.location || '',
					text: items[0]?.text || '',
					photo: items[0]?.photo || { id: null, url: '', alt: '' },
					rating: items[0]?.rating || 0,
				},
			],
		});
	}

	const updateItem = (index, field, value) => {
		const newItems = [...items];
		newItems[index] = { ...newItems[index], [field]: value };
		setAttributes({ items: newItems });
	};

	const addItem = () => {
		const photo = {
			id: null,
			url: '',
			alt: '',
		};
		const newItems = [
			...items,
			{ name: '', location: '', text: '', photo, rating: 0 },
		];
		setAttributes({ items: newItems });
	};

	const removeItem = (index) => {
		const newItems = items.filter((_, i) => i !== index);
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

					<div className={`${baseClass}__items`}>
						{items.map((item, index) => (
							<SliderItem
								key={index}
								item={item}
								index={index}
								updateItem={updateItem}
								removeItem={removeItem}
								baseClass={baseClass}
							/>
						))}

						<Button
							isPrimary
							onClick={addItem}
							className="journeyo-admin-button"
						>
							Add new review
						</Button>
					</div>
				</div>
			</div>
		</Fragment>
	);
};

export default Edit;

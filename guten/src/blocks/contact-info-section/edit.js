import { useBlockProps, RichText } from '@wordpress/block-editor';
import { Button } from '@wordpress/components';
import './editor.scss';
import RemoveButtonCross from '../../utils/RemoveButtonCross.js';

const Edit = (props) => {
	const { attributes, setAttributes } = props;
	const { title, items } = attributes;

	const baseClass = 'wp-block-journeyo-contact-info-section';

	const blockProps = useBlockProps({
		className: baseClass,
	});

	const updateItem = (index, field, value) => {
		const newItems = [...items];
		newItems[index] = { ...newItems[index], [field]: value };
		setAttributes({ items: newItems });
	};

	const addItem = () => {
		const newItems = [...items, { label: '', value: '' }];
		setAttributes({ items: newItems });
	};

	const removeItem = (index) => {
		const newItems = items.filter((_, i) => i !== index);
		setAttributes({ items: newItems });
	};

	return (
		<div {...blockProps}>
			<div className={`${baseClass}__wrap`}>
				<RichText
					tagName="h2"
					className={`${baseClass}__title`}
					value={title}
					onChange={(newTitle) => setAttributes({ title: newTitle })}
					placeholder="Enter title..."
				/>

				<div className={`${baseClass}__items`}>
					{items.map((item, index) => (
						<div
							key={index}
							className={`${baseClass}__item`}
							style={{ position: 'relative' }}
						>
							<RichText
								tagName="p"
								className={`${baseClass}__item-label`}
								value={item.label}
								onChange={(newLabel) =>
									updateItem(index, 'label', newLabel)
								}
								placeholder="Enter label..."
							/>

							<RichText
								tagName="p"
								className={`${baseClass}__item-value`}
								value={item.value}
								onChange={(newValue) =>
									updateItem(index, 'value', newValue)
								}
								placeholder="Enter value..."
							/>

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
	);
};

export default Edit;

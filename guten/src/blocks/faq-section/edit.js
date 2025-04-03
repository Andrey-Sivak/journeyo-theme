import { useBlockProps, RichText } from '@wordpress/block-editor';
import { Button } from '@wordpress/components';
import './editor.scss';
import RemoveButtonCross from '../../utils/RemoveButtonCross.js';

const Edit = (props) => {
	const { attributes, setAttributes } = props;
	const { title, items } = attributes;

	const baseClass = 'wp-block-journeyo-faq-section';

	const blockProps = useBlockProps({
		className: baseClass,
	});

	const updateItem = (index, field, value) => {
		const newItems = [...items];
		newItems[index] = { ...newItems[index], [field]: value };
		setAttributes({ items: newItems });
	};

	const addItem = () => {
		const newItems = [...items, { question: '', answer: '' }];
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
								className={`${baseClass}__item-question`}
								value={item.question}
								onChange={(newQuestion) =>
									updateItem(index, 'question', newQuestion)
								}
								placeholder="Enter question..."
							/>

							<RichText
								tagName="div"
								className={`${baseClass}__item-answer`}
								value={item.answer}
								onChange={(newAnswer) =>
									updateItem(index, 'answer', newAnswer)
								}
								placeholder="Enter answer..."
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
						Add new question
					</Button>
				</div>
			</div>
		</div>
	);
};

export default Edit;

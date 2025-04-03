import { useBlockProps, RichText } from '@wordpress/block-editor';
import { Button } from '@wordpress/components';
import './editor.scss';
import { Fragment } from '@wordpress/element';
import TeamMember from './TeamMember.js';

const Edit = (props) => {
	const { attributes, setAttributes } = props;
	const { title, items } = attributes;

	const baseClass = 'wp-block-journeyo-team-section';

	const blockProps = useBlockProps({
		className: baseClass,
	});

	if (!items.length) {
		setAttributes({
			items: [
				{
					name: items[0]?.name || '',
					position: items[0]?.position || '',
					text: items[0]?.text || '',
					photo: items[0]?.photo || { id: null, url: '', alt: '' },
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
			{ name: '', position: '', text: '', photo, rating: 0 },
		];
		setAttributes({ items: newItems });
	};

	const removeItem = (index) => {
		const newItems = items.filter((_, i) => i !== index);
		setAttributes({ items: newItems });
	};

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

					<div className={`${baseClass}__items`}>
						{items.map((item, index) => (
							<TeamMember
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
							Add new team member
						</Button>
					</div>
				</div>
			</div>
		</Fragment>
	);
};

export default Edit;

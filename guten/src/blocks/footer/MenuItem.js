import { RichText } from '@wordpress/block-editor';
import LinkEditor from '../../utils/LinkEditor.js';

const MenuItem = ({ item, index, updateMenuItem, baseClass }) => {
	return (
		<div style={{ position: 'relative' }}>
			<LinkEditor
				key={index}
				url={item.url}
				target={item.target}
				onChange={updateMenuItem}
				index={index}
			>
				<RichText
					tagName="div"
					key={index}
					className={`${baseClass}__menu-item`}
					value={item.text}
					onChange={(newValue) =>
						updateMenuItem(index, 'text', newValue)
					}
					placeholder="Link text..."
				/>
			</LinkEditor>
		</div>
	);
};

export default MenuItem;

import { registerBlockType } from '@wordpress/blocks';
import './style.scss';

import Edit from './edit.js';
import metadata from './block.json';

registerBlockType(metadata.name, {
	...metadata,
	icon: {
		background: '#fff',
		foreground: '#FF760E',
		src: 'list-view',
	},
	edit: Edit,
	save: () => null,
});

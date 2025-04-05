import {
	useBlockProps,
	RichText,
	InspectorControls,
} from '@wordpress/block-editor';
import { Fragment } from '@wordpress/element';
import { PanelBody, TextControl } from '@wordpress/components';
import './editor.scss';

const Edit = (props) => {
	const { attributes, setAttributes } = props;
	const { title, blockId, formShortcode } = attributes;

	const baseClass = 'wp-block-journeyo-form-section';

	const blockProps = useBlockProps({
		className: baseClass,
	});

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
					<div className={`${baseClass}__block-big-rt`}></div>
					<div className={`${baseClass}__block-big-lt`}></div>
					<div className={`${baseClass}__block-small-rt`}></div>
					<div className={`${baseClass}__block-small-lt`}></div>
					<RichText
						tagName="h2"
						className={`${baseClass}__title`}
						value={title}
						onChange={(newTitle) =>
							setAttributes({ title: newTitle })
						}
						placeholder="Enter title..."
					/>

					<div className={`${baseClass}__form`}>
						<TextControl
							label="Contact Form 7 Shortcode"
							value={formShortcode}
							onChange={(newShortcode) =>
								setAttributes({ formShortcode: newShortcode })
							}
							placeholder="Enter the form shortcode, for example: [contact-form-7 id='123' title='Contact Form']"
						/>
						<div className={`${baseClass}__form-placeholder`}>
							{formShortcode ? (
								<p>
									The form will be displayed on the website
									using the shortcode: {formShortcode}
								</p>
							) : (
								<p>
									Add the Contact Form 7 shortcode to display
									the form.
								</p>
							)}
						</div>
					</div>
				</div>
			</div>
		</Fragment>
	);
};

export default Edit;

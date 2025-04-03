import { InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl } from '@wordpress/components';

const InspectorPanel = ({ setAttributes, appStoreLink, googlePlayLink }) => {
	return (
		<InspectorControls>
			<PanelBody title="App Links">
				<TextControl
					label="AppStore Link"
					value={appStoreLink}
					onChange={(newAppStoreLink) => {
						setAttributes({ appStoreLink: newAppStoreLink });
					}}
					help=""
				/>
				<TextControl
					label="Google Play Link"
					value={googlePlayLink}
					onChange={(newGooglePlayLink) => {
						setAttributes({ googlePlayLink: newGooglePlayLink });
					}}
					help=""
				/>
			</PanelBody>
		</InspectorControls>
	);
};

export default InspectorPanel;

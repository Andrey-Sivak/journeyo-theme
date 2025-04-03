const WarnButtonFillNeed = ({
	color = 'red',
	text = `Enter the Google Play link<br />in the side panel`,
}) => {
	const styles = {
		color,
	};
	return <div style={styles} dangerouslySetInnerHTML={{ __html: text }} />;
};

export default WarnButtonFillNeed;

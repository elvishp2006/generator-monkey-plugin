module.exports = {
	dist: {
		options: {
			style: 'compressed'
		},
		files: {
			'<%= paths.style %>/style.css': '<%= paths.style %>/style.scss'
		}
	},
	dev: {
		options: {
			style: 'expanded',
		},
		files: {
			'<%= paths.style %>/style.css': '<%= paths.style %>/style.scss'
		}
	},
};
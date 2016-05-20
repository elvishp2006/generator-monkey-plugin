module.exports =  {
	styles : {
		files : ['<%= paths.style %>/**/*.scss', 'ghost/**/*.scss'],
		tasks : ['sass:dev']
	},
	templates : {
		files: ['handlebars/**/*.hbs'],
		tasks: ['handlebars:dist']
	},
	scripts : {
		files : '<%= concat.dist.src %>',
		tasks : ['jshint', 'concat:dist']
	}
};
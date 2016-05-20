'use strict';
var yeoman = require('yeoman-generator');
var chalk = require('chalk');
var yosay = require('yosay');
var _ = require('lodash');

module.exports = yeoman.Base.extend({
  prompting: function () {
    // Have Yeoman greet the user.
    this.log(yosay(
      'Before starting the process, make sure to be on ' + chalk.red('"wp-content/plugins"') + '!'
    ));

    var prompts = [{
      type: 'input',
      name: 'name',
      message: 'Your project name',
      default: 'Plugin Boilerplate'
    },
    {
      type: 'input',
      name: 'namespace',
      message: 'Your project namespace',
      default: 'Plugin\\Boilerplate'
    },
    {
      type: 'input',
      name: 'description',
      message: 'Your project description',
      default: 'Some description'
    }];

    return this.prompt(prompts).then(function (props) {
      // To access props later use this.props.someAnswer;
      this.props = props;
    }.bind(this));
  },

  writing: function () {
    var context = {
        name: this.props.name,
        namespace: this.props.namespace,
        slug: _.kebabCase(this.props.name),
        titleCamel: _.upperFirst(_.camelCase(this.appname)),
        description: this.props.description
    };

    this.destinationRoot(context.slug);

    this.fs.copyTpl(
      this.templatePath('boilerplate/**/*'),
      this.destinationPath(),
      context
    );

    this.fs.copyTpl(
      this.templatePath('boilerplate.php'),
      this.destinationPath(context.slug + '.php'),
      context
    );

    this.fs.copy(
      this.templatePath('grunt/**/*'),
      this.destinationPath()
    );
  },

  install: function () {
    // this.npmInstall();
  }
});

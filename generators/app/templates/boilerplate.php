<?php
/*
	Plugin Name: <%= name %>
	Plugin URI: http://apiki.com.br/
	Version: 0.1.0
	Author: Apiki WordPress
	Author URI: http://apiki.com.br/
	Text Domain: <%= slug %>
	Domain Path: /languages
	License: GPL2
	Description: <%= description %>
*/
namespace <%= namespace %>;

if ( ! function_exists( 'add_action' ) ) {
	exit(0);
}

if ( ! class_exists( 'Apiki\API\App' ) ) {
	return;
}

use Apiki\API;

class App
{
	const PLUGIN_SLUG = '<%= slug %>';

	public static function uses( $class_name, $location )
	{
		$locations = array(
			'Controller',
			'View',
			'Helper',
			'Widget',
			'Vendor',
		);

		$extension = 'php';

		if ( in_array( $location, $locations ) )
			$extension = strtolower( $location ) . '.php';

		include "{$location}/{$class_name}.{$extension}";
	}

	public static function plugins_url( $path )
	{
		return plugins_url( $path, __FILE__ );
	}

	public static function plugin_dir_path( $path )
	{
		return plugin_dir_path( __FILE__ ) . $path;
	}

	public static function filemtime( $path )
	{
		return filemtime( self::plugin_dir_path( $path ) );
	}

	public static function load_textdomain()
	{
		load_plugin_textdomain( self::PLUGIN_SLUG, false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
	}
}

App::uses( 'core', 'Config' );

$core = new Core();

register_activation_hook( __FILE__, array( $core, 'activate' ) );

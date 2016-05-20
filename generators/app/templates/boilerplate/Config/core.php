<?php
namespace <%= namespace %>;

if ( ! function_exists( 'add_action' ) ) {
	exit(0);
}

use Apiki\API\Loader;

class Core extends Loader
{
	/**
	 * Namespace
	 *
	 * @since 1.1
	 * @var string
	 */
	public $namespace = '<%= namespace %>';

	/**
	 * Pages Enqueue Media
	 *
	 * @since 1.1
	 * @var array
	 */
	public $pages_enqueue_media = array(
		'post.php',
		'post-new.php',
		'themes.php',
		'edit-tags.php',
	);

	public function initialize()
	{
		add_action( 'plugins_loaded', array( "{$this->namespace}\App", 'load_textdomain' ) );

		$controllers = array();

		$this->load_controllers( $controllers );
	}

	public function activate()
	{
		$controllers = array();

		$this->load_controllers( $controllers, true );
	}

	public function scripts_admin()
	{
		$this->load_wp_media();

		wp_enqueue_script(
			'admin-script-' . App::PLUGIN_SLUG,
			App::plugins_url( '/assets/javascripts/built.js' ),
			array( 'jquery', 'admin-script-apiki-wp-api' ),
			App::filemtime( 'assets/javascripts/built.js' ),
			true
		);
	}

	public function styles_admin()
	{
		wp_enqueue_style(
			'admin-style-' . App::PLUGIN_SLUG,
			App::plugins_url( 'assets/stylesheets/style.css' ),
			array( 'admin-css-apiki-wp-api' ),
			App::filemtime( 'assets/stylesheets/style.css' )
		);
	}
}

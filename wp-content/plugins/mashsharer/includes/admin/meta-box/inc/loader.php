<?php
/**
 * Load plugin's files with check for installing it as a standalone plugin or
 * a module of a theme / plugin. If standalone plugin is already installed, it
 * will take higher priority.
 * @package Meta Box
 */

/**
 * Plugin loader class.
 * @package Meta Box
 */
class MASHSB_RWMB_Loader
{
	/**
	 * Class constructor.
	 */
	public function __construct()
	{
		$this->constants();
		spl_autoload_register( array( $this, 'autoload' ) );
		$this->init();
	}

	/**
	 * Define plugin constants.
	 */
	public function constants()
	{
		// Script version, used to add version for scripts and styles
		define( 'MASHSB_RWMB_VER', '4.8.4' );

		list( $path, $url ) = self::get_path();

		// Plugin URLs, for fast enqueuing scripts and styles
		define( 'MASHSB_RWMB_URL', $url );
		define( 'MASHSB_RWMB_JS_URL', trailingslashit( MASHSB_RWMB_URL . 'js' ) );
		define( 'MASHSB_RWMB_CSS_URL', trailingslashit( MASHSB_RWMB_URL . 'css' ) );

		// Plugin paths, for including files
		define( 'MASHSB_RWMB_DIR', $path );
		define( 'MASHSB_RWMB_INC_DIR', trailingslashit( MASHSB_RWMB_DIR . 'inc' ) );
		define( 'MASHSB_RWMB_FIELDS_DIR', trailingslashit( MASHSB_RWMB_INC_DIR . 'fields' ) );
	}

	/**
	 * Get plugin base path and URL.
	 * The method is static and can be used in extensions.
	 * @link http://www.deluxeblogtips.com/2013/07/get-url-of-php-file-in-wordpress.html
	 * @param string $base Base folder path
	 * @return array Path and URL.
	 */
	public static function get_path( $base = '' )
	{
		// Plugin base path
		$path = $base ? $base : dirname( dirname( __FILE__ ) );
		$path = wp_normalize_path( untrailingslashit( $path ) );

		// Installed as a plugin?
		if ( 0 === strpos( $path, wp_normalize_path( WP_PLUGIN_DIR ) ) || 0 === strpos( $path, wp_normalize_path( WPMU_PLUGIN_DIR ) ) )
		{
			$url = plugins_url( '', $path . '/' . basename( $path ) );
		}
		// Included into themes
		else
		{
			// Get plugin base URL
			$content_url = untrailingslashit( dirname( dirname( get_stylesheet_directory_uri() ) ) );
			$content_dir = untrailingslashit( WP_CONTENT_DIR );
			$url         = str_replace( wp_normalize_path( $content_dir ), $content_url, $path );
		}

		$path = trailingslashit( $path );
		$url  = trailingslashit( $url );

		return array( $path, $url );
	}

	/**
	 * Autoload fields' classes.
	 * @param string $class Class name
	 */
	public function autoload( $class )
	{
		// Only load plugin's classes
		if ( 'MASHSB_RW_Meta_Box' != $class && 0 !== strpos( $class, 'MASHSB_RWMB_' ) )
		{
			return;
		}

		// Get file name
		$file = 'meta-box';
		if ( 'MASHSB_RW_Meta_Box' != $class )
		{
			// Remove prefix 'MASHSB_RWMB_'
			$file = substr( $class, 12 );

			// Optional '_Field'
			$file = preg_replace( '/_Field$/', '', $file );
		}

		$file = strtolower( str_replace( '_', '-', $file ) ) . '.php';

		$dirs = array( MASHSB_RWMB_INC_DIR, MASHSB_RWMB_FIELDS_DIR, trailingslashit( MASHSB_RWMB_INC_DIR . 'walkers' ) );
		foreach ( $dirs as $dir )
		{
			if ( file_exists( $dir . $file ) )
			{
				require $dir . $file;
				return;
			}
		}
	}

	/**
	 * Initialize plugin.
	 */
	public function init()
	{
		// Plugin core
		new MASHSB_RWMB_Core;

		if ( is_admin() )
		{
			// Validation module
			new MASHSB_RWMB_Validation;
		}

		// Public functions
		require MASHSB_RWMB_INC_DIR . 'functions.php';
	}
}

<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://outsourceappz.com
 * @since             1.0.0
 * @package           Markdown_Documenter
 *
 * @wordpress-plugin
 * Plugin Name:       Markdown Documenter
 * Plugin URI:        https://outsourceappz.com
 * Description:       Generates Documentations using Markdown source.
 * Version:           1.0.0
 * Author:            Outsource Appz
 * Author URI:        https://outsourceappz.com
 * License:           GPL
 * Text Domain:       markdown-documenter
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

define('MARKDOWN_DOCUMENTER_VERSION', '0.1.0');
define('MARKDOWN_DOCUMENTER_URL', plugin_dir_url(__FILE__));
define('MARKDOWN_DOCUMENTER_PATH', dirname(__FILE__).'/');
define('MARKDOWN_DOCUMENTER_LOCALE', 'en');

require_once __DIR__ . '/vendor/autoload.php';

/**
 * The code that runs during plugin activation.
 * This action is documented in app/includes/class-activator.php
 */
require plugin_dir_path( __FILE__ ) . 'app/includes/class-activator.php';
register_activation_hook( __FILE__, array('Markdown_Documenter_Activator', 'activate') );

/**
 * The code that runs during plugin deactivation.
 * This action is documented in app/includes/class-deactivator.php
 */
require plugin_dir_path( __FILE__ ) . 'app/includes/class-deactivator.php';
register_deactivation_hook( __FILE__, array('Markdown_Documenter_Deactivator', 'deactivate') );

/**
 * The code that runs during plugin uninstallation.
 * This action is documented in app/includes/class-uninstaller.php
 */
require plugin_dir_path( __FILE__ ) . 'app/includes/class-uninstaller.php';
register_uninstall_hook( __FILE__, array('Markdown_Documenter_Uninstaller', 'uninstall') );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'app/includes/class-plugin.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
$plugin = new Markdown_Documenter();
$plugin->run();

/**
 * Wrapper function for markdown to html conversion.
 *
 */
function oa_markdown($text)
{
    return (new ParsedownExtra)->text($text);
}

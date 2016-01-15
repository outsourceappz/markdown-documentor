<?php
/**
 * Registers custom post types
 *
 * @link       https://outsourceappz.com
 * @since      1.0.0
 *
 * @package    Markdown_Documenter
 * @subpackage Markdown_Documenter/includes
 */

/**
 * Registers custom settings/options pages.
 *
 * This class defines and registers custom settings/options pages.
 *
 * @since      1.0.0
 * @package    Markdown_Documenter
 * @subpackage Markdown_Documenter/includes
 * @author     Your Name <email@example.com>
 */

require_once __DIR__ . '/builders/helpers.php';
require_once __DIR__ . '/builders/SettingsFormBuilder.php';
require_once __DIR__ . '/builders/HtmlBuilder.php';

class Markdown_Documenter_SettingsManager {
    protected $form;
    protected $html;
    protected $default_view;


    function __construct() {
        $this->html = new Markdown_Documenter_HtmlBuilder;
        $this->form = new Markdown_Documenter_SettingsFormBuilder($this->html);
        $this->default_view = MARKDOWN_DOCUMENTER_PATH . '/app/views/settings.php';
    }

	/**
	 * Register all your custom post types here
	 */
	public function register() {
	}

}

<?php


class Markdown_Documenter_Shortcodes
{
    protected $views;

    function __construct()
    {
        $this->views = MARKDOWN_DOCUMENTER_PATH . 'app/views/shortcodes/';
    }

    public function register()
    {
        add_shortcode('markdown_documenter', array($this, 'markdown') );
    }

    /**
     * Renders the html documentation using markdown
     *
     * @param [type] $attr [description]
     *
     * @return [type] [description]
     */
    public function markdown($attr)
    {
        $base_path    = WP_CONTENT_DIR . '/docs/' . $attr['path'];
        $sidebar_file = $base_path . '/' . $attr['sidebar'] .'.md';

        if (isset($_GET['page'])) {
            $attr['default'] = $_GET['page'];
        }

        $content_file = $base_path . '/' . $attr['default'] .'.md';

        $sidebar = oa_markdown(file_get_contents($sidebar_file));

        if (file_exists($content_file)) {
            $content = oa_markdown(file_get_contents($content_file));
        } else {
            $content = "<h3>Page not found</h3>";
        }
        ob_start();
        require $this->views . 'markdown_documenter.php';

        return ob_get_clean();
    }
}

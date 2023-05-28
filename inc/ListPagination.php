<?php

namespace Src;

use Src\Core\Interfaces\Actions;


class ListPagination implements Actions
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
       
    }
    public function get_actions()
    {
        return array(

            'wp_enqueue_scripts' => ['load_scripts', 10, 1],
            "init" => ["register_shortcodes"]
        );
    }

    public function load_scripts()
    {

        global $post;
        if (!is_a($post, 'WP_Post') OR !has_shortcode($post->post_content, $this->id)) {
           return;
        }

        wp_enqueue_script('my_js', get_theme_file_uri('assets/js/pagination.js'), array('jquery'));
        wp_localize_script('my_js', 'ajax_var', array(
            'url'    => rest_url(CUSTOM_ENDPOINT_NAMESPACE."/posts"),
            'nonce'  => wp_create_nonce('wp_rest'),
            "page" => PAGINATION_DEFAULT_PAGE,
            "per_page" => PAGINATION_DEFAULT_PER_PAGE
        ));

        wp_enqueue_style( 'mytheme-style', get_theme_file_uri('assets/css/pagination.css') ); 
    }

    function register_shortcodes()
    {

        add_shortcode($this->id, [$this, 'content']);
    }


    function content()
    {
        ob_start();
        get_template_part( 'template-parts/post');
        return ob_get_clean();
    }
}

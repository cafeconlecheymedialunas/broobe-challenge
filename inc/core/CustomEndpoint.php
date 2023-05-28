<?php

namespace Src\Core;

use Src\Core\Interfaces\Actions;
use Src\Core\ListPagination;

class CustomEndpoint implements Actions
{
    public function get_actions()
    {
        return array(
            'rest_api_init' => ["custom_api_endpoint_init", 10, 1]
        );
    }

    public function custom_api_endpoint_init()
    {

        register_rest_route(CUSTOM_ENDPOINT_NAMESPACE, '/posts', array(
            'methods' => 'GET',
            'callback' => [$this, 'custom_api_endpoint_posts'],
            "permission_callback" => "__return_true"
        ));
    }
    public static function custom_api_endpoint_posts($request)
    {
        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        $args = array(
            'post_type' => 'post',
            'paged' =>  $paged,
            'posts_per_page' => $request->get_param('per_page'),
            
        );
        $query= new \WP_Query($args);
        $results = [];
        while ($query->have_posts()) {
            $query->the_post();
     
            $results["posts"][] = [
                "post_id" => get_the_ID(),
                'post_title'     => get_the_title(),
                'permalink' => get_the_permalink(),
            ];
            
        }
        $results["max_pages"] = $query->max_num_pages;
        $results["count"] = $query->found_posts;
        
        wp_reset_postdata();
     
        return $results;
    }
   
}

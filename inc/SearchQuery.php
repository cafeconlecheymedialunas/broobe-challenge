<?php

namespace Src;

use Src\Core\Interfaces\Actions;

class SearchQuery implements Actions
{
    public function get_actions()
    {
        return array(
            'pre_get_posts' => ["filter", null, 1]
        );
    }

    function filter($query)
    {
        if (!is_admin() && $query->is_main_query()) {
            if ($query->is_search) {
                $query->set('post_type', array('post'));
                $query->set('posts_per_page', FILTER_SEARCH_QUERY_PER_PAGE);
            }
        }
    }
}

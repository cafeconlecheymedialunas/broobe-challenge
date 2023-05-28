<?php

namespace Src;

use Src\Core\Interfaces\Actions;

class MetaBoxRedirect implements Actions
{
    private $id, $title;

    public function __construct($id, $title)
    {

   
        $this->id = $id;
        $this->title = $title;
    }

    public function get_actions()
    {
        return array(
            'save_post' => ['save', 10, 1],
            'add_meta_boxes' => ['add_meta_box'],
            "get_header" => ["redirect"]
        );
    }
    function add_meta_box()
    {

        add_meta_box($this->id, $this->title, [$this, "display"], "page", 'side', 'high');
    }


    function display()
    {
        global $post;
        $page_redirect = get_post_meta($post->ID, 'page_redirect_meta_box', true);
        $my_query = new \WP_Query(array(
            'post__not_in' => array($post->ID),
            'post_type' => 'page',

        ));

?>

        <label><?= __("Choose a page:",TEXT_DOMAIN);?> </label>

        <select name="page_redirect" id="page_redirect">
            <option value=""><?= __("Choose:",TEXT_DOMAIN);?>  </option>
            <?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
                <option value="<?php the_ID(); ?>" <?php selected(get_the_ID(), $page_redirect); ?>><?php the_title(); ?></option>
            <?php endwhile; ?>

        </select>


<?php
    }


    function save()
    {
        global $post;

        if (!isset($_POST["page_redirect"])) return $post;

        $page_redirect = $_POST['page_redirect'];

        update_post_meta($post->ID, 'page_redirect_meta_box', $page_redirect);
    }

    public function redirect()
    {
        global $post;
       
        $origin_redirect =  get_post_meta($post->ID, 'page_redirect_meta_box', true);
        
        $destiny_redirect = get_post_meta( $origin_redirect , 'page_redirect_meta_box', true);
        
        if($post->post_type !== "page" OR $origin_redirect ==  $destiny_redirect)  return;
        
       
        if (wp_safe_redirect( get_permalink($origin_redirect),301)){
            exit();
        }

        
    }
}

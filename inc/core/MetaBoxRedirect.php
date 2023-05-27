<?php

namespace Src\Core;

use Src\Core\Interfaces\Actions;

class MetaBoxRedirect implements Actions
{
    private $id, $title, $template, $post_type, $context, $priority;

    public function get_actions() {
        return array(
            'save_post' => ['save_data',10,1],
            'add_meta_boxes' => [ 'add_meta_box' ],
        );
    }
    public function __construct(string $id, string $title, string $post_type = "page", $context = "side", $priority = "default")
    {

        $this->id = $id;
        $this->title = $title;
        $this->post_type = $post_type;
        $this->context = $context;
        $this->priority = $priority;

        
    }

    public function add_meta_box()
    {
        add_meta_box(
            $this->id,
            $this->title,
            [$this, "render"],
            $this->post_type,
            $this->context,
            $this->priority
        );
    }


    public function render(\WP_Post $post)
    {
        
        
        $args = array(
            'post_type' => 'page',
           
            'post__not_in' => array( $post->ID ) 
        );
        $pages = new \WP_Query($args);
       

        wp_nonce_field( 'broobe_metabox_nonce', 'broobe_metabox_nonce' );
    ?>

        <div class="field-wrap">
       
        <p class="meta-options">
            <label for="page_redirect">Page</label>
           <select name="page_redirect" id="page_redirect">
            <option value="">Elegir</option>
            <?php foreach ($pages->posts as $key => $value) :?>
                <option value="<?= $value->id;?>"><?= $value->post_title;?></option>
            <?php endforeach;?>
           
           </select>
        </p>
    
        
        </div>

    <?php
    }

    public function save_data($post_id){
        
        $value_nonce = isset($_POST['broobe_metabox_nonce']) ? $_POST['broobe_metabox_nonce'] : "";
        $action_nonce = "broobe_metabox_nonce";
        
        if(
            !wp_verify_nonce($value_nonce, $action_nonce) || 
            !isset($valor_nonce) ||
            !current_user_can('edit_post', $post_id)
        ){
            return;
        }
        
        if(array_key_exists('page_redirect', $_POST)){
            
            update_post_meta(
                $post_id,
                '_page_redirect',
                $_POST['page_redirect']
            );
        }
    }
}

<?php 
namespace Src\Core;

use Src\Core\Interfaces\Actions;
use Src\Core\Interfaces\Filters;

class HooksManager {
    

    public function register( $object ) {
        if ( $object instanceof Actions ) {
            $this->register_actions( $object );
        }
        
        if ( $object instanceof Filters ) {
            $this->register_filters( $object );
        }
    }
 
    private function register_actions( $object ) {
        $actions = $object->get_actions();

        foreach ( $actions as $action_name => $action_details ) {
            $method        = $action_details[0];
            $priority      = (isset($action_details[1])?$action_details[1]:null);
            $accepted_args = (isset($action_details[2])?$action_details[2]:null);

            add_action(
                $action_name,
                array( $object, $method ),
                $priority,
                $accepted_args
            );
        }
    }
    
    private function register_filters( $object ) {
        $filters = $object->get_filters();

        foreach ( $filters as $filter_name => $filter_details ) {
            $method        = $filter_details[0];
            $priority      = $filter_details[1];
            $accepted_args = $filter_details[2];

            add_filter(
                $filter_name,
                array( $object, $method ),
                $priority,
                $accepted_args
            );
        }
    }
    
}
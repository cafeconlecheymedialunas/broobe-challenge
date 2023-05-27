<?php
namespace Src;

use Src\Core\HooksManager;
use Src\Core\MetaBoxRedirect;

class Theme
{
    private static $instance;

    public static function instance() {
		if ( is_null( ( self::$instance ) ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

    public function init() {

		$hooks_manager = new HooksManager();


		$metabox = new MetaBoxRedirect("redirect_to","Redirect To:","page");
		
		$hooks_manager->register( $metabox );
		
		
	}

	

}


<?php

namespace Src;


use Src\ListPagination;
use Src\Core\CustomEndpoint;
use Src\Core\HooksManager;

use Src\MetaBoxRedirect;


class Theme
{
	private static $instance;

	public static function instance()
	{
		if (is_null((self::$instance))) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function init()
	{

		$hooks_manager = new HooksManager();

		

		$metabox = new MetaBoxRedirect("broobe-metabox","Choose a page to redirect");

		$custom_endpoint = new CustomEndpoint;
		
		$list_pagination = new ListPagination("broobe-postlist");


		$hooks_manager->register( $metabox );

		$hooks_manager->register( $list_pagination );

		$hooks_manager->register( $custom_endpoint );
		
	}
}


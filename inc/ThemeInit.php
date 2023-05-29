<?php

namespace Src;

use Src\Core\HooksManager;

use Src\Functions\MetaBoxRedirect;
use Src\Functions\SearchQuery;
use Src\Functions\ListPagination;
use Src\Functions\CustomEndpoint;

class ThemeInit
{
	private static $instance,$initializer,$hooks_manager;

	public static function instance()
	{
		if (is_null((self::$instance))) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function run()
	{

		$this->hooks_manager = new HooksManager();

		$this->initializer = [
			new MetaBoxRedirect("broobe-metabox","Choose a page to redirect"),
			new CustomEndpoint,
			new ListPagination("broobe-postlist"),
			new SearchQuery
		];

		$this->initialize();

		
	}

	private function initialize()
	{
		foreach($this->initializer as $item){
			$this->hooks_manager->register( $item );
		}
	}
}


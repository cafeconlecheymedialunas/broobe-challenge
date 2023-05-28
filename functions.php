<?php
require __DIR__ . '/vendor/autoload.php';

define('ASSETS_VERSION', '1.0.1');
define("TEXT_DOMAIN","broobe-challenge");
define("CUSTOM_ENDPOINT_NAMESPACE",'custom/v1');
define("PAGINATION_DEFAULT_PAGE",1);
define("PAGINATION_DEFAULT_PER_PAGE",10);
use Src\Theme;


$theme_name_theme_object = Theme::instance();
$theme_name_theme_object->init();


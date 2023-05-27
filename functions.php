<?php
require __DIR__ . '/vendor/autoload.php';

define('ASSETS_VERSION', '1.0.1');
define("TEXT_DOMAIN","broobe-challenge");

use Src\Theme;


$theme_name_theme_object = Theme::instance();
$theme_name_theme_object->init();


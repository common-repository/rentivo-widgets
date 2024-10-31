<?php
define('ROOT', dirname(dirname(__FILE__)));
define('DS', DIRECTORY_SEPARATOR);
define ('DEVELOPMENT_ENVIRONMENT',true);
require_once "shared.php";
require_once ROOT . "/app/activate.php";
require_once ROOT . "/app/options.php";
require_once ROOT . "/app/enqueue.php";
require_once ROOT . "/app/meta.php";
require_once ROOT . "/app/api_routes.php";
require_once ROOT . "/app/panels.php";
require_once ROOT . "/app/shortcodes.php";
require_once ROOT . "/app/widgets.php";
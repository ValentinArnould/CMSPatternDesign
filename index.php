<?php
ini_set('display_errors', 1);

require_once('vendor/autoload.php');
require_once("vendor/leafo/scssphp/scss.inc.php");
$GLOBALS["config"] = require("./config.php");

use Router\Relper as Router;

$router = new Router;
$router->route();

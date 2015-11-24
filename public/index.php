<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use Illuminate\Http\Request;
use TestHugo\Http\Controllers\HomeController;

require_once __DIR__ . '/../vendor/autoload.php';

$request = Request::capture();
$controller = new HomeController();

$controller->index($request);
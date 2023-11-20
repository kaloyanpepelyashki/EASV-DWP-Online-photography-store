<?php
require_once __DIR__ . '/router.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Static GET
// In the URL -> http://localhost
// The output -> Index
get('/', './Views/index.php');

get("/product", "./Views/product.php");

get("/productsDemo", "./Views/product.php");

any('/404', './Views/404.php');
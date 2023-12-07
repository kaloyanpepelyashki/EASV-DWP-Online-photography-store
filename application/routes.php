<?php
require_once __DIR__ . '/router.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Static GET
// In the URL -> http://localhost
// The output -> Index
get('/', './Views/index.php');

get("/product/productid", "./Views/product.php");

post("/shoppingCart", "./Controllers/ShoppingCartController.php");
get("/shoppingCart", "./Controllers/ShoppingCartController.php");

any('/404', './Views/404.php');
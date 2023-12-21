<?php
require_once __DIR__ . '/router.php';
require_once __DIR__ . '/config.php';
$sessionStatus = session_status();

// Check if a session is active
if ($sessionStatus == PHP_SESSION_ACTIVE) {
    null;
} else {
    session_start();
}
error_reporting(E_ALL);
ini_set('display_errors', 1);

get('/', './Views/index.php');

get("/product/productid", "./Views/product.php");
get("/checkout", "./Views/checkout.php");

//ADMIN PANEL ROUTES
get("/login-admin", "./Views/admin-login.php");
//Dynamically re-renders routes
$adminRoute = isset($_SESSION['authState']) && $_SESSION['authState'] == true ? "./Views/admin-panel.php" : './Views/404.php';
get("/admin-panel", $adminRoute);
post("/adminPannelController", "./Controllers/AdminPannelController.php");

//SHOPPING CART ROUTES
post("/shoppingCart", "./Controllers/ShoppingCartController.php");
get("/shoppingCart", "./Controllers/ShoppingCartController.php");

post("/sendEmail", "./Controllers/EmailSenderController.php");

post("/signinAdmin", "./Controllers/AdminLoginController.php");

any('/404', './Views/404.php');
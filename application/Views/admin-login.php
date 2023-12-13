<?php
namespace Views;

use Controllers as C;

include_once(__DIR__ . '/../Controllers/AdminLoginController.php');

$controller = new C\AdminLoginController;


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    // $IPATH = $_SERVER['DOCUMENT_ROOT'] . '/assets/components/';
    // include $IPATH . 'head.php';
    ?>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <title>Login | Adam Sochorec</title>
    <meta name="robots" content="noindex" />
    <meta name="googlebot" content="noindex" />
</head>

<body>
    <h2>Please login</h2>

    <?php
    // $IPATH = $_SERVER['DOCUMENT_ROOT'] . '/assets/components/';
    // include $IPATH . 'nav-bar.php';
    ?>
    <main>
        <article class="wrapper-narrow">
            <div class="pathname-container"></div>
            <?php if ($controller->signIn("testd")) {
                echo $controller->signIn("testd");
                echo "It is working";
            } else {
                echo "It is not working";
            }
            ?>
            <h1>Admin Login</h1>
            <form action="" method="post">
                <input placeholder="Username" type="text" name="user" maxlength="30" value="" />
                <br /><br />
                <input type="password" placeholder="Password" name="password" maxlength="30" value="" />
                <input id="submit-btn" type="submit" name="submit" value="Login" />
            </form>
            <hr class="reveal" />
        </article>
    </main>
    <?php
    // $IPATH = $_SERVER['DOCUMENT_ROOT'] . '/assets/components/';
    // include $IPATH . 'footer.php';
    ?>
</body>
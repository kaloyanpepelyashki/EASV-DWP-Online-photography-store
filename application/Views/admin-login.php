<?php
namespace Views;

use Controllers as C;

include_once(__DIR__ . '/../Controllers/AdminLoginController.php');

$controller = new C\AdminLoginController;


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'Components/head.php'; ?>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <title>Login | Adam Sochorec</title>
    <meta name="robots" content="noindex" />
    <meta name="googlebot" content="noindex" />
</head>

<body class="store">
    <!-- HEADER START -->
    <?php include 'Components/nav-bar.php'; ?>
    <!-- HEADER END -->
    <main>
        <article class="wrapper-narrow">
            <div class="pathname-container"></div>
            <h1>Admin Login</h1>
            <form action="" method="post">
                <input placeholder="Username" id="username" type="text" name="user" maxlength="30" value="" />
                <br /><br />
                <input type="text" id="password" placeholder="Password" name="password" maxlength="30" />
                <button onclick="submitForm()" id="submit-btn" type="button" name="submit">
                    OK
                </button>
            </form>
            <hr class="reveal" />
        </article>
        <br /><br /><br />
        <a href="admin-panel"><button>Temporary link to access admin panel</button></a>
    </main>
    <!-- FOOTER START -->
    <?php include 'Components/footer.php'; ?>
    <!-- FOOTER END -->
    <script src="../../Public/adminLogIn.js"></script>
</body>

</html>
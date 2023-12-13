<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/constants.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/session.php"); ?>
<?php if (logged_in()) {
  redirect_to("frontpage.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  $IPATH = $_SERVER['DOCUMENT_ROOT'] . '/assets/components/';
  include $IPATH . 'head.php';
  ?>
  <meta name="description" content="" />
  <meta name="keywords" content="" />
  <title>Login | Adam Sochorec</title>
  <meta name="robots" content="noindex" />
  <meta name="googlebot" content="noindex" />
</head>

<body>
  <?php
  // START FORM PROCESSING
  if (isset($_POST['submit'])) { // form has been submited
    $username = trim(mysqli_real_escape_string($connection, $_POST['user']));
    $password = trim(mysqli_real_escape_string($connection, $_POST['password']));
    $query = "SELECT id, user, password FROM users WHERE user = '{$username}' LIMIT 1";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) == 1) {
      // username/password authenticated
      // and only one match
      $found_user = mysqli_fetch_array($result);
      if (password_verify($password, $found_user['password'])) {
        $_SESSION['user_id'] == $found_user['id'];
        $_SESSION['user'] = $found_user['user'];
        redirect_to("frontpage.php");
      } else {
        // username/password combo was not found in the database
        $message = "Username/password combination incorrect<br>Please make
    usre your caps loc key is off and try again.";
      }
    }
  } else { // Form has not been submitted. if (isset($_GET['logout']) && $_GET['logout'] == 1){
    $message = "Your now logged out.";
  }
  if (!empty($message)) {
    echo "
    <p>" . $message . "</p>
    ";
  } ?>

  <h2>Please login</h2>

  <?php
  $IPATH = $_SERVER['DOCUMENT_ROOT'] . '/assets/components/';
  include $IPATH . 'nav-bar.php';
  ?>
  <main>
    <article class="wrapper-narrow">
      <div class="pathname-container"></div>
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
  $IPATH = $_SERVER['DOCUMENT_ROOT'] . '/assets/components/';
  include $IPATH . 'footer.php';
  ?>
</body>

</html>
<?php
if (isset($connection)) {
  mysqli_close($connection);
}
?>
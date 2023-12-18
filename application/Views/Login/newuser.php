<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/constants.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php // confirm_logged_in(); ?>

<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
    <meta name="robots" content="noindex" />
    <meta name="googlebot" content="noindex" />
  </head>
  <body class="store">
    <!-- HEADER START -->
    <?php include 'nav-bar.php'; ?>
    <!-- HEADER END -->
    <main>
      <?php
// START FORM PROCESSING
if (isset($_POST['submit'])) { // Form has been submitted.

	// perform validations on the form data
	$username = trim(mysqli_real_escape_string($connection, $_POST['user']));
	$password = trim(mysqli_real_escape_string($connection, $_POST['password']));
    $iterations = ['cost' =>
      15]; $hashed_password = password_hash($password, PASSWORD_BCRYPT,
      $iterations); $query = "INSERT INTO `users` (user, password) VALUES
      ('{$username}', '{$hashed_password}')"; $result =
      mysqli_query($connection, $query); if ($result) { $message = "User
      Created."; } else { $message = "User could not be created."; $message .=
      "<br />" . mysqli_error($connection); } } if (!empty($message)) {echo "
      <p>" . $message . "</p>
      ";} ?>
      <div class="pathname-container"></div>

      <article class="wrapper-narrow">
        <h2>Create New User</h2>
        <form action="" method="post">
          Username:
          <input type="text" name="user" maxlength="30" value="" />
          Password:
          <input type="password" name="password" maxlength="30" value="" />
          <input type="submit" name="submit" value="Create" />
        </form>
      </article>
    </main>
  </body>

  <!-- FOOTER START -->
  <?php include 'footer.php'; ?>
  <!-- FOOTER END -->
</html>
<?php
if (isset($connection)){mysqli_close($connection);}
?>

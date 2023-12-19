<?php require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/session.php");?>
<?php confirm_logged_in();?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include 'head.php'; ?>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Frontpage</title>
    <meta name="robots" content="noindex" />
    <meta name="googlebot" content="noindex" />
  </head>
  <body class="store">
    <main>
      <!-- HEADER START -->
      <?php include 'nav-bar.php'; ?>
      <!-- HEADER END -->
      <main>
        <div class="pathname-container"></div>

        <article class="wrapper-standard">
          <h1>Welcome to the backend</h1>
        </article>
      </main>
      <!-- FOOTER START -->
      <?php include 'footer.php'; ?>
      <!-- FOOTER END -->
    </main>
  </body>
</html>

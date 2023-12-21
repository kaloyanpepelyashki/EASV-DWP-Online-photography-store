<?php
namespace Views;

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include 'Components/head.php'; ?>
  <title>Page Not Found | Adam Sochorec</title>

  <meta name="robots" content="noindex" />
  <meta name="googlebot" content="noindex" />
</head>

<body id="error" class="noindex">
  <!-- HEADER START -->
  <?php include 'Components/nav-bar.php'; ?>
  <!-- HEADER END -->
  <main>
    <article class="wrapper-narrow flex-center">
      <div class="pathname-container"></div>
      <div class="lottie">
        <dotlottie-player src="https://adamsochorec.com/assets/lottie/error3.1.lottie" background="transparent"
          speed="0.7" loop class="reveal" autoplay></dotlottie-player>
      </div>
      <h1>The page you are looking<br />for cannot be found.</h1>
      <h2 class="reveal">
        <a href="http://adamsochorec.com">Return to the homepage &#8250;</a>
      </h2>
    </article>
  </main>
  <!-- LOTTIE PLAYER SCRIPT START -->
  <script defer type="text/javascript"
    src="https://unpkg.com/@dotlottie/player-component@1.0.0/dist/dotlottie-player.js"></script>
  <!-- LOTTIE PLAYER SCRIPT END -->
  <!-- FOOTER START -->
  <?php include 'Components/footer.php'; ?>
  <!-- FOOTER END -->
</body>

</html>
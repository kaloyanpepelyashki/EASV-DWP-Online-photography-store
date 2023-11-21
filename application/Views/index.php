<?php
//ADDITIONAL LOGIC OF THE VIEW GOES HERE
include_once(__DIR__ . '/../Controllers/HomeController.php');

use Controllers as C;

$controller = new C\HomeController();

//Just a test to show how the getDatabaseClient works
function renderTable($controller)
{

    foreach ($controller->getDatabaseClient()->getAllFromTable("customer") as
$customer) { // Access individual values for each customer $customerId =
$customer['customerid']; $firstName = $customer['firstname']; $lastName =
$customer['lastname']; $email = $customer['email']; $phone = $customer['phone'];
// Output or process the values as needed echo "
<tr>
  <td>$customerId</td>
  <td>$firstName $lastName</td>
  <td>$email</td>
  <td>$phone</td>
</tr>
"; } } function renderTableProducts($controller) { foreach
($controller->getAllProducts() as $product) { $productId =
$product["productid"]; $productName = $product["name"]; $productUrl =
$product["url"]; echo "
<tr>
  <td>$productId</td>
  <td>$productName</td>
  <td><img src="$productUrl" /></td>
</tr>
"; } } ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <?php include 'assets/components/head.php'; ?>
  </head>

  <body>
    <?php include 'assets/components/nav-bar.php'; ?>
    <h1>This is home page</h1>
    <h3>This table outputs the customers</h3>
    <table border="1">
      <tbody>
        <thead>
          <tr>
            <td>Id</td>
            <td>Names</td>
            <td>Email</td>
            <td>Phone</td>
          </tr>
        </thead>
        <?php renderTable($controller); ?>
      </tbody>
    </table>
    <h3>This table outputs the products</h3>
    <table border="1">
      <tbody>
        <thead>
          <tr>
            <td>Id</td>
            <td>Name</td>
            <td>Image</td>
          </tr>
        </thead>
        <?php renderTableProducts($controller); ?>
      </tbody>
    </table>

    <?php



    $product = $controller->getProduct_byId(2); echo $product["productid"]; ?>
    <main>
      <article class="wrapper-wide">
        <div class="pathname-container"></div>
        <div class="grid-container fifty-fifty">
          <div class="grid-item">
            <h1 class="reveal">Recently published</h1>
            <p class="reveal">
              Lorem ipsum, dolor sit amet consectetur adipisicing elit. Qui
              voluptatem blanditiis expedita omnis corrupti id rem perspiciatis
              possimus, cumque cum optio ut illo incidunt laborum ad magnam est,
              architecto dignissimos.
            </p>
            <a href="./product" class="cta flex-center hideCTA-max reveal"
              >Learn more
            </a>
          </div>
          <div class="grid-item v-stretch reveal">
            <img src="/img/2021-04-13-00596.jpg" />
            <a href="./product" class="cta flex-center hideCTA-min reveal"
              >Learn more
            </a>
          </div>
        </div>
        <hr class="reveal" />
        <!-- PRODUCTS SECTION START -->
        <section class="product-grid">
          <!-- Products go in here -->
        </section>
      </article>
      <!-- PRODUCTS SECTION END -->
      <!-- ABOUT START -->
      <hr class="semi" />
      <article class="wrapper-standard">
        <hr class="reveal" />
        <h1 class="reveal">ABOUT</h1>

        <!-- THE GRID THAT HOLDS THE PRODUCTS -->
        <section class="product-grid">
          <!-- GRID ELEMENT -->
          <?php
                //The function that outputs the product template for each item from the database
                renderTableProducts($controller);
                ?>
        </section>

        <p class="reveal">
          Greetings from Denmark! As a Czech-born multimedia design student 🇨🇿,
          I'm bringing the Slavic spirit to my new venture,
          <a
            href="https://www.slavicmedia.dk"
            target="_blank"
            rel="noopener noreferrer"
            >Slavic Media</a
          >
          – small but mighty!
        </p>
        <p class="reveal">
          I'm a Canon-wielding photography enthusiast with a side of iPhone, and
          a website wizard, thanks to my multimedia studies on
          <a
            href="https://www.iba.dk/fuldtidsuddannelser"
            target="_blank"
            rel="noopener noreferrer"
            >Erhversakademi Kolding</a
          >.
        </p>
        <p class="reveal">
          Former
          <a
            href="https://www.flickr.com/photos/141401020@N03/"
            target="_blank"
            rel="noopener noreferrer"
            >LEGO architect</a
          >, current purveyor of digital aesthetics and sarcasm.
        </p>
        <p class="reveal">PS: No cookies — just creativity!</p>
        <hr class="reveal" />
      </article>
      <!-- CONTACT FORM END -->
    </main>
    <!--  <?php
    // echo $blog['extra-footer'] 
    ?> -->
    <?php include 'assets/components/footer.php'; ?>
  </body>
</html>

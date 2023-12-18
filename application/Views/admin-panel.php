<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include 'Components/head.php'; ?>
    <title>Product details | Adam Sochorec</title>
    <meta name="robots" content="noindex" />
    <meta name="googlebot" content="noindex" />
  </head>

  <body class="store">
    <main>
      <?php include 'Components/nav-bar.php'; ?>

      <article class="wrapper-standard">
        <div class="pathname-container"></div>
        <div class="panel-container">
          <div class="tab">
            <button class="tablinks" onclick="openCity(event, 'orders')">
              Orders overview
            </button>
            <button class="tablinks" onclick="openCity(event, 'about')">
              About section
            </button>
            <button class="tablinks" onclick="openCity(event, 'products')">
              Products
            </button>
            <button class="tablinks" onclick="openCity(event, 'daily')">
              Daily special offer
            </button>
            <button class="tablinks" onclick="openCity(event, 'news')">
              News
            </button>
          </div>

          <div id="orders" class="tabcontent">
            <h3>Overview of orders</h3>
            <p>Here we will display an overview of all made orders.</p>
            <br /><br />
            <p>London is the capital city of England.</p>
            <p>London is the capital city of England.</p>
            <p>London is the capital city of England.</p>
            <p>London is the capital city of England.</p>
            <p>London is the capital city of England.</p>
            <p>London is the capital city of England.</p>
            <p>London is the capital city of England.</p>
            <p>London is the capital city of England.</p>
            <p>London is the capital city of England.</p>
            <p>London is the capital city of England.</p>
            <p>London is the capital city of England.</p>
            <p>London is the capital city of England.</p>
            <p>London is the capital city of England.</p>
            <p>London is the capital city of England.</p>
            <p>London is the capital city of England.</p>
            <p>London is the capital city of England.</p>
            <p>London is the capital city of England.</p>
            <p>London is the capital city of England.</p>
            <p>London is the capital city of England.</p>
            <p>London is the capital city of England.</p>
            <p>London is the capital city of England.</p>
            <p>London is the capital city of England.</p>
            <p>London is the capital city of England.</p>
            <p>London is the capital city of England.</p>
            <p>London is the capital city of England.</p>
            <p>London is the capital city of England.</p>
            <p>London is the capital city of England.</p>
            <p>London is the capital city of England.</p>
            <p>London is the capital city of England.</p>
            <p>London is the capital city of England.</p>
            <p>London is the capital city of England.</p>
            <p>London is the capital city of England.</p>
            <p>London is the capital city of England.</p>
            <p>London is the capital city of England.</p>
            <p>London is the capital city of England.</p>
            <p>London is the capital city of England.</p>
            <p>London is the capital city of England.</p>
          </div>

          <div id="about" class="tabcontent">
            <h3>About</h3>
            <p>READ AND UPDATE</p>
            <p>About shop. About owner. Contact info. Opening/closing hours.</p>
          </div>

          <div id="products" class="tabcontent">
            <h3>Products</h3>
            <p>Full CRUD for photos, print types, sizes and frames.</p>
          </div>

          <div id="daily" class="tabcontent">
            <h3>Daily</h3>
            <p>
              Full CRUD for daily special offer. Select product in question.
              State discount percentage. Daily offer message maybe?
            </p>
          </div>

          <div id="news" class="tabcontent">
            <h3>News</h3>
            <p>
              CRUD for news. News are displayed on the homepage. They have a
              date and text contect.
            </p>
          </div>
        </div>
      </article>
    </main>
    <!-- FOOTER START -->
    <?php include 'footer.php'; ?>
    <!-- FOOTER END -->
  </body>
</html>

<?php
//ADDITIONAL LOGIC OF THE VIEW GOES HERE
require_once(__DIR__ . '/../Controllers/ProductOverviewController.php');
require_once(__DIR__ . '/../Controllers/ShoppingCartController.php');

use Controllers as C;

$id;
if (isset($_GET['id'])) {
    //Gets the id parameter from url 
    $id = $_GET['id'];
} else {
    echo "No Id was set";
}
$controller = new C\ProductOverviewController($id);

$product = $controller->getProduct(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'Components/head.php'; ?>

    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <title>Product details | Adam Sochorec</title>
</head>

<body id="store-product" class="store">
    <?php
    // $IPATH = $_SERVER['DOCUMENT_ROOT'] . '/assets/components/';
    // include $IPATH . 'nav-bar.php';
    // var_dump($controller->getShoppingCartItems()); ?>
    <?php include 'Components/shopping-cart.php'; ?>

    <main>
        <article class="wrapper-wide">
            <h1>
                #
                <?php echo $product->getPhoto()->name; ?>
            </h1>
            <div class="pathname-container">
                <p>
                    <span class="pathname"><a href="/"></a> &#8250; </span>
                    <span class="pathname"><a href="/store/store">store</a> &#8250; #
                        <?php echo $product->getPhoto()->name; ?>
                    </span>
                </p>
            </div>
            <div class="grid-container seventy-thirty">
                <div class="grid-item">
                    <!-- Slider main container -->
                    <div class="swiper product-swiper">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Slides -->
                            <div class="swiper-slide">
                                <img src="<?php echo $product->getPhoto()->url ?>" />
                            </div>
                            <div class="swiper-slide">
                                <img src="./prints/21071948976502.jpg" />
                            </div>
                            <div class="swiper-slide">
                                <img src="./prints/21100178367026.jpg" />
                            </div>
                        </div>

                        <!-- If we need navigation buttons -->
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                        <!-- If we need pagination -->
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
                <div class="grid-item">
                    <h2>
                        <?php echo $product->getPhoto()->basePrice; ?> DKK
                    </h2>
                    <p style="font-size: 10pt">incl. VAT / excl. shipping</p>
                    <p style="font-size: 18pt">
                        Aspect Ratio:
                        <b>
                            <?php echo $product->getPhoto()->aspectRatio; ?>
                        </b>
                    </p>
                    <select id="size" name="size" required>
                        <option value="" selected>Select size &#8250;</option>
                        <option value="10x10">10 x 10cm</option>
                        <option value="20x20">20 x 20cm</option>
                        <option value="30x30">30 x 30cm</option>
                        <option value="40x40">40 x 40cm</option>
                    </select>
                    <select id="material" name="material" required>
                        <option value="" selected>Select material &#8250;</option>
                        <option value="glossy-paper">Glossy photo paper</option>
                    </select>
                    <select id="frame" name="frame" required>
                        <option value="" selected>Select frame &#8250;</option>
                        <option value="none">None</option>
                        <option value="wood">Wood</option>
                    </select>
                    <a onclick='addToCart(<?php echo json_encode($product); ?>)' class="cta flex-center">Add to cart</a>
                </div>
            </div>
            <hr class="reveal" />
            <h2>Product Information</h2>
            <ul>
                <li>Lorem</li>
                <li>Lorem</li>
                <li>Lorem</li>
                <li>Lorem</li>
                <li>Lorem</li>
                <li>Lorem</li>
            </ul>
            <hr class="reveal" />

            <h2 class="reveal">Other customers purchased</h2>
            <br /><!-- Slider main container -->
            <div class="swiper recommendation-swiper reveal">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    <div class="swiper-slide">
                        <?php
                        $IPATH = $_SERVER['DOCUMENT_ROOT'] . '/assets/components/';
                        include $IPATH . 'Components/product-component.php';
                        ?>
                    </div>
                    <div class="swiper-slide">
                        <?php include 'Components/product-component.php'; ?>
                        <img src="<?php echo $product->url; ?>" />
                    </div>
                    <div class="swiper-slide">
                        <?php include 'assets/components/product-component.php'; ?>
                    </div>
                    <div class="swiper-slide">
                        <?php include 'assets/components/product-component.php'; ?>
                    </div>
                    <div class="swiper-slide">
                        <?php include 'assets/components/product-component.php'; ?>
                    </div>
                    <div class="swiper-slide">
                        <?php
                        $IPATH = $_SERVER['DOCUMENT_ROOT'] . '/assets/components/';
                        include $IPATH . 'product-component.php';
                        ?>
                    </div>
                </div>
            </div>
        </article>
    </main>
    <?php
    // $IPATH = $_SERVER['DOCUMENT_ROOT'] . '/Components/';
    include 'Components/footer.php';
    ?>
    <script src="../Public/cartInteractions.js"></script>
</body>

</html>
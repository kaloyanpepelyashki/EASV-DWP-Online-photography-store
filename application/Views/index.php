<?php
//ADDITIONAL LOGIC OF THE VIEW GOES HERE
include_once(__DIR__ . '/../Controllers/HomeController.php');
include_once(__DIR__ . '/../Controllers/ShoppingCartController.php');

use Controllers as C;

$controller = new C\HomeController();


function renderTableProducts($controller)
{
    foreach ($controller->getAllProducts() as $product) {
        $productId = $product["id"];
        $productName = $product["name"];
        $productUrl = $product["url"];
        echo "<div class='grid-item' id='product-component'><a href='/store/product'><img  src='$productUrl'><a><div class='text-wrapper flex-center'><h3>$productName</h3><p>From 300 DKK</p><a href='./product' class='cta cta-2 flex-center'>Buy</a></div></div>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include 'Components/head.php';
    ?>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
</head>

<body>
    <?php include 'Components/nav-bar.php'; ?>

    <main>

        <!--NEWS STARTS HERE-->
        <article class="wrapper-wide" style="margin-top:8rem;">
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
                    <a href="./product" class="cta flex-center hideCTA-max reveal">Learn more
                    </a>
                </div>
                <div class="grid-item v-stretch reveal">
                    <img src="/img/2021-04-13-00596.jpg" />
                    <a href="./product" class="cta flex-center hideCTA-min reveal">Learn more
                    </a>
                </div>
            </div>
            <hr class="reveal" />
            <!-- PRODUCTS SECTION START -->

        </article>
        <!-- PRODUCTS SECTION END -->
        <!-- ABOUT START -->
        <hr class="semi" />
        <!--PRODUCT LIST STARTS HERE-->
        <article class="wrapper-standard">
            <hr class="reveal" />
            <h1 class="reveal">ABOUT</h1>
            <?php
            var_dump($controller->getShoppingCartItems());

            var_dump($_SESSION['cart']);
            ?>




            <!-- THE GRID THAT HOLDS THE PRODUCTS -->
            <button onclick="addToCart('kikiriki')">Add to cart</button>
            <div id=" shoppingCartFrontEnd"></div>
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
                <a href="https://www.slavicmedia.dk" target="_blank" rel="noopener noreferrer">Slavic Media</a>
                – small but mighty!
            </p>
            <p class="reveal">
                I'm a Canon-wielding photography enthusiast with a side of iPhone, and
                a website wizard, thanks to my multimedia studies on
                <a href="https://www.iba.dk/fuldtidsuddannelser" target="_blank"
                    rel="noopener noreferrer">Erhversakademi Kolding</a>.
            </p>
            <p class="reveal">
                Former
                <a href="https://www.flickr.com/photos/141401020@N03/" target="_blank" rel="noopener noreferrer">LEGO
                    architect</a>, current purveyor of digital aesthetics and sarcasm.
            </p>
            <p class="reveal">PS: No cookies — just creativity!</p>
            <hr class="reveal" />
        </article>
        <!-- CONTACT FORM END -->
    </main>
    <script>
        //THIS JS CODE IS TO BE MOVED TO A INDIVIDUAL FILE


        const shoppingCartFrontEnd = document.getElementById("shoppingCartFrontEnd");

        function addToCart(item) {
            try {
                xlr = new XMLHttpRequest();
                xlr.open("POST", "/shoppingCart", true);
                xlr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xlr.send(`action=add&item=${encodeURIComponent(item)}`);

                xlr.onreadystatechange = function () {
                    if (this.readyState === 4) {
                        console.log(`XLR Status: ${this.status, this.responseText}`);
                        cartItems.push(item);

                        console.log("Item added to cart")
                        if (this.status === 200) {
                            console.log(xlr.responseText);
                        }

                    } else {
                        console.error("Error, failed to add to cart");
                    }
                };


            } catch (e) {
                console.log(`Error adding to cart: ${e.message}`);

            }
        }

        document.addEventListener("DOMContentLoaded", () => {
            function fetchFromCart() {
                try {
                    xlr = new XMLHttpRequest();
                    xlr.open("GET", "/shoppingCart?action=get", true);
                    xlr.setRequestHeader("Content-Type", "application/json");
                    xlr.send();

                    xlr.onreadystatechange = () => {

                        if (xlr.status === 200) {
                            try {
                                const responseText = xlr.responseText;
                                //Regular Expression to escape in the responseText.
                                const regex2 = /<pre.*?>([\s\S]*?)<\/pre>/s;

                                //Escaping the regex found in the responseText string
                                let escapedString = responseText.replace(regex2, "\$2").replace("$2", " ")
                                if (escapedString && escapedString.length >= 1) {

                                    //Parsing the escaped string to JSON
                                    let parsed = JSON.parse(escapedString);
                                    parsed.forEach((item) => {
                                        console.log(item)
                                    })
                                } else {
                                    console.error('Failed to extract array from response');
                                }
                            } catch (e) {
                                console.error("Error parsing JSON: " + e.message);
                                console.log("Response in plain text: " + xlr.responseText);
                            }
                        } else {
                            console.error("Could not get cart items. Status: " + xlr.status)
                        }

                    }

                } catch (e) {
                    console.error("Error getting cart items: " + e.message);
                }
            }
            fetchFromCart();
        });
    </script>
</body>
<?php include_once("Components/footer.php"); ?>
<script src="/Views/assets/autoload.js"></script>

</html>
<?php
//ADDITIONAL LOGIC OF THE VIEW GOES HERE
include_once(__DIR__ . '/../Controllers/HomeController.php');
include_once(__DIR__ . '/../Controllers/ShoppingCartController.php');
include_once(__DIR__ . '/../Controllers/AdminPannelController.php');

use Controllers as C;

$controller = new C\HomeController();
//Geting the object of the latest uploaded photo 
$latestProduct = $controller->getLatestProduct();
$shopAbout = $controller->getShopInfo();
$newsMessage = $controller->getNewsMessage();

function renderTableProducts($controller)
{
    foreach ($controller->getAllProducts() as $product) {
        $productId = $product["id"];
        $productName = $product["name"];
        $productUrl = $product["url"];
        $productPrice = $product["base_price"];
        echo "<div class='grid-item' id='product-component'><a href='/product/productid?id=$productId'><img  src='$productUrl'><a><div class='text-wrapper flex-center'><h3>$productName</h3><p>From $productPrice DKK</p><a href='/product/productid?id=$productId' class='cta cta-2 flex-center'>Buy</a></div></div>";
    }
}
function insertIntoTable(string $table, array $items)
{

    function getArrayKeys($items)
    {
        foreach (array_keys($items) as $keys) {
            return "'" . implode("', '", array_keys($items)) . "'";
        }

    }

    function getArrayValues(array $items)
    {
        foreach (array_values($items) as $value) {
            return "'" . implode("', '", array_values($items)) . "'";
        }
    }

    $query = "INSERT INTO $table (" . getArrayKeys($items) . ") VALUES ( " . getArrayValues($items) . ")";

    echo $query;
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

<body id="store-index" class="store">
    <?php include 'Components/nav-bar.php'; ?>
    <?php include 'Components/shopping-cart.php'; ?>

    <main>

        <!--NEWS MESSAGE STARTS HERE-->
        <article class="wrapper-wide" style="margin-top: 4rem;">
            <div class="box" id="myBox">
                <div class="close-button" onclick="closeBox()">
                    <i class="fa-solid fa-x" style="color:white;"></i>
                </div>
                <p>
                    <?php echo $newsMessage['newsMessageText']; ?><br>
                    News date: <?php echo $newsMessage['newsMessageDate']; ?>
                </p>
            </div>
        </article>
        

        <!--DAILY OFFER STARTS HERE-->
        <article class="wrapper-wide">
            <div class="pathname-container"></div>
            <div class="grid-container fifty-fifty">
                <div class="grid-item">
                    <h1 class="reveal">Recently published</h1>
                    <p class="reveal">
                        <?php echo $latestProduct['description'] ?>
                    </p>
                    <a href="/product/productid?id=<?php echo intval($latestProduct['id']) ?>"
                        class="cta flex-center hideCTA-max reveal">Learn more
                    </a>
                </div>
                <div class="grid-item v-stretch reveal">
                    <img src="<?php echo $latestProduct['url'] ?>" />
                    <a href="/product/productid?id=<?php echo intval($latestProduct['id']) ?>"
                        class="cta flex-center hideCTA-min reveal">Learn more
                    </a>
                </div>
            </div>
            <hr class="reveal" />
            <!-- PRODUCTS SECTION START -->
            <section class="product-grid">
                <!-- GRID ELEMENT -->
                <?php
                //The function that outputs the product template for each item from the database
                renderTableProducts($controller);
                ?>
            </section>
        </article>
        <!-- PRODUCTS SECTION END -->
        <?php include_once("Components/email-form.php"); ?>
        <!-- ABOUT START -->
        <hr class="semi" />
        <!--PRODUCT LIST STARTS HERE-->
        <article class="wrapper-standard">
            <hr class="reveal" />
            <h1 class="reveal">ABOUT</h1>

            <p class="reveal">
                <?php echo $shopAbout['shopAboutText']; ?> <br>
            </p>
            <p class="reveal">
                Telephone number: <?php echo $shopAbout['ownerTelNumber']; ?> <br>
                Contact email: <?php echo $shopAbout['ownerMail']; ?> <br>
                Opening/closing hours: <?php echo $shopAbout['openingHour']; ?> - <?php echo $shopAbout['closingHour']; ?> <br><br>
            </p>
            <hr class="reveal" />
        </article>
        <!-- CONTACT FORM END -->
    </main>
    <script src="../Public/cartInteractions.js"></script>
    <script>
        function sendEmail() {
            let email = document.getElementById("email").value;
            let name = document.getElementById("name").value;
            let subject = document.getElementById("subject").value;
            let message = document.getElementById("message").value;
            let company = document.getElementById("company").value;

            if (email.length <= 0 || name.length <= 0 || subject.length <= 0 || message.length <= 0) {
                window.alert("Please fill out all fields");

            } else {
                let emailObject = {
                    email: email,
                    name: name,
                    subject: subject,
                    message: message,
                    company: company.length > 0 ?? company | "none",
                }

                try {
                    const xlr = new XMLHttpRequest();
                    xlr.open("POST", "/sendEmail?action=send", true);
                    xlr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
                    xlr.send(`action=send&emailObject=${JSON.stringify(emailObject)}`);

                    xlr.onreadystatechange = function() {
                        if (xlr.readyState == 4) {
                            responeText = xlr.responseText;

                            console.log(responeText);
                            if (xlr.status == 200) {
                                console.log("email sent successfully");
                            }
                        }
                    }
                } catch (e) {
                    console.error("Error sending email :" + e.message);
                }
            }
        }
    </script>
</body>
<?php include_once("Components/footer.php"); ?>
<script src="/Views/assets/autoload.js"></script>

</html>
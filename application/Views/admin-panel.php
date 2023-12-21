<?php
namespace Views;

use Controllers as C;

include_once(__DIR__ . '/../Controllers/AdminPannelController.php');

$controller = new C\AdminPannelController();
$shopAbout = $controller->getShopAbout();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'Components/head.php'; ?>
    <title>Product details | Adam Sochorec</title>
    <meta name="robots" content="noindex" />
    <meta name="googlebot" content="noindex" />
</head>
<style>
    .toggle {
        margin: 0 0 -0.6rem 1rem;
        position: relative;
        display: inline-block;
        width: 4rem;
        height: 2rem;
    }

    .toggle input {
        display: none;
    }

    .roundbutton {
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        width: 100%;
        background-color: #33455e;
        display: block;
        transition: all 0.3s;
        border-radius: 3.4rem;
        cursor: pointer;
    }

    .roundbutton:before {
        position: absolute;
        content: "";
        height: 1.4rem;
        width: 1.5rem;
        border-radius: 100%;
        display: block;
        left: 0.35rem;
        bottom: 0.3rem;
        background-color: white;
        transition: all 0.3s;
    }

    input:checked+.roundbutton {
        background-color: #FF6E48;
    }

    input:checked+.roundbutton:before {
        transform: translate(1.8rem, 0);
    }
</style>

<body class="store">

    <?php include 'Components/nav-bar.php'; ?>
    <main>

        <br><br><br>

        <div class="panel-container">
            <div class="tab">
                <button class="tablinks" onclick="openTab(event, 'orders')">
                    Orders overview
                </button>
                <button class="tablinks" onclick="openTab(event, 'about')">
                    About section
                </button>
                <button class="tablinks" onclick="openTab(event, 'products')">
                    Products
                </button>
                <button class="tablinks" onclick="openTab(event, 'daily')">
                    Daily special offer
                </button>
                <button class="tablinks" onclick="openTab(event, 'news')">
                    News
                </button>
            </div>

            <div id="orders" class="tabcontent">
                <h3>Overview of orders</h3>
                <p>Here is an overview of all made orders:</p><br>
                <p style="display:inline;">Filter delivered purchases:</p>
                <label class="toggle" style="display:inline-block;">
                    <input id="toggleswitch" type="checkbox" onchange="toggleTables()">
                    <span class="roundbutton"></span>
                </label><br><br>
                <table id="table1" class="table-orders" border="1" style="color:white; width:100%;">
                    <th>
                        <tr>
                            <td>
                                Id
                            </td>
                            <td>
                                Created at
                            </td>
                            <td>
                                Expected Delivery
                            </td>
                            <td>
                                Delivered
                            </td>
                        </tr>
                    </th>
                    <tbody>
                        <?php
                        foreach ($controller->getAllOrders() as $order) {
                            $orderId = $order['id'];
                            $orderCreatedAt = $order['created_at'];
                            $orderExpectedDelivery = $order['expected_delivery'];
                            $orderStatus = $order['done'];

                            $orderStausOutput = $orderStatus === "f" ? "Not done" : "Done";

                            $doneColor = $orderStatus === "f" ? "red" : "green";

                            echo "<tr><td>$orderId</td><td>$orderCreatedAt</td><td>$orderExpectedDelivery</td><td style='background-color:$doneColor'>$orderStausOutput </td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <table id="table2" class="table-orders" border="1" style="color:white; width:100%; display: none;">
                    <th>
                        <tr>
                            <td>
                                Id
                            </td>
                            <td>
                                Created at
                            </td>
                            <td>
                                Expected Delivery
                            </td>
                            <td>
                                Delivered
                            </td>
                        </tr>
                    </th>
                    <tbody>
                        <?php
                        foreach ($controller->getAllUndelivered() as $undeliveredProduct) {
                            $orderId = $undeliveredProduct['id'];
                            $orderCreatedAt = $undeliveredProduct['created_at'];
                            $orderExpectedDelivery = $undeliveredProduct['expected_delivery'];
                            $orderStatus = $undeliveredProduct['done'];

                            echo "<tr><td>$orderId</td><td>$orderCreatedAt</td><td>$orderExpectedDelivery</td><td style='background-color:$doneColor'>$orderStausOutput </td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <div id="about" class="tabcontent">
                <h3>About</h3>
                <p>READ AND UPDATE</p>
                <p>About shop. About owner. Contact info. Opening/closing hoursss.</p>

                <table class="table-orders" border="1" style="color:white; width:100%">
                    <th>
                        <tr>
                            <td>
                                About text
                            </td>
                            <td>
                                Email
                            </td>
                            <td>
                                Tel number
                            </td>
                            <td>
                                Working time
                            </td>
                        </tr>
                    </th>
                    <tbody>
                        <?php
                        $shopAboutText = $shopAbout['about'];
                        $shopOwnerTel = $shopAbout['ownerTelNumber'];
                        $shopWorkingTime = $shopAbout['openingHour'] . " - " . $shopAbout['closingHour'];
                        echo "<tr><td>$shopAboutText</td><td>sdadas</td><td>$shopOwnerTel</td><td>$shopWorkingTime</td></tr>";
                        ?>
                    </tbody>
                </table>
                <input type="text" id="shopInfoAboutText" placeholder="update About info" />
                <button onclick="updateShopAbout()" type="button">Update</button>
                <input type="text" id="shopOwnerTel" placeholder="update owner telephone" />
                <button onclick="updateShopOwnerTel()" type="button">Update</button>
            </div>

            <div id="products" class="tabcontent">
                <h3>Products</h3>
                <p>Full CRUD for photos, print types, sizes and frames.</p>
                <div id="cart-items-output" class="cart-items">
                    <?php
                    foreach ($controller->getAllProducts() as $product) {
                        $productName = $product['name'];
                        $productPrice = $product['base_price'];
                        $productUrl = $product['url'];

                        echo "<div class='grid-container table cart-item' style='color:white;'>
                                <div class='grid-container fifty-fifty'>
                                    <div class='grid-item'>
                                        <img src='$productUrl' />
                                    </div>
                                    <span class='grid-item left'>
                                <b>$productName</b><br />
                                40x60cm<br />Glossy photo paper<br />
                                No frame</span>
                                </div>
                                <span><u></u></span>
                                <span><b>$productPrice</b> DKK</span>
                                <span class='right'><i class='fa-solid fa-trash' style='font-size:15pt'></i></span>
                                </div><hr/>";
                    }
                    ?>
                </div>
            </div>

            <div id="daily" class="tabcontent">
                <h3>Daily</h3>
                <p>Full CRUD for daily special offer. Select product in question. State discount percentage. Daily offer
                    message maybe?</p>
            </div>

            <div id="news" class="tabcontent">
                <h3>News</h3>
                <p>CRUD for news. News are displayed on the homepage. They have a date and text contect.</p>
            </div>
    </main>



    <!-- FOOTER START -->
    <?php include 'Components/footer.php'; ?>
    <!-- FOOTER END -->
    <script src="../Public/adminPannel.js"></script>
    <script src="../Public/orderOverview.js"></script>

</body>

</html>
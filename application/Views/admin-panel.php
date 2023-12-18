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
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <title>Product details | Adam Sochorec</title>
</head>

<body>
    <?php include 'Components/nav-bar.php'; ?>

    <br><br><br>
    <div class="panel-container">
        <div class="tab">
            <button class="tablinks" onclick="openCity(event, 'orders')">Orders overview</button>
            <button class="tablinks" onclick="openCity(event, 'about')">About section</button>
            <button class="tablinks" onclick="openCity(event, 'products')">Products</button>
            <button class="tablinks" onclick="openCity(event, 'daily')">Daily special offer</button>
            <button class="tablinks" onclick="openCity(event, 'news')">News</button>
        </div>

        <div id="orders" class="tabcontent">
            <h3>Overview of orders</h3>
            <p>Here we will display an overview of all made orders.</p><br><br>
            <table class="table-orders" border="1" style="color:white; width:100%">
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
        </div>

        <div id="about" class="tabcontent">
            <h3>About</h3>
            <p>READ AND UPDATE</p>
            <p>About shop. About owner. Contact info. Opening/closing hoursss.</p>
            <p style="color:white">
                <?php
                echo $shopAbout['shopAboutText'];
                ?>
            </p>
            <input type="text" id="shopInfoAboutText" placeholder="update About info" />
            <button onclick="updateShopAbout()" type="button">Update</button>
            <input type="text" id="shopOwnerTel" placeholder="update owner telephone" />
            <button onclick="updateShopOwnerTel()" type="button">Update</button>
        </div>

        <div id="products" class="tabcontent">
            <h3>Products</h3>
            <p>Full CRUD for photos, print types, sizes and frames.</p>
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
    </div>

    <?php include 'Components/footer.php'; ?>
    <script src="../Public/adminPannel.js"></script>
</body>
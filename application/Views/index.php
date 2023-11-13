<?php
//ADDITIONAL LOGIC OF THE VIEW GOES HERE
include_once(__DIR__ . '/../Controllers/HomeController.php');

use Controllers as C;

$controller = new C\HomeController();

//Just a test to show how the getDatabaseClient works
function renderTable($controller)
{

    foreach ($controller->getDatabaseClient()->getAllFromTable("customer") as $customer) {
        // Access individual values for each customer
        $customerId = $customer['customerid'];
        $firstName = $customer['firstname'];
        $lastName = $customer['lastname'];
        $email = $customer['email'];
        $phone = $customer['phone'];

        // Output or process the values as needed
        echo "<tr><td> $customerId</td><td>$firstName $lastName</td><td>$email</td><td>$phone</td></tr>";
    }
}

function renderTableProducts($controller)
{
    foreach ($controller->getAllProducts() as $product) {
        $productId = $product["productid"];
        $productName = $product["name"];
        $productUrl = $product["url"];

        echo "<tr><td> $productId</td><td>$productName</td><td><img src=$productUrl /></td></tr>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>This is home page</h1>
    <h3>This table outputs the customers</h3>
    <table border=1>
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
    <table border=1>
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
</body>

</html>
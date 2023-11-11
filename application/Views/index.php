<?php
include_once(__DIR__ . './HomeViewBLOC.php');

$views = new Views\HomeViewBLOC();

//Just a test to show how the getDatabaseClient works
foreach ($views->getDatabaseClient()->getAll("customer") as $customer) {
    // Access individual values for each customer
    $customerId = $customer['customerid'];
    $firstName = $customer['firstname'];
    $lastName = $customer['lastname'];
    $email = $customer['email'];
    $phone = $customer['phone'];

    // Output or process the values as needed
    echo "Customer ID: $customerId, <br/> Name: $firstName $lastName, <br/> Email: $email, <br/> Phone: $phone\n";
}
// foreach ($views->getDatabaseClient()->getAll("customer") as $customer) {
//     echo $customer;
// }
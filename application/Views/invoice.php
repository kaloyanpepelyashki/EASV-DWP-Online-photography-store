<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process billing information
    $billingFirstName = $_POST['billing-fname'];
    $billingLastName = $_POST['billing-lname'];
    $billingEmail = $_POST['billing-email'];
    $billingPhoneNumber = $_POST['billing-phone'];
    $billingAddress = $_POST['billing-address'];
    $billingCountry = $_POST['billing-country'];
    $billingCity = $_POST['billing-city'];
    $billingZip = $_POST['zip'];

    // Process shipping information (if different)
    if (isset($_POST['adresstype']) && $_POST['adresstype'] === 'on') {
        $deliveryFirstName = $_POST['delivery-fname'];
        $deliveryLastName = $_POST['delivery-lname'];
        $deliveryEmail = $_POST['delivery-email'];
        $deliveryPhoneNumber = $_POST['delivery-phone'];
        $deliveryAddress = $_POST['delivery-address'];
        $deliveryCountry = $_POST['delivery-country'];
        $deliveryCity = $_POST['delivery-city'];
        $deliveryZip = $_POST['delivery-zip'];
    } else {
        // If billing and shipping address are the same
        $deliveryFirstName = $billingFirstName;
        $deliveryLastName = $billingLastName;
        $deliveryEmail = $billingEmail;
        $deliveryPhoneNumber = $billingPhoneNumber;
        $deliveryAddress = $billingAddress;
        $deliveryCountry = $billingCountry;
        $deliveryCity = $billingCity;
        $deliveryZip = $billingZip;
    }

    // Generate Invoice
    $invoiceContent = "
        Invoice
        Billing Information:
        Name: $billingFirstName $billingLastName
        Email: $billingEmail
        Phone: $billingPhoneNumber
        Address: $billingAddress, $billingCity, $billingCountry, $billingZip

        Shipping Information:
        Name: $deliveryFirstName $deliveryLastName
        Email: $deliveryEmail
        Phone: $deliveryPhoneNumber
        Address: $deliveryAddress, $deliveryCity, $deliveryCountry, $deliveryZip
    ";

    // Save or send the invoice as needed (e.g., save to a file, send an email)

    // For demonstration, output the invoice content
    echo nl2br($invoiceContent);
} else {
    // Redirect or handle the case when the form is not submitted
    header(')/'); // Redirect to home page
    exit();
}
?>

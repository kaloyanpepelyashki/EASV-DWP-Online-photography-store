<?php
    $mymail = "yourname@yourpage.com";
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $name = $_POST['name'];
    $company = $_POST['company'];
    $message = $_POST['message'];
    $regexp = "/^[^0-9][A-z0-9_-]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_-]+)*[.][A-z]{2,4}$/";

    if (!preg_match($regexp,$_POST['email']))
    {
        echo "Email wrong";
    }
    elseif (empty($email) || empty($message) || empty($subject) || empty($name)) 
    {
        echo "Empty field";
    }
    elseif ($_POST['submit'])
    {
        $body = "$message\n\nE-mail: $email";
        mail($mymail,$subject,$body,"From: $email , $name , $company\r\n");
        echo "Thanks for your E-mail";
    }
?>
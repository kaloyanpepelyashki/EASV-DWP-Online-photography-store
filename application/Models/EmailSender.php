<?php
namespace Models;

class EmailSender
{
    private $regexp = "/^[^0-9][A-z0-9_-]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_-]+)*[.][A-z]{2,4}$/";


    public function __construct()
    {
    }



    // if (!preg_match($regexp,$_POST['email']))
    // {
    //     echo "Email wrong";
    // }
    // elseif (empty($email) || empty($message) || empty($subject) || empty($name)) 
    // {
    //     echo "Empty field";
    // }
    // elseif ($_POST['submit'])
    // {
    //     $body = "$message\n\nE-mail: $email";
    //     mail($mymail,$subject,$body,"From: $email , $name , $company\r\n");
    //     echo "Thanks for your E-mail";
    // }

    public function sendEmail(string $email, string $name, string $subject, string $message, )
    {
        try {
            mail($email, $subject, $message, "From: kaloyan@ebits.dk");
            echo "Thank you for your email";
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage();
            throw new \Exception("Internal server error. Error sending email : " . $e->getMessage());
        }
    }
}
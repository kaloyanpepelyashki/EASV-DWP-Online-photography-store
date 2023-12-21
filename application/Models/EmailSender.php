<?php
namespace Models;

//This is the model handling the functionality related to email and email sending
class EmailSender
{
    private $regexp = "/^[^0-9][A-z0-9_-]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_-]+)*[.][A-z]{2,4}$/";


    public function __construct()
    {
    }

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
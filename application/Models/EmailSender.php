<?php
namespace Models;

/**
 * This is the model handling the functionality related to email and email sending.
 */
class EmailSender
{
    // Regular expression for validating email addresses
    private $regexp = "/^[^0-9][A-z0-9_-]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_-]+)*[.][A-z]{2,4}$/";

    /**
     * Constructs a new instance of the EmailSender class.
     */
    public function __construct()
    {
        // Constructor intentionally left empty
    }

    /**
     * Sends an email.
     *
     * @param string $email The recipient's email address.
     * @param string $name The recipient's name.
     * @param string $subject The email subject.
     * @param string $message The email message.
     * @throws \Exception If there is an error sending the email.
     */
    public function sendEmail(string $email, string $name, string $subject, string $message)
    {
        try {
            // Using the mail() function to send the email
            mail("adam.sochorec@icloud.com", $subject, $message, "From: $email");
            echo "Thank you for your email";
        } catch (\Exception $e) {
            // Echoing an error message and throwing an exception with additional details
            echo "Error: " . $e->getMessage();
            throw new \Exception("Internal server error. Error sending email : " . $e->getMessage());
        }
    }
}

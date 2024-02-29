<?php

namespace Controllers;

use Models as M;

// Include the EmailSender class from the Models namespace
include(__DIR__ . '/../Models/EmailSender.php');

/**
 * This controller is responsible for handling asynchronous requests from the client side for sending emails.
 */
class EmailSenderController
{
    // Instance variable to hold an EmailSender model object
    private $emailSenderModel;

    /**
     * Constructs a new instance of the EmailSenderController class.
     */
    public function __construct()
    {
        // Instantiate an EmailSender object and assign it to $this->emailSenderModel
        $this->emailSenderModel = new M\EmailSender();
    }

    /**
     * Handles the email send request.
     */
    public function handleEmailSend()
    {
        // Check if the 'send' parameter is set in the POST request
        if (isset($_POST['send'])) {
            try {
                // Decode the JSON string received in the 'emailObject' parameter
                $emailObject = json_decode($_POST['emailObject']);

                // Check if the decoded JSON is not empty
                if (empty($emailObject)) {
                    // Output an error message and terminate the script if the JSON is empty
                    die("No information was received by the email controller");
                } else {
                    // Call the sendEmail method of the EmailSender model with the provided parameters
                    $this->emailSenderModel->sendEmail(
                        $emailObject['name'],
                        $emailObject['email'],
                        $emailObject['subject'],
                        $emailObject['message']
                    );
                }
            } catch (\Exception $e) {
                // Catch any exceptions and rethrow them with the same message
                throw new \Exception($e->getMessage());
            }
        }
    }
}

// Create an instance of EmailSenderController
$emailController = new EmailSenderController();

// Call the handleEmailSend method to process email send requests
$emailController->handleEmailSend();

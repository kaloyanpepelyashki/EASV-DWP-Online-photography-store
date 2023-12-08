<?php

namespace Controllers;

use Models as M;

include(__DIR__ . '/../Models/EmailSender.php');

class EmailSenderController
{
    private $emailSenderModel;


    public function __construct()
    {
        $this->emailSenderModel = new M\EmailSender();
    }

    public function handleEmailSend()
    {

        if (isset($_POST['send'])) {
            try {
                $emailObject = json_decode($_POST['emailObject']);
                if (empty($emailObject)) {
                    die("No information was received by the email controller");
                } else {
                    $this->emailSenderModel->sendEmail($emailObject['name'], $emailObject['name'], $emailObject['subject'], $emailObject['message']);
                }
            } catch (\Exception $e) {
                throw new \Exception($e->getMessage());
            }
        }
    }


}

$emailController = new EmailSenderController();
$emailController->handleEmailSend();
<?php

namespace security\Models\Login;

require_once(dirname(dirname(dirname(__DIR__))). '/vendor/autoload.php');

use \Swift_MailTransport;
use \Swift_Mailer;
use \Swift_Message;
use \security\Traits\AbsolutePaths;
use \Exception;

class EmailConfirmAccount
{
    use AbsolutePaths;
    public function __construct($email, $uniqueID) 
    {
        $subject = "Your new account.";
        $this->fullPath();
        $website = "{$this->rootPath}public/goodsite/verifyregistration.php?uniq={$uniqueID}";
        $transport = Swift_MailTransport::newInstance();
        $mailer = Swift_Mailer::newInstance($transport);
        $body = "Your new account has been activated at:<a href='$website'>$website</a>
            Please click the link to follow through the activation process.  It will only be valid for 
            24 hours.";
        $message = Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom(["test@example.com"=> "Security Admin"])
            ->setTo($email)
            ->setBody($body)
            ->setReturnPath('test@example.com');
        if (!$mailer->send($message)) {
            throw new Exception("Unable to send email.");
        }
    }   
}
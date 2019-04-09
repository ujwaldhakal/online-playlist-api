<?php

namespace OP\Services\Email;

use App\Services\Environment;
use Illuminate\Support\Facades\Mail;

class Emailer extends
{
    public $from;
    public $subject;
    protected $receiverEmail;
    protected $receiverName;
    protected $template;
    protected $data = [];
    protected $environment;
    protected $bccEmails;
    private $firstName;

    public function __construct()
    {
//        $this->environment = new Environment\();
    }

    public function placeOnQueue()
    {
        return $this->sendEmail()->queue($this);
    }

    public function getSenderEmail()
    {
        return $this->environment->getSenderEmail();
    }

    public function getAppName()
    {
        return $this->environment->getAppName();
    }

    public function build()
    {
        $emailData = $this->view($this->template)->from($this->getSenderEmail(), $this->getAppName())
            ->with($this->data);

        return $emailData;
    }

    public function flush()
    {

    }

    public function sendEmail()
    {
        $mail = Mail::to($this->receiverEmail);

        if ($this->hasBccEmail()) {
            $mail->bcc($this->bccEmails);
        }

        return $mail;
    }

    /**
     * @param mixed $receiverEmail
     */
    public function setReceiverEmail($receiverEmail): void
    {
        $this->receiverEmail = $receiverEmail;
    }

    public function setSubject($subject): void
    {
        $this->subject = $subject;
    }

    public function setBccEmails($emails): void
    {
        $this->bccEmails = $emails;
    }

    /**
     * @param mixed $receiverName
     */
    public function setReceiverName($receiverName): void
    {
        $this->receiverName = $receiverName;
    }

    /**
     * @param mixed $template
     */
    public function setTemplate($template): void
    {
        $this->template = $template;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @param mixed $data
     */
    public function setData($data): void
    {
        $this->data = $data;
    }

    protected function hasBccEmail(): bool
    {
        return !empty($this->bccEmails);
    }
}

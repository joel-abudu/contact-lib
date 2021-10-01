<?php
class Services_Contactually_ContactHistory extends Services_Contactually_Base
{
    public $id = '';
    public $account_id = '';
    public $email = '';
    public $processed = '';
    public $timestamp = '';
    public $total_recipients = '';
    public $recipient_name = '';
    public $message_id = '';
    public $gmail_thread_id = '';
    public $contact_id = '';
    public $subject = '';
    public $parent_contact_id = '';
    public $type = '';
    public $manual_history_type = '';
    public $incoming = '';
    protected $_show_uri  = 'https:
    protected $_delete_uri = 'https:
    public function create(array $params)
    {
        throw new Services_Contactually_Exception_NotImplemented("This method is not implemented");
    }
}

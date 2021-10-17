<?php
class Services_Contactually_Contact extends Services_Contactually_Resources_Base
{
    public $id = '';
    public $first_name = '';
    public $last_name = '';
    public $email = '';
    public $title = '';
    public $company = '';
    public $visible = '';
    public $avatar = '';
    public $first_contacted = '';
    public $last_contacted = '';
    public $hits = '';
    public $user_bucket_id = '';
    protected $_show_uri  = 'https:
    protected $_resource = 'contact';
    protected $_create_uri = 'https:
    protected $_delete_uri = 'https:
    protected $_bucket_uri = 'https:
    protected $_ignore_uri = 'https:
    public function bucket($contact_id, $bucket_id)
    {
        $this->bucket = str_replace('<id>', $contact_id, $this->_bucket_uri);
        $params = array('id' => $contact_id, 'bucket_id' => $bucket_id);
        $this->client->post($this->bucket, $params);
        return (200 == $this->client->status) ? true : false;
    }
    public function ignore($contact_id, $temporary = true, $task_id = 0)
    {
        $this->ignore = str_replace('<id>', $contact_id, $this->_ignore_uri);
        $params = array('id' => $contact_id, 'temp' => !$temporary, 'task_id' => $task_id);
        $this->client->post($this->ignore, $params);
        return (200 == $this->client->status) ? true : false;
    }
}

<?php
class Services_Contactually_Contact extends Services_Contactually_Base
{
    public $id = '';
    public $first_name = '';
    public $last_name = '';
    public $title = '';
    public $company = '';
    public $visible = '';
    public $avatar = '';
    public $first_contacted = '';
    public $last_contacted = '';
    public $hits = '';
    public $user_bucket_id = '';
    public $address = '';
    public $phone = '';
    protected $_show_uri  = 'https:
    protected $_create_uri = 'https:
    public function create(array $params)
    {
        throw new Services_Contactually_Exception_NotImplemented("This method is not implemented");
    }
}

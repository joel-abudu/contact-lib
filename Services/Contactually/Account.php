<?php
class Services_Contactually_Account extends Services_Contactually_Resources_Base
{
    public $id = '';
    public $username = '';
    public $remote_id = '';
    public $type = '';
    public $disabled_at = '';
    protected $_show_uri     = 'accounts/<id>.json';
    protected $_discover_uri = 'https:
    public function discover($email = '')
    {
        $json = $this->_client->get($this->_discover_uri, array('email' => $email));
        throw new Services_Contactually_Exceptions_NotImplemented(
                "This method is not implemented as the uri *looks* like it's wrong.."
                );
    }
    public function create(array $params)
    {
        throw new Services_Contactually_Exception_NotImplemented("This method is not implemented");
    }
    public function delete($id = 0)
    {
        throw new Services_Contactually_Exception_NotImplemented("This method is not implemented");
    }
}

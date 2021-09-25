<?php
class Services_Contactually_Note extends Services_Contactually_Base
{
    public $id = '';
    public $body = '';
    public $contact_id = '';
    public $parent_contact_id = '';
    public $timestamp = '';
    protected $_show_uri = 'https:
    protected $_create_uri = 'https:
    public function create(array $params)
    {
        $note = array();
        foreach($params as $key => $value) {
            $note["note[$key]"] = $value;
        }
        $this->client->post($this->_create_uri, $note);
        return (201 == $this->client->status) ? true : false;
    }
}

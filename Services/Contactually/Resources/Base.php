<?php
abstract class Services_Contactually_Resources_Base
{
    protected $_client = null;
    protected $resources = array(
                    'accounts' => 'Accounts',
                    'buckets' => 'Buckets',
                    'contact_histories' => 'ContactHistories',
                    'contacts' => 'Contacts',
                    'followups' => 'Followups',
                    'notes' => 'Notes',
                    'tasks' => 'Tasks',
                    'users' => 'Users'
                );
    public function __construct(Services_Contactually $client)
    {
        $this->_client = $client;
    }
    public function bind($properties)
    {
        foreach($properties as $property => $value) {
            $this->$property = $value;
        }
        return $this;
    }
    public function show($id = 0)
    {
        $this->show = str_replace('<id>', $id, $this->_show_uri);
        $this->_client->get($this->_client->getUri() . $this->show, array('id' => $id));
        return $this->bind($this->_client->response_obj);
    }
    public function create(array $params)
    {
        $properties = array();
        foreach($params as $key => $value) {
            $properties[$this->_resource . "[$key]"] = $value;
        }
        $this->_client->post($this->_client->getUri() . $this->_create_uri, $properties);
        if (201 == $this->_client->response_code || '' == $this->_client->response_obj->location)
        {
            $payload = $this->_client->response_headers[2];
            $data = json_decode($payload);
            $new_uri = str_replace('<id>', $data->id, $this->_client->getUri() . $this->_show_uri);
            $this->_client->response_obj->location = $new_uri;
        }
        return $this->_client->response_obj;
    }
    public function delete($id = 0)
    {
        $this->delete = str_replace('<id>', $id, $this->_delete_uri);
        $this->_client->delete($this->_client->getUri() . $this->delete, array('id' => $id));
        return (200 == $this->_client->response_code) ? true : false;
    }
}

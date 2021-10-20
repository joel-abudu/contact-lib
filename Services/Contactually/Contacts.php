<?php
class Services_Contactually_Contacts extends Services_Contactually_Resources_List
    implements Services_Contactually_Interfaces_Index
{
    protected $_index_uri = 'https:
    protected $_search_uri = 'https:
    protected $_data = 'contacts';
    protected $_class = 'Services_Contactually_Contact';
    public function search($term, $myArray = array())
    {
        $myArray['term'] = $term;
        $this->client->get($this->_search_uri, $myArray);
        $object = $this->client->response_obj;
        $this->_json = $this->client->response_json;
        $this->_obj  = $object->{$this->_data};
        $this->count = $object->count;
        return $this;
    }
}

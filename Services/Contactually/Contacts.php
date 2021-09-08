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
        $json = $this->client->get($this->_search_uri, $myArray);
        $object = json_decode($json);
        $this->_json = $json;
        $this->_obj  = $object->{$this->_data};
        $this->count = $object->count;
        return $this;
    }
}

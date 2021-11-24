<?php
class Services_Contactually_Contacts extends Services_Contactually_Resources_List
    implements Services_Contactually_Interfaces_Index
{
    protected $_data = 'contacts';
    protected $_class = 'Services_Contactually_Contact';
    protected $_index_uri  = 'contacts.json';
    protected $_search_uri = 'contacts/search.json';
    public function search($term, $page = 1, $limit = 100)
    {
        $this->term = $term;
        $this->page = max($page, 1);
        $this->limit = min($limit, 100);
        $params = array('term' => $this->term, 'page' => $this->page, 'limit' => $this->limit);
        $this->_client->get($this->_client->getUri() . $this->_search_uri, $params);
        $object = $this->_client->response_obj;
        $this->_json = $this->_client->response_json;
        $this->_obj  = $object->{$this->_data};
        $this->count = (int) $object->count;
        $this->_total = (int) $object->total_count;
        $this->_page_count = ceil($this->_total / $this->limit);
        return $this;
    }
}

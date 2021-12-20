<?php
class Services_Contactually_Groupings extends Services_Contactually_Resources_List
    implements Services_Contactually_Interfaces_Index
{
    protected $_data = 'user_buckets';
    protected $_class = 'Services_Contactually_Bucket';
    protected $_index_uri = 'buckets.json';
    protected $_list_uri  = 'buckets/list.json';
    public function __call($name, $params)
    {
        if ('list' == $name) {
            $this->_client->get($this->_client->getUri() . $this->_list_uri);
            $object = $this->_client->response_obj;
            $this->_obj  = $object->bucket_sets;
            $this->count = $object->count;
            $this->_total = $object->count;
            $this->_page_count = 1;
            return $this;
        }
    }
    public function getTotalRecords()
    {
        return $this->_total;
    }
    public function getPageCount()
    {
        return 1;
    }
    public function getNextPage()
    {
        return $this->index(1);
    }
    public function getPreviousPage()
    {
        return $this->index(1);
    }
    public function hasMorePages()
    {
        return false;
    }
}

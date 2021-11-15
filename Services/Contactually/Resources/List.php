<?php
abstract class Services_Contactually_Resources_List
    implements Iterator
{
    protected $_client = null;
    protected $_index = 0;
    protected $_total = 1;
    protected $_page_count = 1;
    public $page = 1;
    public $limit = 100;
    public function __construct(Services_Contactually $client)
    {
        $this->_client = $client;
    }
    public function index($page = 1, $limit = 100)
    {
        $this->page = max($page, 1);
        $this->limit = min($limit, 100);
        $params = array('page' => $this->page, 'limit' => $this->limit);
        $this->_client->get($this->_client->getUri() . $this->_index_uri, $params);
        $object = $this->_client->response_obj;
        $this->_obj  = $object->{$this->_data};
        $this->count = $object->count;
        $this->_total = isset($object->total_count) ?
                $object->total_count : $object->count;
        $this->_page_count = ceil($this->_total / $this->limit);
        return $this;
    }
    public function getTotalRecords()
    {
        return $this->_total;
    }
    public function getPageCount()
    {
        return $this->_page_count;
    }
    public function getNextPage()
    {
        $this->page++;
        $this->page = min($this->page, $this->_page_count);
        return $this->index($this->page, $this->limit);
    }
    public function getPreviousPage()
    {
        $this->page--;
        $this->page = max($this->page, 1);
        return $this->index($this->page, $this->limit);
    }
    public function getNextResults()
    {
        $this->page++;
        $this->page = min($this->page, $this->_page_count);
        return $this->search($this->term, $this->page, $this->limit);
    }
    public function getPreviousResults()
    {
        $this->page--;
        $this->page = max($this->page, 1);
        return $this->search($this->term, $this->page, $this->limit);
    }
    public function hasMorePages()
    {
        return ($this->page < $this->_page_count);
    }
    protected function _getObject($index = 0)
    {
        $params = array();
        if (isset($this->_obj[$index])) {
            $params = $this->_obj[$index];
        }
        $item = new $this->_class($this->_client);
        return $item->bind($params);
    }
    public function rewind()
    {
        $this->_index = 0;
    }
    public function current()
    {
        return $this->_getObject($this->_index);
    }
    public function key()
    {
        return $this->_index;
    }
    public function next()
    {
        $this->_index++;
    }
    public function valid()
    {
        return isset($this->_obj[$this->_index]);
    }
}

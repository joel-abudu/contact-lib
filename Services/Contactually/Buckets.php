<?php
class Services_Contactually_Buckets extends Services_Contactually_Resources_List
    implements Services_Contactually_Interfaces_Index
{
    protected $_index_uri = 'https:
    protected $_data = 'user_buckets';
    protected $_class = 'Services_Contactually_Bucket';
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

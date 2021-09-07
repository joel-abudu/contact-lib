<?php
class Services_Contactually_Buckets extends Services_Contactually_Resources_List
    implements Services_Contactually_Interfaces_Index
{
    protected $_index_uri = 'https:
    protected $_data = 'user_buckets';
    protected $_class = 'Services_Contactually_Bucket';
    public function __call($name, $arguments)
    {
        switch($name) {
            case 'list':
                return $this->index();
                break;
            default:
        }
    }
}

<?php
class Services_Contactually_Tasks extends Services_Contactually_Resources_List
    implements Services_Contactually_Interfaces_Index
{
    protected $_data = 'tasks';
    protected $_class = 'Services_Contactually_Task';
    protected $_index_uri = 'tasks.json';
}

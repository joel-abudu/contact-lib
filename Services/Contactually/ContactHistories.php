<?php
class Services_Contactually_ContactHistories extends Services_Contactually_Resources_List
    implements Services_Contactually_Interfaces_Index
{
    protected $_data = 'email_histories';
    protected $_class = 'Services_Contactually_ContactHistory';
    protected $_index_uri = 'contact_histories.json';
}

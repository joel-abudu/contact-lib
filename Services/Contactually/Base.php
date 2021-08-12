<?php
abstract class Services_Contactually_Base
{
    protected $service = null;
    protected $index = 'https:
    protected $show  = 'https:
    public function __construct(Services_Contactually $service)
    {
        $this->service = $service;
    }
    public function bind($properties)
    {
        foreach($properties as $property => $value) {
            $this->$property = $value;
        }
        return $this;
    }
    public function __call($name, $arguments)
    {
        switch($name) {
            default:
                echo "nope, didn't work";
                throw new Exception("Method not found", 405);
        }
    }
    public function index($params = array())
    {
        $this->index = str_replace('<resource>', $this->name, $this->index);
$property_name = $this->name;
$property_name = ('buckets' == $property_name) ? 'user_buckets' : $property_name;
$property_name = ('contact_histories' == $property_name) ? 'email_histories' : $property_name;
$property_name = ('followups' == $property_name) ? 'today' : $property_name;
        $dataSet = $myObject->{$property_name};
        foreach($dataSet as $key => $values) {
            $newObject = clone $this;
            $dataSet[$key] = $newObject->bind($values);
        }
        return $dataSet;
    }
    public function show($id = 0)
    {
        $this->show = str_replace('<id>', $id, $this->show);
        $myObject = $this->service->get("{$this->show}", array('id' => $id));
        return $this->bind($myObject);
    }
    public function create($params = array())
    {
    }
}

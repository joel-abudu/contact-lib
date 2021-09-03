<?php
abstract class Services_Contactually_Base
{
    protected $service = null;
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

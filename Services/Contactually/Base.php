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
            case 'index':
                $myObject = $this->service->get($this->index, $arguments[0]);
                $dataSet = $myObject->{$this->name};
                foreach($dataSet as $key => $values) {
                    $newObject = clone $this;
                    $dataSet[$key] = $newObject->bind($values);
                }
                return $dataSet;
                break;
            default:
                echo "nope, didn't work";
                throw new Exception("Method not found", 405);
        }
    }
}

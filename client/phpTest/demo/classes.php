<?php

class myFirstClass {
    public $property;

    protected function doWork($param) {
        return $param * 2;
    }
}

class secondClass extends myFirstClass {
    private $privProp;

    function __construct() {
        $this->doWork($this->privProp);
    }
}

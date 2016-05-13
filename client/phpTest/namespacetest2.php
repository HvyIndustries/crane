<?php

class MyFirstClass
{
    function __construct()
    {
        $exampleClass = new ExampleClass();
        //$exampleClass->
    }
}

class ExampleClass
{
    public $publicProperty;
    private $privateProperty;

    function __construct()
    {
        $this->privateProperty = null;
        $this->publicProperty = "test123";
    }

    public function doSomething()
    {
        return "test";
    }
}
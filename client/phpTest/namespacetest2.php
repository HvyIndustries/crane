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
        $this->publicProperty = new MyFirstClass();
    }

    public function doSomething()
    {
    }
}
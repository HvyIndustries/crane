<?php

class myClass
{
    public $testProp = "test";

    function __construct()
    {
        $this->testProp = "test2";
    }

    public function doSomething()
    {
        $this->testProp = "test3";
        //$this->testProp
    }

    public function doSomethingElse()
    {
        $localVar = new ExampleClass();
        
        $localVar->doSomething();

        // Recurse
        $this->doSomething();
    }
}

$test = new myClass();

echo $test->doSomething();
echo doWork();

$otherTest = new ConnectionDB();
$otherTest->

function doWork()
{
}

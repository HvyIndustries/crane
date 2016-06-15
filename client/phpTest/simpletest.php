<?php

class myClass
{
    public $testProp = "test";

    function __construct()
    {
        $this->testProp = "test2";
    }

    public function doSomething(ParamClass $param)
    {
        $this->testProp = "test3";
        $param->

        $localVar = new ParamClass();
        $localVar->secondProp;
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
//$otherTest->

function doWork(ParamClass $dir)
{
    //$dir->
}

class ParamClass
{
    public $prop;
    public $secondProp;
}
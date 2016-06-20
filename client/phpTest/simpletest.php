<?php

class myClass
{
    public $testProp = "test";
    const MYCONST = 5;

    function __construct()
    {
        $this->testProp = "test2";
    }

    public function doSomething(ParamClass $param)
    {
        $this->testProp = "test3";

        $localVar = new ParamClass();
        $localVar->secondProp;
    }

    public function doSomethingElse()
    {
        $localVar = new ExampleClass();

        //$localVar->

        // Recurse
        $this->doSomething();
        //$this->
    }
}

$test = new myClass();

echo $test->doSomething();
echo doWork();

$otherTest = new ConnectionDB();
//$otherTest->

function doWork(ParamClass $dir)
{
    global $myGlobal;
    //$dir->
    $dir->secondProp = "test";
}

class ParamClass
{
    public $prop;
    public $secondProp;
}
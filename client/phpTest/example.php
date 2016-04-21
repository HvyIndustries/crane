<?php

require "file.php";
include "file2.php";
require_once $folder . "/file.php"; 

// regular comment with todo text inline
// TODO -- example
//todo example
// todo example

// Non-class code
const MYCONST = "myConst";
const MYOTHERCONST = "myOtherConst";

$topLevelVariable = "toplevel";
$numVar = 2.4;

Foo\globalFunction($numVar);
$result = myFunc();

function globalFunction()
{
    global $topLevelVariable;
    $local = "test";

    otherFunc($param);
}

function secondFunc($param1, $param2 = "test")
{
}

interface myInterface extends otherInterface
{
    const MYCONST = "const";

    function methodOne();

    function methodTwo($param);

    function methodThree($param1, $param2);
}

trait myTrait
{
    public function myFunc()
    {
        $local = "";
        return $local;
    }
}

class ExampleClass extends ExistingClass implements myInterface // todo inline
{
    public $publicProp = "test";
    private $privateProp;
    protected $protectedProp;
    private $myfinalprop;

    const MYCONST = "myConst";

    use MyTrait;

    public function __construct()
    {
        $constructorVar = "test";
        echo $this->testFunc($this->mymethod());
        $this->DoSomething();

        $this->publicProp = "test2";
    }

    public function DoSomething()
    {
    }

    public function DoSomethingElse()
    {
    }

    public function DoWork()
    {
        $this->publicProp = "test2";
    }

    private function PrivFunc($param1)
    {
        $parentVar = "";
        OtherFunc($param1);
        $this->DoWork($this->publicProp);
        $local = $this->DoWork();

        $this->DoWork();
    }

    private static function OtherFunc($optional = "opt") 
    {
        global $parentVar, $secondVar;

        $this->MYCONST;

        $localVar = 5;
        return $localVar;
    }

    public function testExplictNameTest()
    {
        $myClass->myProp->myFunc($this->myOtherProp);
        $myClass->firstFunc()->myFunc($this->firstProp->secondProp);
    }

    /*
    * @test
    */
    public function DocCommentNameTest()
    {
        
    }
}

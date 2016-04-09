<?php

require "file.php";
include "file2.php";

// regular comment with todo text inline
// TODO -- example
//todo example
// todo example

// Non-class code
const MYCONST = "myConst";

$topLevelVariable = "toplevel";

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

    const MYCONST = "myConst";

    use MyTrait;

    public function __construct()
    {
        $constructorVar = "test";
        echo $this->testFunc($this->mymethod());
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
    }

    private static function OtherFunc($optional = "opt") 
    {
        global $parentVar, $secondVar;
        
        $this->

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

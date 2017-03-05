<?php

namespace PB\Test;

require "test";

use PB\Test\Something;

$test = new Awesome();

function func(){}

doSomething($param);

class Awesome extends Awesome2
{
    const MYCONST = "test";

    public $strProp = "string";
    public $numProp = 14;
    public $arrayProp = array();
    public $arrayProp2 = array(
        "test" => "test"
    );
    public $boolProp = TRuE;
    public $nullProp = NULL;
    private static $stat;

    public $nested1,
           $nested2,
           $nested3;

    const CONST1='',
          CONST2='',
          CONST3='';

    /**
     * @param string $param1
     * @param string $param2
     * @return Awesome2
     */
    public static function test($param1, Awesome $param2, $p2 = 'cat')
    {
        $test = new Awesome();
        return new Awesome2();
    }

    public function test2()
    {
        self::test($param1, $param2, $dog);
        // return $this;
    }

}

class Awesome2
{
    public $pub;
    protected $protect;
    private $priv;

    public function ha(Awesome $a)
    {
        $a->test();
        echo "{$test->test}->test";
    }

    private function he()
    {
        $db = new PDO();
    }

    protected function prosta()
    {
    }
}

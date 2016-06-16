<?php

$test = new Awesome();

class Awesome
{
    /**
     * @param string $param1
     * @param string $param2
     * @return Awesome2
     */
    public static function test($param1, Awesome $param2, $p2 = 'cat')
    {
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
    public function ha(Awesome $a)
    {
        $a->test();
    }

    public function he()
    {
        $db = new PDO();
    }

}
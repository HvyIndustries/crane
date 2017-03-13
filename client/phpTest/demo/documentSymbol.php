<?php

namespace Hvy\CraneDemo\MySubNamespace
{
    class MyClass implements MyInterface
    {
        public $publicProperty;
        private $privateProperty;

        CONST MYCONST = "";

        public function __construct()
        {

        }

        public function publicMethod($param1)
        {

        }

        private function privateMethod()
        {

        }
    }

    trait MyTrait
    {
        public $publicProperty;
        private $privateProperty;

        public function __construct()
        {

        }

        public function publicMethod($param1)
        {

        }

        private function privateMethod()
        {

        }
    }

    interface MyInterface
    {
        public function publicMethod($param1);
    }
}

namespace myOtherNamespace
{
    class MyClass
    {

    }

    trait MyTrait
    {

    }

    interface MyInterface
    {

    }
}

<?php

use thisNamespace\subnamespace;
use namespec as MyNamespace;

namespace myNamespace\otherNamespace
{
    class myNamespaceClass
    {
        
    }

    class otherNamespaceClass extends myNamespaceClass
    {
        use otherTrait;

        function __construct()
        {
            execFunc();
            Foo\execFunc();
            $this->testprop = callFunc();
        } 
    }

    interface myInterface { }
    trait otherTrait
    {
        public $testprop = "";
    }
}

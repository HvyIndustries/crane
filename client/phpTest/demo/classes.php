<?php

$localVar = "";

function myFunc($param1) {
    $param1;
}

myFunc();

class secretClass extends otherClass {
    function __construct()
    {
        $this->classInstance = "test";
        $this->myFunction();
        
        if ($this->myFunction() == $this->classInstance) {
            
        }
    }
}

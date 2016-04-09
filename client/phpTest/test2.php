<?php

class firstClass {
    public $firstPublicProp;
    protected $firstProtectedProp;
    private $firstPrivateProp;

    public function firstPublicFunc() {}
    protected function firstProtectedFunc() {}
    private function firstPrivateFunc() {}

    function __construct() {
        $this->firstProtectedProp;
    }
}

class secondClass extends firstClass {
    public $secondPublicProp;
    protected $secondProtectedProp;
    private $secondPrivateProp;

    public function secondPublicFunc() {}
    protected function secondProtectedFunc() {}
    private function secondPrivateFunc() {}

    function __construct() {
        //$this-
    }
}

class thirdClass extends secondClass {

    function __construct() {
        //$this-
    }
}

class otherClass {
    public $classInstance;

    function __construct() {
    }

    function myFunction($param1) {
        //$param1
    }
}

class finalClass extends ExampleClass {
    function __construct(){
        //$this->
    }
}
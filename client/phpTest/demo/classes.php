<?php

class builderClass {
    public $calcDone;
    protected $needsRebuild;

    public function doCalc() {
    }

    public function processResult($result) {
    }
}

class calculatorClass extends builderClass {
    function __construct()
    {
        $baseResult = 5.25;
        $myProp = "";

        if ($this->calculateBase() == $baseResult) {
            $this->calcDone = true;
        }
    }
}

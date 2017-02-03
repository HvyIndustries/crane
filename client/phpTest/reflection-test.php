<?php

function noParams() {
    return null;
}

function simpleParam($myParam) {
    return $myParam;
}

/**
 * Does something
 *
 * @param string $myParam My parameter
 *
 * @return string
 */
function docComment($myParam) {
    return $myParam;
}

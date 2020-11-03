<?php

function foo()
{
    global $myVar;
    $myVar=20;
}
$myVar=10;
foo();
echo $myVar; //20
phpinfo();
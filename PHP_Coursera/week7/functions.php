<?php
function hello ($lang="es")
{
    if($lang=="es") return "Hola";
    elseif ($lang=="fr") return "Bonjour";
    elseif($lang=="en") return "Hello";
}

echo hello()." Farjallah";

//call by reference
function double(&$d)
{
    $d*=2;
}
$d=4;
double($d);
echo $d;
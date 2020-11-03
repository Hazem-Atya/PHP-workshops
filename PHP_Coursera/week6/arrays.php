<?php
 $langue =array("french","arabic","english");
echo $langue[1];
$nom=array("Hazem"=>"Atya","Ahmed"=>"Farjallah");
echo $nom["Hazem"];
//print_r
echo ("<pre>\n");
print_r($nom);
echo ("</pre>\n");

//var_dump
echo ("<pre>\n");
var_dump($langue);
echo ("</pre>\n");

$test=false;
var_dump($test);


//
$va=array();
$va[]="Hazem";
$va[]=21;
var_dump($va);

//foreach
foreach ($nom as $key=>$valeur)
{
    echo "key :".$key." value :".$valeur."</br>";
}



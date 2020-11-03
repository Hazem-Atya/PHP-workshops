<?php
//printing of the screen

echo "heeey \nI am hazem \n";
$x = 3;
print("heeeeeeey \n");

//The ternary operator

$nb = 80;
$msg = $nb > 100 ? "Bigger in 100 \n" : "Less than 100 \n";
print $msg;

$d = (int)9.9 - 1;
print $d . "\n";//8

$ch = "A" . TRUE . "B\n";
print $ch; //A1B

$ch = "A" . FALSE . "B\n";
print $ch; //AB

if (123 == "123") {
    print "ok for equality 1 \n";
} else {
    print "Not okay for equality 1\n";
}
if (123 == "100" + 23) {
    print "ok for equality 2 \n";
} else {
    print "Not okay for equality 2\n";
}
if (FALSE == '0') {
    print "Ok for equality 3\n";
} else {
    print "not OK for equality 3";
}

if ((5 < 6) == "2" - 1) {
    print "Ok for equality 4\n";
} else {
    print "not OK for equality 4";
}
if ((5 < 6) == true) {
    print "OK for equality 5\n";
}else {
    print "Not ok for equality 5";
}
$x = 1200 + "34";
print $x;
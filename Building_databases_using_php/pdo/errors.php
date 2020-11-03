<?php
require_once "pdo.php";
/*
$stmt = $pdo->prepare("SELECT * FROM users where user_id = :xyz");
$stmt->execute(array(":pizza" => $_GET['user_id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ( $row === false ) {
    echo("<p>user_id not found</p>\n");
} else {
    echo("<p>user_id found</p>\n");
}
*/
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
try {
    $stmt = $pdo->prepare("SELECT * FROM users where user_id = :xyz");
    $stmt->execute(array(":pizza" => $_GET['user_id']));
} catch (Exception $ex ) {
    echo("Internal error, please contact support");
    error_log("error4.php, SQL error=".$ex->getMessage(),0);
    return;
}
$row = $stmt->fetch(PDO::FETCH_ASSOC);
<?php
include_once "pdo.php";
session_start();
if ( ! isset($_SESSION['name']) ) {
    die('Not logged in');
}
if ( isset($_SESSION['success']) ) {
    echo('<p style="color: green;">'.htmlentities($_SESSION['success'])."</p>\n");
    unset($_SESSION['success']);
}

$stm = $pdo->query("SELECT * FROM autos");

$rows = $stm->fetchAll(PDO::FETCH_OBJ);
echo "<ul>";
foreach ($rows as $row) {
    echo "<li>".htmlentities($row->year)." ".htmlentities($row->make)."/".htmlentities($row->mileage);
}
echo "</ul>";
?>
<a href="logout.php">Logout</a>
<a href="add.php">Add New</a>

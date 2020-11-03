<?php
require_once "pdo.php";
session_start();

if (!isset($_SESSION['name']))
{
 ?>
    <head>
        <title>Hazem Atya</title>
        <a href="login.php">Please log in</a>
    </head>
        <?php
}

if (isset($_SESSION['error'])) {
    echo '<p style="color:red">' . $_SESSION['error'] . "</p>\n";
    unset($_SESSION['error']);
}
if (isset($_SESSION['success'])) {
    echo '<p style="color:green">' . $_SESSION['success'] . "</p>\n";
    unset($_SESSION['success']);

}
$stmt = $pdo->query("SELECT make,model,year,mileage,autos_id  FROM autos");
/*if(!$stmt->fetchAll(PDO::FETCH_OBJ))
{
    echo "No rows found";
}else*/ {
?>

<table border="2">
    <tr>
        <th>Make</th>
        <th>Model</th>
        <th>Year</th>
        <th>Mileage</th>
        <th>Action</th>
    </tr>
    <?php

    while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {


        ?>
        <tr>
            <td><?=htmlentities($row->make)?></td>
            <td><?=htmlentities($row->model)?></td>
            <td><?=htmlentities($row->year)?></td>
            <td><?=htmlentities($row->mileage)?></td>
            <td><a href="edit.php?autos_id=<?=$row->autos_id?>">Edit</a>
            <a href="delete.php?autos_id=<?=$row->autos_id?>">Delete</a></td>

        </tr>

        <?php
    }
    ?>
</table>
<?php
}
?>
<head>
    <title>Hazem Atya</title>
</head>
<a href="add.php">Add New Entry</a>
<br>
<a href="logout.php">Logout</a>



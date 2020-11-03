<?php
include_once "pdo.php";
session_start();
if (!isset($_SESSION['name'])) {
    die('Not logged in');
}

if (isset($_POST['mileage']) && (isset($_POST['make'])) && (isset($_POST['year']))) {
    if (!is_numeric($_POST['mileage']) || !(is_numeric($_POST['year']))) {
        $_SESSION['msg'] = "Mileage and year must be numeric";
        header("location:add.php");
        return;
    } elseif (strlen($_POST['make']) < 1) {
        $_SESSION['msg'] = "Make is required";
        header("location:add.php");
        return;
    } else {
        $stmt = $pdo->prepare('INSERT INTO autos
        (make, year, mileage) VALUES ( :mk, :yr, :mi)');
        $stmt->execute(array(
                ':mk' => $_POST['make'],
                ':yr' => $_POST['year'],
                ':mi' => $_POST['mileage'])

        );
        // line added to turn on color syntax highlight

        $_SESSION['success'] = "Record inserted";
        header("Location: view.php");
        return;

    }

}

echo "<h1>Tracking Autos for " . $_SESSION['name']. "</h1>";
if (isset($_SESSION['msg'])) {
    echo "<p style='color:red;'>".$_SESSION['msg']."</p>";
    unset($_SESSION['msg']);
}
?>
<form method="post" action="add.php">
    <label for="make">Make: </label>
    <input type="text" id="make" name="make">
    <br>
    <label for="year">Year: </label>
    <input type="text" id="year" name="year">
    <br>
    <label for="mileage">Mileage: </label>
    <input type="text" id="mileage" name="mileage">
    <br>
    <input type="submit" value="Add">


</form>

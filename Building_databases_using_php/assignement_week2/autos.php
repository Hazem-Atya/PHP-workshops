<?php
include_once "pdo.php";
if (isset($_POST['logout'])) {
    header('Location: login.php');
}
if (!isset($_GET['name'])) {
    die("Name parameter missing");
}
if (isset($_POST['mileage']) && (isset($_POST['make'])) && (isset($_POST['year']))) {
    if (!is_numeric($_POST['mileage']) || !(is_numeric($_POST['year']))) {
        $msg = "<p style='color: red'>Mileage and year must be numeric</p><br>";
    } elseif (strlen($_POST['make']) < 1) {
        $msg = "<p style='color: red'>Make is required</p><br>";
    } else {
        $stmt = $pdo->prepare('INSERT INTO autos
        (make, year, mileage) VALUES ( :mk, :yr, :mi)');
        $stmt->execute(array(
                ':mk' => $_POST['make'],
                ':yr' => $_POST['year'],
                ':mi' => $_POST['mileage'])
        );
    }
}

echo "<h1>Tracking Autos for " . $_GET['name'] . "</h1>";
if (isset($msg))
    echo $msg;
?>
    <form method="post" action="autos.php?name=test">
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
        <input type="submit" name="logout" VALUE="Logout">

    </form>

<?php
$stm = $pdo->query("SELECT * FROM autos");

$rows = $stm->fetchAll(PDO::FETCH_OBJ);
echo "<ul>";
foreach ($rows as $row) {
    echo "<li>$row->year $row->make / $row->mileage";
}
echo "</ul>";
<?php
include_once "ConnexionPDO.php";
session_start();
$pdo = connexionPDO::getInstance();
$rep = $pdo->query("SELECT profile_id,first_name,last_name,headline FROM profile ");
$rows = $rep->fetchAll(PDO::FETCH_OBJ);

?>
<head>
    <title>Hazem Atya</title>
</head>
<body>
<?php
if (isset($_SESSION['success'])) {
    echo "<p style='color: green'>" . $_SESSION['success'] . "</p>";
    unset($_SESSION['success']);
}
if (isset($_SESSION['name'])) {
    ?>
    <a href="logout.php">Logout</a>
    <br>
    <br>
    <?php
} else {
    ?>
    <a href="login.php">Please log in</a>
    <br>
    <br>
    <?php
}
?>
<table border="1">
    <tr>
        <th>Name</th>
        <th>Headline</th>
        <?php if (isset($_SESSION['name'])) { ?>
            <th>Action</th>
        <?php } ?>
    </tr>

    <?php
    foreach ($rows as $row) {
        ?>
        <tr>
            <td>
                <a href="view.php?profile_id=<?= $row->profile_id ?>"><?php echo htmlentities($row->first_name) . htmlentities($row->last_name) ?></a>
            </td>
            <td><?= htmlentities($row->headline) ?></td>
            <?php if (isset($_SESSION['name'])) { ?>
                <td>
                    <a href="edit.php?profile_id=<?= $row->profile_id ?>">Edit</a>
                    <a href="delete.php?profile_id=<?= $row->profile_id ?>">Delete</a>
                </td>
            <?php } ?>
        </tr>
        <?php
    }
    ?>

</table>
<br>
<?php
if (isset($_SESSION['name'])) {
    ?>
    <a href="add.php">Add New Entry</a>
    <?php
}
?>
</body>

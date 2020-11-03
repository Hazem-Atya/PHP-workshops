<?php
require_once "pdo.php";

$stmt = $pdo->query("SELECT * FROM users");

?>
<table border="3">
    <tr>
        <th>User ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Password</th>
    </tr>
    <?php
    while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
        ?>

        <tr>
            <td><?= $row->user_id ?></td>
            <td><?= $row->name ?></td>
            <td><?= $row->password ?></td>
            <td><?= $row->email ?></td>
        </tr>


        <?php
    }
    ?>
</table>
<a href="http://localhost/Building_databases_using_php/pdo_reading_data/insert.php">Insert a new user</a>

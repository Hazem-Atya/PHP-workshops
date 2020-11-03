<?php
sleep(.5);
echo('You sent: '.$_POST['val']);
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=misc',
    'fred', 'zap');
// See the "errors" folder for details...
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
echo('<table border="1">'."\n");
$sql="SELECT name, email, password, user_id FROM users WHERE  name like '".$_POST['val']."%'";
$stmt = $pdo->query($sql);
while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
    echo "<tr><td>";
    echo(htmlentities($row['name']));
    echo("</td><td>");
    echo(htmlentities($row['email']));
    echo("</td><td>");
    echo(htmlentities($row['password']));
    echo("</td><td>");
    echo('<a href="edit.php?user_id='.$row['user_id'].'">Edit</a> / ');
    echo('<a href="delete.php?user_id='.$row['user_id'].'">Delete</a>');
    echo("</td></tr>\n");
}

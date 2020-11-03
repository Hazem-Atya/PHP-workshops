<?php
session_start();
include_once "ConnexionPDO.php";
$pdo=ConnexionPDO::getInstance();
if (!isset($_SESSION['name'])||!isset($_SESSION['user_id'])) {
    die('Acess denied');
}
if(isset($_POST['cancel']))
{
    header("location:index.php");
    return;
}
if(isset($_POST['delete']))
{
    $stmt=$pdo->prepare("DELETE FROM profile WHERE profile_id=:id ");
    $stmt->execute(array(
        'id'=>$_POST['profile_id']
    ));
    $_SESSION['success'] = 'Record deleted';
    header( 'Location: index.php' ) ;
    return;
}
if (!isset($_GET['profile_id']))
{
    $_SESSION['error']='Missing profile_id';
    header("location:index.php");
    return;
}
$stmt=$pdo->prepare("SELECT * FROM profile WHERE profile_id=:id ");
$stmt->execute(array(
    'id'=>$_GET['profile_id']
));
$row=$stmt->fetch(PDO::FETCH_ASSOC);

?>
<head>
    <title>Hazem Atya</title>
</head>
<body>
<h1>Deleting profile</h1>
<form action="delete.php" method="post">
    <p>First_Name<?=$row['first_name']?></p>
    <p>last_Name<?=$row['last_name']?></p>
    <input type="hidden" name="profile_id" value="<?=$row['profile_id']?>">
    <input type="submit" name="delete" value="Delete">
    <input type="submit" name="cancel"  value="Cancel">
</form>


</body>

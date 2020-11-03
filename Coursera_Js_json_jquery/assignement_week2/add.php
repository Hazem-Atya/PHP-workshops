<?php
session_start();
include_once "ConnexionPDO.php";
$pdo = ConnexionPDO::getInstance();

if (!isset($_SESSION['name'])||!isset($_SESSION['user_id'])) {
    die('Acess denied');
}
if (isset($_POST['first_name']) && isset($_POST['last_name'])
    && isset($_POST['email']) && isset($_POST['headline']) && isset($_POST['summary'])) {
if(strlen($_POST['first_name'])<1||strlen($_POST['last_name'])<1||
    strlen($_POST['email'])<1|| strlen($_POST['headline'])<1|| strlen($_POST['summary'])<1)
{
    $_SESSION['error']="All fields are required";
    header("Location: add.php?profile_id=" . $_POST["profile_id"]);
    return;
}
if(strpos($_POST['email'],'@')===false)
    {
        $_SESSION['error']="Email address must contain @";
        header("Location: add.php?profile_id=" . $_POST["profile_id"]);
        return;
    }
    $stmt = $pdo->prepare("INSERT INTO profile (user_id, first_name, last_name, email, headline, summary)
      VALUES ( :uid, :fn, :ln, :em, :he, :su)");

    $stmt->execute(array(
            ':uid' => $_SESSION['user_id'],
            ':fn' => $_POST['first_name'],
            ':ln' => $_POST['last_name'],
            ':em' => $_POST['email'],
            ':he' => $_POST['headline'],
            ':su' => $_POST['summary'])
    );
    $_SESSION['success']="profile added";
    header('location:index.php');
    return;
}
?>

<head>
    <title>Hazem Atya</title>
</head>
<body>
<h1>Adding Profile for <?=$_SESSION['name']?></h1>
<?php
if(isset($_SESSION['error']))
{
    echo "<p style='color: red'>".$_SESSION['error']."</p>";
    unset($_SESSION['error']);
}
?>
<form action="add.php" method="post">
    <p>First Name:
        <input type="text" name="first_name" size="60"/></p>
    <p>Last Name:
        <input type="text" name="last_name" size="60"/></p>
    <p>Email:
        <input type="text" name="email" size="30"/></p>
    <p>Headline:<br/>
        <input type="text" name="headline" size="80"/></p>
    <p>Summary:<br/>
        <textarea name="summary" rows="8" cols="80"></textarea>
    <p>
        <input type="submit" value="Add">
        <input type="submit" name="cancel" value="Cancel">
    </p>
</form>
</body>

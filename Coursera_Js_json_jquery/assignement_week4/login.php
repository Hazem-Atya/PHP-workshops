<?php
include_once "ConnexionPDO.php";
session_start();
$pdo=ConnexionPDO::getInstance();
$salt = 'XyZzy12*_';
if (isset($_POST['email']) && isset($_POST['pass'])) {
    $check = hash('md5', $salt . $_POST['pass']);

    $stmt = $pdo->prepare('SELECT user_id, name FROM users

WHERE email = :em AND password = :pw');

    $stmt->execute(array(':em' => $_POST['email'], ':pw' => $check));

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row !== false) {

        $_SESSION['name'] = $row['name'];

        $_SESSION['user_id'] = $row['user_id'];
        header('location:index.php');
        return;
    }else{
        $_SESSION['error']="Incorrect password";
        header('location:login.php');
        return;
    }
}

?>
<html>
<head>
    <title>Hazem Atya</title>
</head>
<body>
<h1>Please Log In</h1>
<?php
if(isset($_SESSION['error']))
{
    echo "<p style='color: red'>".$_SESSION['error']."</p>";
    unset($_SESSION['error']);
}
?>
<form action="login.php" method="post">
    <label>Email <input name="email" id="email" type="text"></label>
    <br>
    <label>Password <input name="pass" type="password"  id="id_1723" ></label>
    <br>
    <input type="submit" onclick="return doValidate();"  value="Log In">
    <input type="submit" value="Cancel">

</form>
<script>
    function doValidate() {
        console.log('Validating...');
        try {
            addr = document.getElementById('email').value;
            pw = document.getElementById('id_1723').value;
            console.log("Validating addr="+addr+" pw="+pw);
            if (addr == null || addr == "" || pw == null || pw == "") {
                alert("Both fields must be filled out");
                return false;
            }
            if ( addr.indexOf('@') == -1 ) {
                alert("Invalid email address");
                return false;
            }
            return true;
        } catch(e) {
            return false;
        }
        return false;
    }
</script>
</body>
</html>

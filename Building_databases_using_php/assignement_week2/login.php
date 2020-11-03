
<?php
require_once "pdo.php";

// p' OR '1' = '1

if (isset($_POST['who']) && isset($_POST['pass'])) {
    $check=hash('md5',$_POST['pass']);
    if (strlen($_POST['who']) < 1 || strlen($_POST['pass']) < 1) {
        echo "<p style='color: red'>Email and password are required</p><br>";
    } elseif (strpos($_POST['who'], '@', 0) == false) {
        echo "<p style='color: red'>Email must have an at-sign (@)</p><br>";
    } elseif ($_POST['pass'] != "php123") {
        echo "<p style='color: red'>Incorrect password</p><br>";
        error_log("Login fail ".$_POST['who']." $check");
    }
    else{
        error_log("Login success ".$_POST['email']);

    header("Location: autos.php?name=" . urlencode($_POST['who'])); }
}
?>
<head>
    <title>Hazem Atya - Autos Database</title>
</head>
<p>Please Login</p>
<form method="post">
    <p>Email:
        <input type="text" size="40" name="who"></p>
    <p>Password:
        <input type="text" size="40" name="pass"></p>
    <p><input type="submit" value="Log In"/>
        <a href="<?php echo($_SERVER['PHP_SELF']); ?>">Refresh</a></p>
</form>
<p>

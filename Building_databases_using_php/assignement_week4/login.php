<?php
require_once "pdo.php";
session_start();
// p' OR '1' = '1

if (isset($_POST['email']) && isset($_POST['pass'])) {
    $check = hash('md5', $_POST['pass']);
    if (strlen($_POST['email']) < 1 || strlen($_POST['pass']) < 1) {
        $_SESSION['error'] = "Email and password are required";
        header("Location: login.php");
        return;
    } elseif (strpos($_POST['email'], '@', 0) == false) {
        $_SESSION['error'] = "Email must have an at-sign (@)";
        header("Location: login.php");
        return;
    } elseif ($_POST['pass'] != "php123") {
        $_SESSION['error'] = "Incorrect password";
        header("Location: login.php");
        error_log("Login fail " . $_POST['who'] . " $check");
        return;
    } else {
        error_log("Login success " . $_POST['email']);
        $_SESSION['name'] = $_POST['email'];
        header("Location: view.php");
        return;

    }
}
?>
<head>
    <title>Hazem Atya</title>
</head>
<?php
if (isset($_SESSION['error'])) {
    echo('<p style="color: red;">' . htmlentities($_SESSION['error']) . "</p>\n");
    unset($_SESSION['error']);
}
?>
<p>Please Login</p>
<form method="post">
    <p>Email:
        <input type="text" size="40" name="email"></p>
    <p>Password:
        <input type="text" size="40" name="pass"></p>
    <p><input type="submit" value="Log In"/>
        <a href="<?php echo($_SERVER['PHP_SELF']); ?>">Refresh</a></p>
</form>
<p>

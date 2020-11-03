<?php
session_start();

// Redirect the browser to view.php

?>
<!DOCTYPE html>
<html>
<head>
    <title>Hazem Atya - Autos Database</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

</head>
<body>
<div class="container">
    <h1>Welcome to Autos Database</h1>
    <p>
        <a href="login.php">Please Log In</a>
    </p>
    <p>
        Attempt to go to
        <a href="view.php">view.php</a> without logging in - it should fail with an error message.
    <p>
        <a href="https://www.wa4e.com/assn/autosdb/" target="_blank">Specification for this Application</a>
    </p>
    <p>
        <b>Note:</b> Your implementation should retain data across multiple
        logout/login sessions.  This sample implementation clears all its
        data on logout - which you should not do in your implementation.
    </p>
</div>
</body>

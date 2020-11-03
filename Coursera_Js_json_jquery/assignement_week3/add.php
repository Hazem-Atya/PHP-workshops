<?php
session_start();
include_once "ConnexionPDO.php";
$pdo = ConnexionPDO::getInstance();

if (!isset($_SESSION['name']) || !isset($_SESSION['user_id'])) {
    die('Acess denied');
}
if (isset($_POST['cancel'])) {
    header('location:index.php');
    return;
}
if (isset($_POST['first_name']) && isset($_POST['last_name'])
    && isset($_POST['email']) && isset($_POST['headline']) && isset($_POST['summary'])) {
    if (strlen($_POST['first_name']) < 1 || strlen($_POST['last_name']) < 1 ||
        strlen($_POST['email']) < 1 || strlen($_POST['headline']) < 1 || strlen($_POST['summary']) < 1) {
        $_SESSION['error'] = "All fields are required";
        header("Location: add.php?profile_id=" . $_POST["profile_id"]);
        return;
    }
    $i = 1;
    while ($i <= 9) {
        if (isset($_POST["year$i"]) && isset($_POST["desc$i"])) {
            if (strlen($_POST["year$i"]) < 1 || strlen($_POST["desc$i"]) < 1) {
                $_SESSION['error'] = "All fields are required";
                header("Location: add.php?profile_id=" . $_POST["profile_id"]);
                return;
            }

        }else{
            break;
        }

        $i++;
    }
    if (strpos($_POST['email'], '@') === false) {
        $_SESSION['error'] = "Email address must contain @";
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
    $i=1;
    $pfo=$pdo->lastInsertId();
    while(isset($_POST["year$i"]) && isset($_POST["desc$i"]))
    {
        $stmt = $pdo->prepare("INSERT INTO position (profile_id, rank, year,description )
      VALUES ( :pid, :rank, :y, :desc)");

        $stmt->execute(array(
                ':pid' =>$pfo,
                ':rank' => $i,
                ':y' => $_POST["year$i"],
                ':desc' => $_POST["desc$i"],

        ));
        $i++;
    }
    $_SESSION['success'] = "profile added";
    header('location:index.php');
    return;
}
?>

<head>
    <title>Hazem Atya</title>
</head>
<body>
<h1>Adding Profile for <?= $_SESSION['name'] ?></h1>
<?php
if (isset($_SESSION['error'])) {
    echo "<p style='color: red'>" . $_SESSION['error'] . "</p>";
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
        Position: <input type="submit" id="addPos" value="+">
    <div id="position_fields"></div>
    </p>
    <p>
        <input type="submit" value="Add">
        <input type="submit" name="cancel" value="Cancel">
    </p>
</form>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
        crossorigin="anonymous"></script>
<script>
    countPos = 0;

    // http://stackoverflow.com/questions/17650776/add-remove-html-inside-div-using-javascript
    $(document).ready(function () {
        window.console && console.log('Document ready called');
        $('#addPos').click(function (event) {
            // http://api.jquery.com/event.preventdefault/
            event.preventDefault();
            if (countPos >= 9) {
                alert("Maximum of nine position entries exceeded");
                return;
            }
            countPos++;
            window.console && console.log("Adding position " + countPos);
            $('#position_fields').append(
                '<div id="position' + countPos + '"> \
            <p>Year: <input type="text" name="year' + countPos + '" value="" /> \
            <input type="button" value="-" \
                onclick="$(\'#position' + countPos + '\').remove();return false;"></p> \
            <textarea name="desc' + countPos + '" rows="8" cols="80"></textarea>\
            </div>');
        });
    });
</script>
</body>

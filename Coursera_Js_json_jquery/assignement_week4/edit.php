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
    && isset($_POST['email']) && isset($_POST['headline'])) {

    if (strlen($_POST['first_name']) < 1 || strlen($_POST['last_name']) < 1 ||
        strlen($_POST['email']) < 1 || strlen($_POST['headline']) < 1 || strlen($_POST['summary']) < 1) {
        $_SESSION['error'] = "All fields are required";
        header("Location: edit.php?profile_id=" . $_POST["profile_id"]);
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

        } else {
            break;
        }

        $i++;
    }
    $i = 1;
    while ($i <= 9) {
        if (isset($_POST["edu_school$i"]) && isset($_POST["edu_year$i"])) {
            if (strlen($_POST["edu_school$i"]) < 1 || strlen($_POST["edu_year$i"]) < 1) {
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
        header("Location: edit.php?profile_id=" . $_POST["profile_id"]);
        return;
    }
    $sql = "UPDATE profile
SET  first_name = :fn,last_name= :ln,email= :em, headline= :he, summary= :su
WHERE profile_id= :pid;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
            ':fn' => $_POST['first_name'],
            ':ln' => $_POST['last_name'],
            ':em' => $_POST['email'],
            ':he' => $_POST['headline'],
            ':su' => $_POST['summary'],
            'pid' => $_POST['profile_id'])

    );
    $pfo = $pdo->lastInsertId();
    $i = 1;
    while (isset($_POST["year$i"]) && isset($_POST["desc$i"])) {
        $stmt = $pdo->prepare("INSERT INTO position (profile_id, rank, year,description )
      VALUES ( :pid, :rank, :y, :desc)");

        $stmt->execute(array(
            ':pid' => $_POST['profile_id'],
            ':rank' => $i,
            ':y' => $_POST["year$i"],
            ':desc' => $_POST["desc$i"],

        ));
        $i++;
    }
    $i=1;
    while(isset($_POST["edu_year$i"]) && isset($_POST["edu_school$i"]))
    {
        $find=$pdo->prepare("SELECT institution_id FROM institution where name = :n");
        $find->execute(array(":n"=>$_POST["edu_school$i"]));
        $res=$find->fetch(PDO::FETCH_ASSOC);
        $stmt = $pdo->prepare("INSERT INTO education (profile_id, rank, year,institution_id )
      VALUES ( :pid, :rank, :y, :insid)");

        $stmt->execute(array(
            ':pid' =>$_POST['profile_id'],
            ':rank' => $i,
            ':y' => $_POST["edu_year$i"],
            ':insid' => $res['institution_id'],

        ));
        $i++;
    }
    $_SESSION['success'] = "profile updated";
    header('location:index.php');
    return;
}
if (!isset($_GET['profile_id'])) {
    $_SESSION['error'] = 'Missing profile_id';
    header("location:index.php");
    return;
}
$stmt = $pdo->prepare("SELECT * FROM profile WHERE profile_id=:id ");
$stmt->execute(array(
    'id' => $_GET['profile_id']
));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$stmt1 = $pdo->prepare("SELECT * FROM position WHERE profile_id=:id ");
$stmt1->execute(array(
    'id' => $_GET['profile_id']
));
$rows1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
$stmt2 = $pdo->prepare("SELECT * FROM education WHERE profile_id=:id");
$stmt2->execute(array(
    'id' => $_GET['profile_id']
));
$rows2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

?>
<head>
    <title>Hazem Atya</title>

    <link rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7"
          crossorigin="anonymous">

    <link rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css"
          integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r"
          crossorigin="anonymous">

    <link rel="stylesheet"
          href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"
          integrity="sha384-xewr6kSkq3dBbEtB6Z/3oFZmknWn7nHqhLVLrYgzEFRbU/DHSxW7K3B44yWUN60D"
          crossorigin="anonymous">

    <script
            src="https://code.jquery.com/jquery-3.2.1.js"
            integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
            crossorigin="anonymous"></script>

    <script
            src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
            integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30="
            crossorigin="anonymous"></script>
</head>
<body class="container">
<h1>Editing Profile for <?= $_SESSION['name'] ?></h1>
<?php
if (isset($_SESSION['error'])) {
    echo "<p style='color: red'>" . $_SESSION['error'] . "</p>";
    unset($_SESSION['error']);
}
?>

<form class=action="edit.php" method="post">
    <p>First Name:
        <input type="text" value="<?= htmlentities($row['first_name']) ?>" name="first_name" size="60"/></p>
    <p>Last Name:
        <input type="text" value="<?= htmlentities($row['last_name']) ?>" name="last_name" size="60"/></p>
    <p>Email:
        <input type="text" value="<?= htmlentities($row['email']) ?>" name="email" size="30"/></p>
    <p>Headline:<br/>
        <input type="text" value="<?= htmlentities($row['headline']) ?>" name="headline" size="80"/></p>
    <p>Summary:<br/>
        <textarea name="summary" rows="8" cols="80"><?= htmlentities($row['summary']) ?></textarea></p>

    <p>
        Position: <input type="submit" id="addPos" value="+">
        <div id="position_fields">
            <?php
            foreach ($rows1 as $row)

            {
            ?>
            <div id="position<?= $row['rank'] ?>">
    <p>Year: <input type="text" name="year<?= $row['rank'] ?>" value="<?= htmlentities($row['year']) ?>"/>
        <input type="button" value="-" onclick="$('#position<?= $row['rank'] ?> ').remove();return false;">
    </p>
    <textarea name="desc<?= $row['rank'] ?>" rows="8" cols="80">
<?= htmlentities($row['description']) ?>
</textarea>
    </div>
    <?php
    }
    ?>

    </div>
    </p>

    <p>Education: <input type="submit" id="addEdu" value="+">
        <div id="edu_fields">
            <?php
            foreach ($rows2 as $row)
            {
                $stm=$pdo->query("SELECT * FROM institution where institution_id='".$row['institution_id']."'");
                $rep=$stm->fetch(PDO::FETCH_ASSOC);
            ?>
            <div id="edu<?= $row['rank'] ?>">
    <p>Year: <input type="text" name="edu_year<?= $row['rank'] ?>" value="<?=$row['year'] ?>"/>
        <input type="button" value="-" onclick="$("#edu<?= $row['rank'] ?>").remove();return false;"></p>
    <p>School: <input type="text" size="80" name="edu_school<?= $row['rank'] ?>" class="school"
                      value="<?=$rep['name']?>"/>
        </div>
        <?php
        }
        ?>
        </div></p>
    <p>
        <input type="submit" value="Save">
        <input type="submit" name="cancel" value="Cancel">
    </p>
    <input type="hidden" name="profile_id" value="<?= htmlentities($row['profile_id']) ?>">
</form>

<script>
    countPos = 0;
    countEdu=0;
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
        $('#addEdu').click(function (event) {
            event.preventDefault();
            if (countEdu >= 9) {
                alert("Maximum of nine education entries exceeded");
                return;
            }
            countEdu++;
            window.console && console.log("Adding education " + countEdu);

            $('#edu_fields').append(
                '<div id="edu' + countEdu + '"> \
            <p>Year: <input type="text" name="edu_year' + countEdu + '" value="" /> \
            <input type="button" value="-" onclick="$(\'#edu' + countEdu + '\').remove();return false;"><br>\
            <p>School: <input type="text" size="80" name="edu_school' + countEdu + '" class="school" value="" />\
            </p></div>'
            );

            $('.school').autocomplete({
                source: "school.php"
            });

        });
    });
</script>
</body>


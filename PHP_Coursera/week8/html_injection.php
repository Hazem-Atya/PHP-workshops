<?php
$oldValue = isset($_POST["age"]) ? $_POST["age"] : "";
$oldNameValue = isset($_POST["nom"]) ? $_POST["nom"] : "";
?>

<!--   problem    -->
<!--<form action="html_injection.php" method="post">
    <label for="age">Type your age : </label>
    <input type="number" name="age" value="<?/*= $oldValue */?>" id="age" min="13" max="150">
    <label for="nom">Name : </label>
    <input type="text"  id="nom" name="nom" value="<?/*=$oldNameValue */?>">
    <input type="submit" value="Send">
</form>-->

<!--   Solution    -->
<?php
$oldValue1 = isset($_POST["age1"]) ? $_POST["age1"] : "";
$oldNameValue1 = isset($_POST["nom1"]) ? $_POST["nom1"] : "";
?>
<form action="html_injection.php" method="post">
    <label for="age1">Type your age : </label>
    <input type="number" name="age1" value="<?= htmlentities($oldValue1) ?>" id="age" min="13" max="150">
    <label for="nom1">Name : </label>
    <input type="text"  id="nom1" name="nom1" value="<?=htmlentities($oldNameValue1) ?>">
    <input type="submit" value="Send">
</form>



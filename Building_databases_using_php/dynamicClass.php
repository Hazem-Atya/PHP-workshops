<?php
$player = new stdClass(); //stdClass is an empty class
$player->prenom = "Hazem"; // add an attribute dynamically
$player->nom = "Atya";
$player->score = 0;
?>
<pre>
<?php print_r($player);
?>
</pre>
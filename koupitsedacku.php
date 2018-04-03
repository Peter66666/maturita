<?php require_once 'autoloader.php'; ?>
<?php

$ID_sedacky = filter_input(INPUT_GET, "id_sedacky");
$ID_promitani = filter_input(INPUT_GET, "id_promitani");
$result = Model::buySeat($ID_promitani, $ID_sedacky);
header("location: detailsalu.php");

<?php require_once 'autoloader.php'; ?>
<?php

$ID_sedacky = filter_input(INPUT_GET, "id_sedacky");
$ID_promitani = filter_input(INPUT_GET, "id_promitani");
$ID_status = filter_input(INPUT_GET, "id_status");


  $result = Model::bookOrBuySeat($ID_promitani, $ID_sedacky, $ID_status);

header("location: detailsalu.php?id_promitani=$ID_promitani");

<?php
require_once 'autoloader.php';
include_once 'header.php';
$ID_sedacky = filter_input(INPUT_GET, "id_sedacky");
$ID_promitani = filter_input(INPUT_GET, "id_promitani");
$result = Model::getOrder($ID_promitani, $ID_sedacky);
?>
<h3>Objednávka</h3>
<table border="1">
    <?php foreach ($result as $row) { ?>
    <tr><td>Název filmu</td><td><?php echo $row["nazev_filmu"]
    ?></td></tr>
<tr><td>Sál</td><td><?php echo $row["nazev_salu"] ?></td></tr>
<tr><td>Řada</td><td><?php echo $row["rada"] ?></td></tr>
<tr><td>Sedačka</td><td><?php echo $row["cislo_v_rade"] ?></td></tr>
<tr><td>Čas promítání</td><td><?php echo $row["cas_promitani"] ?></td></tr>
<tr><td>Cena</td><td><?php echo $row["cena"] ?></td></tr>
</table>
<a href="rezervovatsedacku.php?id_promitani=<?php echo $row["id_promitani"] ?>&id_sedacky=<?php echo $row["id_sedacky"] ?>&id_status=3">Rezervovat</a>
<a href="koupitsedacku.php?id_promitani=<?php echo $row["id_promitani"] ?>&id_sedacky=<?php echo $row["id_sedacky"] ?>&id_status=2">Koupit</a>
    <?php }
include_once 'footer.php';

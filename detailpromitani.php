<?php
require_once 'autoloader.php';
include_once 'header.php';
$ID_promitani = filter_input(INPUT_GET, "id_promitani");
$promitani = Model::getPromitani($ID_promitani);
foreach ($promitani as $row) {
    ?>
    <table border="1">
        <tr><td>Název filmu</td><td><?php echo $row["nazev_filmu"] ?></td></tr>
        <tr><td>Název sálu</td><td><?php echo $row["nazev_salu"] ?></td></tr>
        <tr><td>Jazyk</td><td><?php echo $row["jazyk"] ?></td></tr>
        <tr><td>Čas promítaní</td><td><?php echo $row["cas_promitani"] ?></td></tr>
        <tr><td>Cena</td><td><?php echo $row["cena"] ?></td></tr>
    <?php } ?>
</table>
<a href="detailsalu.php">Rezervovat sedačky</a>
<?php
include_once 'footer.php';

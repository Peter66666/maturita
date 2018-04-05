<?php
require_once 'adminheader.php';

?><hr>
<table border="1">
<tr><td>Promítání</td><td>Název</td><td>Sál</td><td>Jazyk</td><td>Čas promítání</td><td>Cena</td><td>Konec předprodeje</td></tr>
<?php
$result = Model::extractProgram();
foreach ($result as $row) {

    ?>

    <tr>
        <td><?php echo $row["id_promitani"] ?></td><td><?php echo $row["nazev_filmu"] ?></td><td><?php echo $row["nazev_salu"] ?></td><td><?php echo $row["jazyk"] ?></td>
        <td><?php echo $row["cas_promitani"]?></td><td><?php echo $row["cena"]?></td><td><?php echo $row["konec_predprodeje"]?></td>
        <td><a href="editschedule/<?php echo $row["id_promitani"]?>">Upravit</a></td>
<?php
}
?>
</tr>
</table>
<br/>
<br/>
<a href="editschedule.php">Přidat</a><br/>
<a href="index.php">Zpět</a>
<hr>
<?php
require_once 'adminfooter.php';

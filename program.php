<?php
require_once 'autoloader.php';
include_once 'header.php';
?>

<table border="1"> <?php
    $promitani = Model::getPromitani();
    foreach ($promitani as $row) {
        $now = New DateTime;
        $datumPredprodeje = New DateTime($row["konec_predprodeje"]);
        ?>
        <tr>
            <td> <?php echo $row["cas_promitani"] ?></td>
            <td><?php echo $row["nazev_filmu"] ?></td>
            <td><?php echo $row["cena"] ?></td>
            <td><?php echo $row["nazev_salu"] ?></td>
            <td><?php echo $row["nazev"] ?></td>
          
            <td>
                <?php if ($now <= $datumPredprodeje && isset($_SESSION["email"])) { ?>
                    <a href="detailpromitani.php?&id_promitani=<?php echo $row["id_promitani"] ?>">Objednat</a>
                    <?php
                } elseif (!isset($_SESSION["email"])) {
                    echo "Nejste přihlášeni";
                } else {

                    echo "Předprodej skončil";
                }
                ?> </td></tr> <?php
}
            ?>
</table>
<?php
include_once 'footer.php';

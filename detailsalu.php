<?php require_once 'autoloader.php'; ?>
<?php
$ID_sedacky = filter_input(INPUT_GET, "id_sedacky");
$ID_promitani = filter_input(INPUT_GET, "id_promitani");
$result2 = Model::cancelSeat($ID_promitani, $ID_sedacky);
$result = Model::extractSeats();

$rada = 0;
?>
<table border="1">
    <?php
    foreach ($result as $row) {
        switch ($row["id_status"]) {
            case 1;
                $color = "green";
                break;
            case 2;
                $color = "red";
                break;
            case 3;
                $color = "orange";
                break;
        }
        if ($rada != $row["rada"]) {
            ?> <tr> <?php
            ?><td><?php echo "Řada" . $row["rada"] . ": "; ?> </td><?php
            }


            $rada = $row["rada"];
            ?> <td style="background-color: <?php echo $color ?>;">

                <?php if (isset($_SESSION["email"]) && $row["id_status"] == 1) { ?>
                    <a href="rezervovatsedacku.php?id_promitani=<?php echo $row["id_promitani"] ?>&id_sedacky=<?php echo $row["id_sedacky"] ?>">
                        <?php
                        echo $row["cislo_v_rade"] . "/" . $row["rada"] . " " . $row["nazev"];
                        ?></a></td><?php
            } else {
                (isset($_SESSION["email"]) && $row["id_status"] == 3);
                ?>
            <a href="koupitsedacku?id_promitani=<?php echo $row["id_promitani"] ?>&id_sedacky=<?php echo $row["id_sedacky"] ?>">  <?php
                echo $row["cislo_v_rade"] . "/" . $row["rada"] . " " . "Zrušit";
            }
            ?>
        </a>
        <?php
        if ($row["id_status"] == 1) {
            echo "</a>";
        }
        if ($rada != $row["rada"]) {
            ?> </tr> <?php
    }
}
?>
</table>

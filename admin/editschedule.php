<?php
require_once 'adminheaderV2.php';

$id_promitani = filter_input(INPUT_GET, "id_promitani");
$row = Model::extractProgram($id_promitani);
$result = Model::extractHalls();
?><hr>

<form method="post">
Promítání: <?php echo $row["id_promitani"]?><br/>
Název filmu: <?php echo $row["nazev_filmu"]?><br/>
Jazyk:<input type="text" name="changelang" value="<?php echo $row["jazyk"]?>"/><br/>
Čas promítání:<input type="date" name="changescreeningtime" value="<?php echo $row["cas_promitani"]?>"/><br/>
Cena:<input type="text" name="changeprice" value="<?php echo $row["cena"]?>"/><br/>
konec_predprodeje:<input type="date" name="changeadvancebooking" value="<?php echo $row["konec_predprodeje"]?>"/><br/>
Sál:<select name="changehall">
    <?php foreach ($result as $row) { ?>
        <option value="<?php echo $row["nazev_salu"] ?>"><?php echo $row["nazev_salu"];
} ?></option>
</select><br/>
<input type="submit" value="Odeslat"/>
</form>
<a href="../listSchedule.php">Zpět</a>
<hr>
<?php
$submit = filter_input(INPUT_POST, "submit");
$language = filter_input(INPUT_POST, "changelang");
$screeningtime = filter_input(INPUT_POST, "changescreeningtime");
$price = filter_input(INPUT_POST, "changeprice");
$advancebooking = filter_input(INPUT_POST, "changeadvancebooking");
$hall = filter_input(INPUT_POST, "changehall");

if (isset($submit) && isset($id_promitani)) {
    $result = Model::updateSchedule($id_promitani, $language, $screeningtime, $price, $advancebooking, $hall);
}elseif (isset($submit)){

    $result = Model::addSchedule($language, $screeningtime, $price, $advancebooking, $hall);
}
 require_once 'adminfooter.php';

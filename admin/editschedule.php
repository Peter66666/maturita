<?php
require_once 'adminheaderV2.php';

$id_promitani = filter_input(INPUT_GET, "id_promitani");
$row1 = Model::extractProgram($id_promitani);
$result = Model::extractHalls();
$result2 = Model::extractfilms();
$result3 = Model::extractScreeningType();
?><hr>

<form method="post">
Název filmu:<select name="film">
    <?php foreach ($result2 as $row2) { ?>
        <option value="<?php echo $row2["id_filmu"] ?>"><?php echo $row2["nazev_filmu"];
} ?></option>
</select><br/>
Jazyk:<input type="text" name="changelang" value="<?php echo $row1["jazyk"]?>"/><br/>
Čas promítání:<input type="date" name="changescreeningtime" value="<?php echo $row["cas_promitani"]?>"/><br/>
Cena:<input type="text" name="changeprice" value="<?php echo $row1["cena"]?>"/><br/>
Konec předprodeje:<input type="date" name="changeadvancebooking" value="<?php echo $row["konec_predprodeje"]?>"/><br/>
Typ promítání:<select name="promitani">
    <?php foreach ($result3 as $row3) { ?>
        <option value="<?php echo $row3["id_typ_promitani"] ?>"><?php echo $row3["nazev"];
} ?></option>
</select><br/>
Sál:<select name="changehall">
    <?php foreach ($result as $row) { ?>
        <option value="<?php echo $row["id_salu"] ?>"><?php echo $row["nazev_salu"];
} ?></option>
</select><br/>
<input type="submit" name="submit" value="Odeslat"/>
</form>
<a href="http://localhost/maturitni_prace/admin/listSchedule.php">Zpět</a>
<hr>
<?php
$submit = filter_input(INPUT_POST, "submit");
$film = filter_input(INPUT_POST, "film");
$screeningtype = filter_input(INPUT_POST, "promitani");
$language = filter_input(INPUT_POST, "changelang");
$screeningtime = filter_input(INPUT_POST, "changescreeningtime");
$price = filter_input(INPUT_POST, "changeprice");
$advancebooking = filter_input(INPUT_POST, "changeadvancebooking");
$id_salu = filter_input(INPUT_POST, "changehall");

if (isset($submit) && isset($id_promitani))
{
    $result = Model::updateSchedule($id_promitani, $film, $screeningtype, $language, $screeningtime, $price, $advancebooking, $id_salu);
}elseif (isset($submit)){

    $result = Model::addSchedule($film, $screeningtype, $language, $screeningtime, $price, $advancebooking, $id_salu);
}
 require_once 'adminfooter.php';

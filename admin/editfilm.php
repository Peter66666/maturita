<?php
require_once 'adminheaderV2.php';


?><hr>
<form method="post">
    Upravit film:<input type="text" name="newfilm"/><br/>
    <input type="submit" name="submit" value="Upravit"/>
</form>
<?php
Model::extractFilms();

$id_filmu = filter_input(INPUT_GET, "id_filmu");
$nazev_filmu = filter_input(INPUT_POST, "newfilm");
$submit = filter_input(INPUT_POST, "submit");

if(isset($submit) && (isset($id_filmu))){
  Model::updateFilm($id_filmu, $nazev_filmu);
} elseif (isset($submit)){
  Model::addFilm($submit, $nazev_filmu);
}
?>
<br/>
<a href="../listFilms.php">Zpět</a>
<hr>
<?php
require_once 'adminfooter.php';

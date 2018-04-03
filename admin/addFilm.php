<?php
require_once 'adminheader.php';
require_once 'C:\xampp\htdocs\maturita\autoloader.php';
?><hr>
<form method="post" action="addFilm.php">
    Nový film:<input type="text" name="newfilm"/><br/>
    <input type="submit" name="submit" value="Přidat film"/>
</form>
<?php
Model::extractFilms();

$newfilm = filter_input(INPUT_POST, "newfilm");
$submit = filter_input(INPUT_POST, "submit");


$result = Model::addFilm($submit, $newfilm);
?>
<br/>
<a href="listFilms.php">Zpět</a>
<hr>
<?php
require_once 'adminfooter.php';

<?php
require_once 'adminheader.php';

?><hr><?php
$result = Model::extractFilms();

foreach ($result as $row) {
    echo $row["nazev_filmu"] ." " ?> <a href="editfilm/<?php echo $row["id_filmu"] ?>">Upravit</a><br/><?php
}
?>
<br/>
<br/>
<a href="editfilm/new">Přidat</a><br/>
<a href="./index.php">Zpět</a>
<hr>
<?php
require_once 'adminfooter.php';

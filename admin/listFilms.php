<?php
require_once 'adminheader.php';
require_once 'C:\xampp\htdocs\maturita\autoloader.php';
?><hr><?php 
$result = Model::extractFilms();

foreach ($result as $row) {
    echo $row["nazev_filmu"] ." " ?> <a href="editfilm/<?php echo $row["id_filmu"] ?>">Upravit</a><br/><?php 
} 
?>
<br/>
<br/>
<a href="addFilm.php">Přidat film</a>
<hr>
<?php
require_once 'adminfooter.php';

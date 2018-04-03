<?php
require_once 'adminheader.php';

?><hr><?php
$result = Model::extractUsers();

foreach ($result as $row) {
   echo $row["jmeno"] . " " . $row["prijmeni"] . "" ?> <a href="edituser/<?php echo $row["id_zak"] ?>">Upravit</a><br/> <?php
}
?>
<br/>
<a href="edituser/new">Přidat</a>
<br/>
<a href="../admin/index.php">Zpět</a>
<hr>
<?php
require_once 'adminfooter.php';

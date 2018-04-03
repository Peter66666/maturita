<?php
require_once 'adminheader.php';
require_once 'C:\xampp\htdocs\maturita\autoloader.php';
?><hr><?php
$result = Model::extractUsers();

foreach ($result as $row) {
   echo $row["jmeno"] . " " . $row["prijmeni"] . "" ?> <a href="edituser/<?php echo $row["id_zak"] ?>">Upravit</a><br/> <?php 
} 
?>
<br/>
<br/>
<a href="../admin/index.php">Zpět</a>
<hr>
<?php
require_once 'adminfooter.php';

<?php
require_once 'adminheader.php';
require_once 'C:\xampp\htdocs\maturita\autoloader.php';
?><hr><?php

?>
<table border="1">
<?php
foreach ($result as $row) {
    
    ?><tr>
        <td><?php echo $row["nazev_filmu"] ?></td><td><?php echo $row["id_promitani"] ?></td><td><?php echo $row["nazev_salu"] ?></td><td><?php echo $row["jazyk"] ?></td>
        <td><a href="editschedule/<?php echo $row["id_promitani"]?>">Upravit</a></td>
<?php
} 
?>
</tr>
</table>
<br/>
<br/>
<a href="index.php">Zpět</a>
<hr>
<?php
require_once 'adminfooter.php';
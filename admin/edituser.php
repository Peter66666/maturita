<?php
require_once 'adminheader.php';
require_once 'C:\xampp\htdocs\maturita\autoloader.php';

$id_user = filter_input(INPUT_GET, "id_zak");
$row = Model::extractOneUser($id_user);
$result = Model::extractRoles();
?><hr>

<form method="post" action="edituser.php?&id_zak=<?php echo $row["id_zak"] ?>">
    Nové jméno:<input type="text" name="changename" value="<?php echo $row["jmeno"]?>"/><br/>
    Nové příjmení:<input type="text" name="changesurname" value="<?php echo $row["prijmeni"]?>"/><br/>
    Nový e-mail:<input type="text" name="changemail" value="<?php echo $row["email"] ?>"/><br/>
    Datum narození:<input type="date" name="changebirth" value="<?php echo $row["datum_narozeni"] ?>"/><br/>
    Nové heslo:<input type="password" name="changepasswd"/><br/>
    Nová role:<select name="changerole">
        <?php foreach ($result as $row) { ?>
            <option value="<?php echo $row["role"] ?>"><?php echo $row["role"];
    } ?></option>
    </select><br/>
    <input type="submit" name="update" value="Odeslat"/><br/>
</form>
<a href="../listUsers.php">Zpět</a>
<hr>
<?php
$update = filter_input(INPUT_POST, "update");
$newName = filter_input(INPUT_POST, "changename");
$newSurname = filter_input(INPUT_POST, "changesurname");
$newMail = filter_input(INPUT_POST, "changemail");
$newPasswd = filter_input(INPUT_POST, "changepasswd");
$newRole = filter_input(INPUT_POST, "changerole");
$newBirth = filter_input(INPUT_POST, "changebirth");

if (isset($update) && isset($id_user)) {
    $result = Model::updateUser($id_user, $newName, $newSurname, $newMail, $newPasswd, $newRole, $newBirth);
}elseif (isset($update)){
    
    $result = Model::addUser($newName, $newSurname, $newMail, $newPasswd, $newRole, $newBirth);
}
require_once 'adminfooter.php';

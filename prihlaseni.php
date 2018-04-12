<?php
error_reporting(0);
require_once 'autoloader.php';
$submit = filter_input(INPUT_POST, "submit");
$email = filter_input(INPUT_POST, "email");
$password = filter_input(INPUT_POST, "password");

if (isset($submit)) {
    $result = Model::logIn($email, $password);

    if (isset($result)) {
        session_start();
        $_SESSION["email"] = $email;
        var_dump($_SESSION);
    }
}


include_once 'header.php';

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php if (!isset($_SESSION["email"])) { ?>
        <form method="post" action="prihlaseni.php">
                <label>email</label>
                <input type="text" name="email" />
                <label>heslo</label>
                <input type="password" name="password" />
                <input name="submit" type="submit" value="Odeslat"/>
            </form>
            <?php
        } else {

            echo "Jste přihlášeni jako " . $_SESSION["email"];
            echo "<br>";
            ?>
            <a href="logout.php">Odhlásit se</a>
            <?php
        }
        include_once 'footer.php';

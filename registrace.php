<?php
require_once 'autoloader.php';
include_once 'header.php';
?>

<div id="register">
    <form method="post" action="registrace.php">
        Jméno:<input type="text" name="name"/><br/>
        Příjmení:<input type="text" name="surname"/><br/>
        E-mail:<input type="email" name="mail"/><br/>
        Datum narození:<input type="date" name="birthdate"/><br/>
        Heslo:<input type="password" name="passwd"/><br/>
        Heslo znovu:<input type="password" name="passwd2"/><br/>
        <input type="submit" name="submit" value="Registrovat"/>
    </form>
    <?php
    $submit = filter_input(INPUT_POST, "submit");
    $passwd = filter_input(INPUT_POST, "passwd");
    $passwd2 = filter_input(INPUT_POST, "passwd2");
    $name = filter_input(INPUT_POST, "name");
    $surname = filter_input(INPUT_POST, "surname");
    $mail = filter_input(INPUT_POST, "mail");
    $birthdate = filter_input(INPUT_POST, "birthdate");

    $result = Model::registerUser($submit, $passwd, $passwd2, $name, $surname, $mail, $birthdate);
    
    ?>
</div>
<?php
include_once 'footer.php';

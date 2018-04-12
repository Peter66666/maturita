<?php

class Model {

    const SALT = "saltysalt666";

    public static function getPromitani($ID_promitani = null) {
        $where = "";
        if (isset($ID_promitani)) {
            $where = "WHERE p.id_promitani = '$ID_promitani'";
        }
        $query = "SELECT p.cas_promitani, f.nazev_filmu, p.cena, p.id_promitani, p.jazyk, sa.nazev_salu, tp.nazev, sa.pocet_mist, konec_predprodeje FROM `program` p
                          JOIN `filmy` f ON p.id_filmu = f.id_filmu
                          JOIN `typy_promitani` tp ON p.id_typ_promitani = tp.id_typ_promitani
                          JOIN `saly` sa ON p.id_salu = sa.id_salu
                          $where;";
        $result = MySQLDB::queryString($query);
        $promitani = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $promitani[] = $row;
        }
        return $promitani;
    }

    public static function buySeat($ID_promitani, $ID_sedacky) {
        $query = "UPDATE `sedacky_promitani` SET
          `id_status` = '2'
           WHERE `id_sedacky` = $ID_sedacky AND `id_promitani` = $ID_promitani;";
        MySQLDB::queryString($query);
    }

    public static function bookSeat($ID_promitani, $ID_sedacky) {
        $query = "UPDATE `sedacky_promitani` SET
          `id_status` = '3'
           WHERE `id_sedacky` = $ID_sedacky AND `id_promitani` = $ID_promitani;";
        MySQLDB::queryString($query);
    }

    public static function registerUser($submit, $passwd, $passwd2, $name, $surname, $mail, $birthdate) {
        if ((isset($submit)) && ($name != "") && ($surname != "") && ($mail != "") && ($passwd == $passwd2)) {
            $password = md5($passwd . self::SALT . $mail);
            $query = "INSERT INTO `zakaznici` (`role`, `id_obj`, `jmeno`, `prijmeni`, `datum_narozeni`, `email`, `heslo`) VALUES ('user', '', '$name', '$surname', '$birthdate', '$mail', '$password');";
            MySQLDb::queryString($query);
            echo "Registrace proběhla v pořádku.";
        } else {
            echo "Někde nastala chyba";
        }
    }

    public static function addFilm($submit, $nazev_filmu){
        if ((isset($submit)) && ($nazev_filmu != "")){
           $query = "INSERT INTO `filmy` (`nazev_filmu`) VALUES ('$nazev_filmu');";
           MySQLDB::queryString($query);
           echo "Přidali jste nový film.";
        } else {
            echo "Někde nastala chyba";
        }

    }

public static function addUser($newName, $newSurname, $newMail, $newPasswd, $newRole, $newBirth){
    if(($newName != "") && ($newSurname != "") && ($newMail != "") && ($newPasswd != "") && ($newBirth != "")){
        $query = "INSERT INTO `zakaznici` (`role`, `id_obj`, `jmeno`, `prijmeni`, `datum_narozeni`, `email`, `heslo`) VALUES ('$newRole', '', '$newName', '$newSurname', '$newBirth', '$newMail', '$newPasswd');";
        MySQLDB::queryString($query);
        echo "Přidali jste nového uživatele";
    } else {
        echo "Někde nastala chyba.";
    }
}




    public static function logIn($email, $password) {
        $hash = md5($password . self::SALT . $email);
        $query = "SELECT * FROM `zakaznici` WHERE `email` = '$email' AND `heslo` = '$hash' LIMIT 1;";
        $result = MySQLDb::queryString($query);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

    public static function cancelSeat($ID_promitani, $ID_sedacky) {
        $query = "UPDATE `sedacky_promitani` SET
                  `id_status` = '1'
                   WHERE `id_sedacky` = $ID_sedacky AND `id_promitani` = $ID_promitani;";
        MySQLDB::queryString($query);
    }

    public static function extractSeats($ID_promitani) {
        $query = "SELECT * FROM `sedacky_promitani` sp

                          JOIN `status` s ON sp.id_status = s.id_status
                          JOIN `sedacky` sed ON sp.id_sedacky = sed.id_sedacky
                          WHERE id_promitani = $ID_promitani
                          ORDER BY rada, cislo_v_rade";
        $result = MySQLDB::queryString($query);
        $seatInfo = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $seatInfo[] = $row;
        }
        return $seatInfo;
    }

    public static function getOrder($ID_promitani, $ID_sedacky) {
        $query = "SELECT * FROM `program` p
                            JOIN  `sedacky_promitani` sp ON p.id_promitani = sp.id_promitani
                            JOIN  `filmy` f ON f.id_filmu = p.id_filmu
                            JOIN `saly` s ON s.id_salu = p.id_salu
                            JOIN `sedacky` sy ON sy.id_sedacky = sp.id_sedacky
                            WHERE p.`id_promitani` = $ID_promitani AND sp.`id_sedacky` = $ID_sedacky;";
        $result = MySQLDB::queryString($query);
        $order = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $order[] = $row;
        }
        return $order;
    }

    public static function extractUsers() {
        $query = "SELECT * FROM `zakaznici`";
        $result = MySQLDB::queryString($query);
        $userInfo = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $userInfo[] = $row;
        }
        return $userInfo;
    }

    public static function extractOneUser($id_user){
        $query = "SELECT * FROM `zakaznici` WHERE `id_zak` = '$id_user'";
        $result = MySQLDB::queryString($query);
        $row = mysqli_fetch_assoc($result);
        return $row;


    }

    public static function extractScreeningType(){
      $query = "SELECT * FROM `typy_promitani` t
                JOIN  `program` p ON p.id_typ_promitani = t.id_typ_promitani;";
      $result = MySQLDb::queryString($query);
      $typeInfo = array();
      while ($row = mysqli_fetch_assoc($result)){
        $typeInfo[] = $row;
      }
      return $typeInfo;
    }

    public static function extractFilms() {
        $query = "SELECT * FROM `filmy`";
        $result = MySQLDB::queryString($query);
        $filmInfo = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $filmInfo[] = $row;
        }
        return $filmInfo;
    }


    public static function extractRoles(){
        $query = "SELECT `role` FROM `zakaznici`";
        $result = MySQLDB::queryString($query);
        $roleInfo = array();
        while ($row = mysqli_fetch_assoc($result)){
            $roleInfo[] = $row;
        }
        return $roleInfo;
    }

    public static function extractHalls(){
      $query = "SELECT `id_salu`, `nazev_salu` FROM `saly`";
      $result = MySQLDb::queryString($query);
      $hallInfo = array();
      while ($row = mysqli_fetch_assoc($result)){
        $hallInfo[] = $row;
      }
      return $hallInfo;
    }

    public static function extractProgram($id_promitani) {
        $query = "SELECT * FROM `program` p
                 JOIN  `filmy` f ON f.id_filmu = p.id_filmu
                 JOIN `saly` s ON s.id_salu = p.id_salu WHERE `id_promitani` = '$id_promitani';";
        $result = MySQLDB::queryString($query);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

    public static function extractUniqueScreening($id_promitani){
      $query = "SELECT * FROM `program` WHERE `id_promitani` = '$id_promitani';";
               $result = MySQLDb::queryString($query);
               $row = mysqli_fetch_assoc($result);
               return $row;
    }

    public static function extractSpecificUser($ID_user) {
        $query = "SELECT * FROM `zakaznici` WHERE `id_zak` = '$ID_user';";
        $result = MySQLDb::queryString($query);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

    public static function updateUser($id_user, $newName, $newSurname, $newMail, $newPasswd, $newRole, $changeBirth) {
        if (($newName != "") && ($newSurname != "") && ($newMail != "") && ($newPasswd != "")) {
            $newPasswd = md5($newPasswd . self::SALT . $newMail);
            $query = "UPDATE `zakaznici` SET `jmeno` = '$newName', `prijmeni` = '$newSurname', `datum_narozeni` = '$changeBirth', `email` = '$newMail', `role` = '$newRole', `heslo` = '$newPasswd' WHERE `id_zak` = '$id_user';";
            MySQLDb::queryString($query);
            echo "Aktualizace zákazníka úspěšně proběhla.";
        } else {
            echo "Někde nastala chyba";
        }
    }

    public static function updateSchedule($id_promitani, $film, $screeningtype, $language, $screeningtime, $price, $advancebooking, $id_salu){
        if(($language != "") && ($screeningtime != "") && ($price != "") && ($advancebooking != "") && ($id_salu != "")){
        $query = "UPDATE `program` SET `id_filmu` ='$film', `id_typ_promitani` ='$screeningtype', `jazyk` = '$language', `cas_promitani` = '$screeningtime', `cena` = '$price', `konec_predprodeje` = '$advancebooking', `id_salu` = '$id_salu' WHERE `id_promitani` = '$id_promitani';";
        MySQLDb::queryString($query);
        var_dump($query);
        echo "Aktualizace promítání úspěšně proběhla.";
  } else {
        echo "Někde nastala chyba";
      }

  }

    public static function updateFilm($id_filmu, $nazev_filmu){
      if (isset($id_filmu)){
        $query = "UPDATE `filmy` SET `nazev_filmu` = '$nazev_filmu' WHERE `id_filmu` = '$id_filmu';";
        MySQLDb::queryString($query);
        echo "Aktualizace filmu úspěšně proběhla.";
      } else {
        echo "Někde nastala chyba";
      }
    }
//zjištění horní a dolní hranice id sedačky pro nové promítání
    private static function prepareSeats($id_salu){
    $query = "SELECT MIN(id_sedacky) AS dolni_hranice, MAX(id_sedacky) AS horni_hranice FROM `sedacky` WHERE `id_salu` = '$id_salu';";
    $result = MySQLDB::queryString($query);
    $row = mysqli_fetch_assoc($result);
    return $row;
    }
//přidání volných sedaček k novému promítání
    private static function addSeats($id_salu){
      $row_hranice = Model::prepareSeats($id_salu);
      $query2 = "SELECT MAX(id_promitani) AS id_max_promitani FROM `program`;";
      $result2 = MySQLDB::queryString($query2);
      $row2 = mysqli_fetch_assoc($result2);
      

      for ($id_sedacky = $row_hranice["dolni_hranice"]; $id_sedacky <= $row_hranice["horni_hranice"]; $id_sedacky++){
        echo "smrt!";
        $query = "
            INSERT INTO `sedacky_promitani` (`id_sedacky`, `id_promitani`, `id_status`)
            VALUES('". $id_sedacky ."', '".$row2["id_max_promitani"]."', '1');
            ";
        echo $query;
        MySQLDB::queryString($query);
      }
    }
//přidání nového promítání i s jeho volnými sedačkami v sálu
    public static function addSchedule($film, $screeningtype, $language, $screeningtime, $price, $advancebooking, $id_salu){
      if(($language != "") && ($screeningtime != "") && ($price != "") && ($advancebooking != "") && ($id_salu != "")){
        $query = "INSERT INTO `program` (`id_filmu`, `id_typ_promitani`, `jazyk`, `cas_promitani`, `cena`, `konec_predprodeje`,  `id_salu`) VALUES ('$film', '$screeningtype', '$language', '$screeningtime', '$price', '$advancebooking', '$id_salu');";
        MySQLDb::queryString($query);
        Model::addSeats($id_salu);
        echo "Přidali jste nové promítání";
      } else {
        echo "Někde nastala chyba";
      }
    }


}

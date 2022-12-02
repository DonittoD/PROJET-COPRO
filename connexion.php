<?php   
    // on donne les paramettrs
    $db_host="localhost";
    $db_user="root";
    $db_password="";
    $db_name="tpcopro";

    try{
        // la connexion a la base de données
        $db = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8",$db_user,$db_password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOEXCEPTION $e)
   {
    // en cas d'erreur de connexion de bdd
    $e->getMessage();
   }
?>
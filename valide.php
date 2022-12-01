<?php
session_start();

require('connexion.php');
require('_navbar.php');

if (!isset($_SESSION['user_login']) || time() - $_SESSION['login_time'] > 120 )
						{

							session_destroy();

							header("location: index.php");
						}


if (!isset($_GET['vote'])){
header('location: index.php');
}
else
{
    if ($_GET['idProposition'] == NULL){
        die ('veuillez choisir une Proposition');
        // header('refresh:5; vote.php');
    }

    if($_GET['vote']){
        $variable = 'pour';
        
    }else{
        $variable= 'contre';
    }   


    $sql = $db -> query('SELECT count(*) FROM votes WHERE idProposition =' . $_GET['idProposition'] . ' AND idCopro ='.$_SESSION['user_login']);
    $row=$sql->fetch(PDO::FETCH_NUM);

    if($row[0] != 0)
    {
        echo $_SESSION['name_user'] . ' a déjà voté pour la proposition';
    }else{
        foreach($db -> query('SELECT libelle FROM propositions INNER JOIN propositions_ag ON propositions.id = propositions_ag.idProposition WHERE idProposition = ' . $_GET['idProposition'] . '') as $row){
            echo $_SESSION['name_user']." a voté ".$variable.' dans la proposition '.$row['libelle'];
            echo '<br>';

            $sql = $db -> prepare('INSERT INTO votes(annee, idCopro, idProposition, pourContre) VALUES(YEAR(curdate()), ?, ?, ?)');
            $sql->execute(array(
                $_SESSION['user_login'],
                $_GET['idProposition'],
                $_GET['vote']
            ));
            echo $_GET['vote'];

        }
    }
}



?>


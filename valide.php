<?php
session_start();

require('connexion.php');
require('_navbar.php');

// verifier si il y a une session est existante ou si elle a depassé 2Min
if (!isset($_SESSION['user_login']) || time() - $_SESSION['login_time'] > 120 )
{
session_destroy();

// si non retour a la page de connexion
header("location: index.php");	
}

// verifie si l'utilisateur a a vote 
if (!isset($_GET['vote'])){

    // si non on lui redirige a la page ou on peut voté
    header('location: vote.php');
}
else
{
    // si propositions n'est pas selectionné
    if ($_GET['idProposition'] == NULL){

        // on le on affiche une erreur 
        die ('veuillez choisir une Proposition');
    }

    // si vote = 1 on met dans un valeurDuVote pour 
    if($_GET['vote']){
        $valeurDuVote = 'pour';
        
    }else{

        // si non contre
        $valeurDuVote= 'contre';
    }   

    // on interoge la base de données pour verifier si l'utilisateur a voté
    $sql = $db -> query('SELECT count(*) FROM votes WHERE idProposition =' . $_GET['idProposition'] . ' AND idCopro ='.$_SESSION['user_login']);
    $row=$sql->fetch(PDO::FETCH_NUM);


    // on verifie si la requete retourne 1 
    if($row[0] != 0)
    {

    // si la requete affiche 1 : on affiche que l'utilisateur a deja voté 
    echo $_SESSION['name_user'] . ' a déjà voté pour la proposition';
    }else{

        // on interoge la base de données pour savoir cmb de vantant on a besoin 
        foreach($db -> query('SELECT libelle FROM propositions INNER JOIN propositions_ag ON propositions.id = propositions_ag.idProposition WHERE idProposition = ' . $_GET['idProposition'] . '') as $row){

            // sinon on affiche le nom de l'utilisateur qui a voté (pour ou contre) et la proposiotion
            echo $_SESSION['name_user']." a voté ".$valeurDuVote.' dans la proposition '.$row['libelle'];
            echo '<br>';

            // on insert les valeur que l'utilisateur a mis pour envoyer dans la bdd
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


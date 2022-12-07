<?php 
    session_start();

require('connexion.php');
require('_navbar.php');

// verifier si il y a une session est existante ou si elle a depassé 2Min
if (!isset($_SESSION['user_login']) || time() - $_SESSION['login_time'] > 120 || $_SESSION['role'] != 'admin')
{
session_destroy();

// si non retour a la page de connexion
header("location: index.php");	
}

echo'<div class="information_utilisateur">historique des votant <table>';    
    // on interoge la base de données pour verifier si l'utilisateur a voté
    foreach( $db -> query('SELECT * FROM votes INNER JOIN coproprietaires ON coproprietaires.id = votes.idCopro  INNER JOIN propositions ON propositions.id = votes.idProposition ') as $row){ 
        if($row['pourContre']){
            $variable = 'pour';
        }else{
            $variable = 'contre';
        }

        echo '<tr>';
        echo"<td>". $row['idCopro']."</td>";
        echo"<td>". $row['prenom']."</td>";
        echo '<td>' . $row['libelle'] .'</td>';
        echo"<td>". $row['annee']."</td>";
        echo"<td>". $variable."</td>";
        echo'</tr>';

    }
    
    echo'</table>';
    echo"</div><br>";
    
    

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

echo'<div class="information_utilisateur">historique de tout les votant <table>';  
echo '<select name="idProposition" id="select_vote">
<option value="">--choisir une option--</option> <!-- la valeur est null par default -->
';
foreach ( $db -> query('SELECT libelle, idProposition FROM propositions INNER JOIN propositions_ag ON propositions.id = propositions_ag.idProposition ')as $row) {
    
    echo'<option value="' . $row['idProposition']. '">' . $row['libelle'] . '</option>';

}
echo '</select>';    

echo'<tr>';
echo'<td> ID :</td>';
echo'<td> PRENOM : </td>';
echo'<td> SUJET : </td>';
echo'<td> ANNEE : </td>';
echo'<td> VOTE :</td>';
echo'</tr>';
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
    foreach($db -> query('SELECT count(*) as total FROM votes INNER JOIN coproprietaires ON coproprietaires.id = votes.idCopro  INNER JOIN propositions ON propositions.id = votes.idProposition')as $row ){
        echo '<tr>';
        echo'<td> TOTAL DE VOTANT :</td>';
        echo'<td></td>';
        echo'<td></td>';
        echo'<td></td>';
        echo"<td>".$row['total']."</td>";
        echo'</tr>';

    }
    echo'</table>';
    echo"</div><br>";
    
    
    echo'<div class="information_utilisateur"> tout les copropriétaire :';
    echo'<table>';
    echo'<tr>';
    echo'<td> PRENOM :</td>';
    echo'<td> NOM : </td>';
    echo'<td> TANTIEME : </td>';
    echo'</tr>';


    
    // on interoge la base de données pour affiche toute la liste des utilisateur
    foreach ( $db -> query('SELECT * FROM coproprietaires ORDER BY tantieme ')as $row) {
        
        echo '<tr>';
        echo"<td>". $row['prenom']."</td>";
        echo"<td>". $row['nom']."</td>";
        echo"<td>". $row['tantieme']."</td>";
        echo'</tr>';
    
    }
    foreach($db -> query('SELECT count(*) as total FROM coproprietaires')as $row ){
        echo '<tr>';
        echo'<td> TOTAL UTILISATEUR :</td>';
        echo'<td></td>';
        echo"<td>".$row['total']."</td>";
        echo'</tr>';

    }

    echo'</table>';
    echo"</div><br>";


    
    
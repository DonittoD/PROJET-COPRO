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

// la creation d'une table 
// TODO: on peut mettre ici des interogation a la base de données pour avoir le données de table  
echo'<div class="information_utilisateur"> tout les proposition :';
echo'<table>
<tr> toutes les propositions de l\'assemble générale </tr><br>';                       
echo'<tr>';
echo'<td> ID  :</td>';
echo'<td> SUJET DE PROPOSITION :</td>';
echo'<td> ANNEE :</td>';
echo'<td>TEMP :</td>';
echo'</tr>';



// on interoge la base de donnée qui est sur la table proposition_ag
foreach ($db->query('SELECT idProposition, annee,valide, libelle FROM propositions_ag INNER JOIN propositions ON propositions.id = propositions_ag.idProposition') as $row) {

    echo '<tr>
    <td>'. $row['idProposition'].' </td>
    <td>'.$row['libelle'].'</td>
    <td>' . $row['annee']. '</td>
    <td>' ; if($row['valide'] == null){ echo' en cours </td>'; }else{ echo' terminée </td>'; }
    echo '</tr>';

}
echo '</table>';
echo'</div>';


?>
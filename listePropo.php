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
echo'<th> id proposition </th>';
echo'<th> année </th>';
echo'<th>valide </th>';
echo'</tr>';

// ici c'est un interogation a la base de donnée qui marche pour la table proposition
    // foreach ( $db -> query('SELECT * FROM propositions')as $row) {
    
    // echo '<tr>';
    // echo"<td>". $row['idArticle']."</td>";
    // echo"<td>". $row['libelle']."</td>";
    // echo'</tr>';
    // }

// on interoge la base de donnée qui est sur la table proposition_ag
foreach ($db->query('SELECT * FROM propositions_ag') as $row) {
    
    echo '<tr>
    <td>'. $row['idProposition'].' </td>
    <td>' . $row['annee']. '</td>
    <td>' . $row['valide'].'</td>
    </tr>';

}
echo '</table>';
echo'</div>';


?>
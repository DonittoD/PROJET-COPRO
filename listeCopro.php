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
echo'<div class="information_utilisateur"> tout les copropriétaire :';
echo'<table>';

    echo'<tr>';
    echo'<td> PRENOM :</td>';
    echo'<td> NOM : </td>';
    echo'<td> TANTIEME : </td>';
    echo'</tr>';

// on interoge la base de données pour affiche toute la liste des utilisateur
foreach ( $db -> query('SELECT * FROM coproprietaires ORDER BY tantieme')as $row) {
    
    echo '<tr>';
    echo"<td>". $row['prenom']."</td>";
    echo"<td>". $row['nom']."</td>";
    echo"<td>". $row['tantieme']."</td>";
    echo'</tr>';

}

echo'</table>';
echo"</div><br>";


?>
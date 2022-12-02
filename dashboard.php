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
echo'<table>';
 
   // on prepare la requete sql ou on interoge la base de données avec le information de utilisateur 
   $var= $db -> prepare('SELECT * FROM coproprietaires  WHERE prenom = :username');
   $var->execute(array(':username'=>$_SESSION["name_user"],));  
   $row=$var->fetch(PDO::FETCH_ASSOC);

   // ici c'est les titres du tableaux
   echo'<tr>';
   echo'<td> prenom </td>';
   echo'<td> nom </td>';
   echo'<td> tantieme </td>';
   echo'</tr>';

   // on affiche les valeur que l'on a eu sur la requete
   echo'<tr>';
   echo"<td>". $row['prenom']."</td>";
   echo"<td>". $row['nom']."</td>";
   echo"<td>". $row['tantieme']."</td>";
   echo'</tr>';

echo'</table>';
echo"<br>";
// le hyperlien pour se deconnecter
echo'<a href="disconect.php"> disconect</a>';
?>  
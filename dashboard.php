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
echo'<div class="information_utilisateur">vos information :';
echo'<table>';

   // on prepare la requete sql ou on interoge la base de données avec le information de utilisateur 
   $var= $db -> prepare('SELECT * FROM coproprietaires  WHERE prenom = :username');
   $var->execute(array(':username'=>$_SESSION["name_user"],));  
   $row=$var->fetch(PDO::FETCH_ASSOC);

   // ici c'est les titres du tableaux
   echo'<tr>';
   echo'<td> prenom : </td>';
   echo'<td> nom : </td>';
   echo'<td> tantieme : </td>';
   echo'</tr>';

   // on affiche les valeur que l'on a eu sur la requete
   echo'<tr>';
   echo"<td>". $row['prenom']."</td>";
   echo"<td>". $row['nom']."</td>";
   echo"<td>". $row['tantieme']."</td>";
   echo'</tr>';

echo'</table>';
echo"</div><br>";

echo'<div class="information_utilisateur">information sur toutes les propositions';
echo'<table>';

// ici c'est un interogation a la base de donnée qui marche pour la table proposition
    foreach ( $db -> query('SELECT * FROM propositions')as $row) {
    
    echo '<tr>';
    echo"<td>". $row['idArticle']."</td>";
    echo"<td>". $row['libelle']."</td>";
    echo'</tr>';
    }
echo'</table>';
echo'</div>';


echo'<div class="information_utilisateur">historique de '. $_SESSION["name_user"].'<table>';
   
   echo'<tr>';
   echo'<td> id : </td>';
   echo'<td> prenom : </td>';
   echo'<td> sujet : </td>';
   echo'<td> année : </td>';
   echo'<td> sujet du vote : </td>';
   echo'</tr>';
    
// on interoge la base de données pour verifier si l'utilisateur a voté
foreach( $db -> query('SELECT * FROM votes INNER JOIN propositions ON propositions.id = votes.idProposition WHERE idCopro ='.$_SESSION['user_login']) as $row){ 
    if($row['pourContre']){
        $variable = 'pour';
    }else{
        $variable = 'contre';
    }

    echo '<tr>';
    echo"<td>". $row['idCopro']."</td>";
    echo"<td>". $_SESSION['name_user']."</td>";
    echo '<td>' . $row['libelle'] .'</td>';
    echo"<td>". $row['annee']."</td>";
    echo"<td>". $variable."</td>";
    echo'</tr>';

}

echo'</table>';
echo"</div><br>";

// le hyperlien pour se deconnecter
echo'<a class="deconnexion" href="disconect.php"> déconexion</a>';
?>  
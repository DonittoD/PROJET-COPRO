<?php
session_start();

require('connexion.php');
require('_navbar.php');

if (!isset($_SESSION['user_login']) || time() - $_SESSION['login_time'] > 120 )	//check unauthorize user not access in "welcome.php" page
						{

							session_destroy();

							header("location: index.php");
						}


echo'<table>
<tr> toutes les propositions de l\'assemble générale </tr><br>';                       
echo'<tr>';
echo'<th> id proposition </th>';
echo'<th> année </th>';
echo'<th>valide </th>';
echo'</tr>';


    // foreach ( $db -> query('SELECT * FROM propositions')as $row) {
    
    // echo '<tr>';
    // echo"<td>". $row['idArticle']."</td>";
    // echo"<td>". $row['libelle']."</td>";
    // echo'</tr>';
    // }

foreach ($db->query('SELECT * FROM propositions_ag') as $row) {
    
    echo '<tr>
    <td>'. $row['idProposition'].' </td>
    <td>' . $row['annee']. '</td>
    <td>' . $row['valide'].'</td>
    </tr>';

}
echo '</table>';



?>
<?php
session_start();

require('connexion.php');
require('_navbar.php');

if (!isset($_SESSION['user_login']) || time() - $_SESSION['login_time'] > 120 )	//check unauthorize user not access in "welcome.php" page
						{

							session_destroy();

							header("location: index.php");
						}

echo'<table>';

echo'<tr>';
echo'<td> prenom </td>';
echo'<td> nom </td>';
echo'<td> tantieme </td>';
echo'</tr>';

foreach ( $db -> query('SELECT * FROM coproprietaires')as $row) {
    
    echo '<tr>';
    echo"<td>". $row['prenom']."</td>";
    echo"<td>". $row['nom']."</td>";
    echo"<td>". $row['tantieme']."</td>";
    echo'</tr>';

}

echo'</table>';
echo"<br>";
echo'<a href="disconect.php"> disconect</a>';


?>
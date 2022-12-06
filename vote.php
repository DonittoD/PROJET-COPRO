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
?>

<!-- creation du formulaire qui part sur la page valide.php -->
<form class='vote'method="GET" action='valide.php'>

<label for="select_vote">Choisisez la proposition de l'Assemble General:</label>

<!-- la barre ou on selecte toutes les propostion de l'assemble -->
<select name="idProposition" id="select_vote">
    <option value="">--choisir une option--</option> <!-- la valeur est null par default -->

<?php

// on interoge la base de données pour voir quel sont les proposition qui sont dans l'assemble générale
foreach ( $db -> query('SELECT libelle, idProposition FROM propositions INNER JOIN propositions_ag ON propositions.id = propositions_ag.idProposition ')as $row) {
    
    echo'<option value="' . $row['idProposition']. '">' . $row['libelle'] . '</option>';
}
?>
</select>
    <fieldset>
            <legend> Vote :</legend>
                <div>
                    <input type="radio" id="pour" name="vote" value="1">
                          <label for="pour">pour</label>
                </div>    
                <div>
                    <input type="radio" id="contre" name="vote" value="0">
                      <label for="contre">contre</label>
                </div>
                <div>
                    <input type="submit" id="submit" name="submit" value="Envoyer">
                </div>
                
    </fieldset>
</form>

                    



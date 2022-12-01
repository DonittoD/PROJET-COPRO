<?php
session_start();

require('connexion.php');
require('_navbar.php');

if (!isset($_SESSION['user_login']) || time() - $_SESSION['login_time'] > 120 )	//check unauthorize user not access in "welcome.php" page
						{

							session_destroy();

							header("location: index.php");
						}

?>

<form method="GET" action='valide.php'>


<label for="select_vote">Choisisez la proposition de l'Assembe General:</label>
<select name="idProposition" id="select_vote">
    <option value="">--choisir une option--</option>

<?php

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

                    



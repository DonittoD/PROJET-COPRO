<!-- la fiche de style css -->
<style>
        table,td,th{
            border:1px solid black;
        }
  
</style>

<?php
// titre
echo'<h1>Tableau de bord</h1>';

// le nom de l'utilisateur
echo 'Bienvenue '.$_SESSION["name_user"]; 

// les hyperlien pour les autre pages
echo'<br><a href="dashboard.php">dashboard</a><br>';
echo'<br><a href="listeCopro.php">liste coproprietaires </a><br>';
echo'<a href="listePropo.php">liste propositoin assemble general</a><br>';
echo'<a href="vote.php">insertion de vote</a><br>';



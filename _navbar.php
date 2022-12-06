<!-- la fiche de style css -->
<style>
        table,td,th{
            border:1px solid black;
        }
        body{
            background-color: rgba(50,140,10,0.5); 
        }
        .page_de_connexion{
            margin :auto ;
            background-color:  rgba(255,255,255,0.80); 
            text-align: center;
            width: 30%;
            padding: 2%;
        }
        .identifiant_de_connexion{
            text-align: left;
            padding: 2%;
            margin-top: 2%;
            padding-bottom: 5%;
        }
        nav{
            margin :auto ;
            background-color:  rgba(255,255,255,0.80); 
            text-align: center;
            padding: 2%;
            margin-bottom: 5%;
        }
        .information_utilisateur{
            background-color: rgba(255,255,255,0.80); 
            margin : 2%;    
            padding : 1%;
            width: 30%;
        }   
        table{
            width: 100%;
        }
        .hyperlien{
            text-decoration: none;
            background-color: #c5f3f3;
            color: black;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin: 2%;
            padding:7px;
    
        }   
        .block_navigation{
            margin-top: 2%;
        }
        .deconnexion{
            text-decoration: none;
            background-color: #e35858;
            color: black;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin: 2%;
            padding:7px;
            text-align: left;
        } 
        input[type=submit] {
            background-color: #04AA6D;
            padding : 10px;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            float: right ;
            margin-bottom: 5%;
    
        } 
        .submit:hover{
            background-color: #45a049;
        }  
        .vote{
            margin : auto;
            background-color: #f3f3f3;
            width: 20%;
            padding: 2%;
        }   
        div{
            margin-top: 2%;
        }   
        
</style>
<nav>
<?php

if(isset($_SESSION["user_login"] )){
// le nom de l'utilisateur
echo 'Bienvenue '.$_SESSION["name_user"].' '.$_SESSION["scnd_name_user"]; 

// les hyperlien pour les autre pages
echo'<div class="block_navigation"><a class="hyperlien" href="dashboard.php">dashboard</a>';
echo'<a class="hyperlien" href="listeCopro.php">liste coproprietaires </a>';
echo'<a class="hyperlien" href="listePropo.php">liste propositoin assemble general</a>';
echo'<a class="hyperlien" href="vote.php">insertion de vote</a>';
echo'<a class="hyperlien" href="resultat.php">historique des vote</a>';

}


?>
</nav>
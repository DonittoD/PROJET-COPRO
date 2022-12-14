<?php
require_once 'connexion.php';
include ('_navbar.php');
	session_start();

	// on verifie si l'utilisateur a est connecter 
	// si oui il est redirigé vers la page dashboard 
	if(isset($_SESSION["user_login"]))	
		{
		header("location: dashboard.php");
	}

// si on verifie si l'utilisateur a cliqué sur le bouton 
if(isset($_REQUEST['btn_login']))	 
{
	// si oui on utilise la la fonction strip_tags qui permet de netoyer les information de tout script
	$username	=strip_tags($_REQUEST["txt_username"]);	//textbox name "txt_username_username"		
	$password	=strip_tags($_REQUEST["txt_password"]);	//textbox name "txt_password"

	// on verifie si l'utilisateur a mis une valeur
	if(empty($username || $password)){						
		$errorMsg[]="un champs est vide";	//check si il y a un champs qui est vide
	}

	else
	{
		try
		{
			
			// on prepare la requete pour interoge la base de données pour que l'utilisateur accedes a son compte
			$select_stmt=$db->prepare("SELECT * FROM coproprietaires WHERE prenom=:uname");
			
			// on bind param la valeur username pour evité toutes injection sql
			$select_stmt->execute(array(':uname'=>$username,));	
			
			// on recupere les information en tableau associatif
			$row=$select_stmt->fetch(PDO::FETCH_ASSOC);
			
			// on verfier qu'on reçois bien une valeur de la parde de la bdd
			if($select_stmt->rowCount() > 0)	
			{
				if($username==$row["prenom"]) //check condition user taypable "username or email" are both match from database "username or email" after continue
				{
						 if(($password == $row["password"])){
							$_SESSION["user_login"] = $row["id"];	//session name is "user_login"
                        	$_SESSION["name_user"] = $row["prenom"];
							$_SESSION["scnd_name_user"]=$row['nom'] ;
							$_SESSION["role"] = $row['role'] ;
							$_SESSION['login_time'] = time();		// on crée une minuterie 
							
							$loginMsg = "Successfully Login...";
							header("refresh:1; dashboard.php");					//on est redirigé dans le dashboard
						
						 }else{ $errorMsg[]="wrong password";} 

						}else{$errorMsg[]="wrong username or email"; }

			} else{$errorMsg[]="wrong username";}
		}

		catch(PDOException $e)
		{
			$e->getMessage();
		}		
	}
}

?>
	<body>	
	<div>
	
	<div class="container">	
		<div>
		
		<?php
		if(isset($errorMsg))
		{
			foreach($errorMsg as $error)
			{
			?>
				<div class="alert alert-danger">
					<strong><?php echo $error; ?></strong>
				</div>
            <?php
			}
		}
		if(isset($loginMsg))
		{
		?>
			<div class="alert alert-success">
				<strong><?php echo $loginMsg; ?></strong>
			</div>
        <?php
		}
		?>   
			<div class ="page_de_connexion"><h2>Connexion</h2>
				<form method="post">	
					<div class='identifiant_de_connexion'>
						<div>
							<label >Identifiant : </label>
							<input type="text" name="txt_username"  placeholder="entrez votre identifiant " />
						</div>
					
						<div>
							<label >Mot de passe :</label>
							<input type="password" name="txt_password" placeholder="entrez votre mots de passe " />
						</div>
					
						<input type="submit" name="btn_login" class="identifiant_de_connexion" value="connexion">
					</div>
				</form>
			</div>

	</body>
</html>

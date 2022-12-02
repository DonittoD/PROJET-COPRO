<?php
require_once 'connexion.php';

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
		
	// on verifie si l'utilisateur a mis une valeur
	if(empty($username)){						
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
					if($username==$row["prenom"] ) //on verifie si le nom et le nom de la bdd son equivalent
					{
						$_SESSION["user_login"] = $row["id"];	//session name is "user_login"
                        $_SESSION["name_user"] = $row["prenom"]; 
						$_SESSION['login_time'] = time();		// on crée une minuterie 
						header("dashboard.php");			//on est redirigé dans le dashboard
					
					}else{ $errorMsg[]="wrong password";}

			}
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
					<div>
						<label >Identifiant</label>
					</div>	
					<div>
						<input type="text" name="txt_username" class="form-control" placeholder="enter votre identifiant ou email" />
					</div>
			</div>
				
				<div>
					<div >
						<input type="submit" name="btn_login" class="" value="connexion">
					</div>
				</div>
			</form>
			
		</div>
		
	</div>
			
	</div>

	</body>
</html>

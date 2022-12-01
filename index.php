<?php
// 
require_once 'connexion.php';

// 
session_start();

// 
if(isset($_SESSION["user_login"]))	//check condition user login not direct back to index.php page
{
	header("location: dashboard.php");
}

// 
if(isset($_REQUEST['btn_login']))	//button name is "btn_login" 
{
	$username	=strip_tags($_REQUEST["txt_username"]);	//textbox name "txt_username_username"		//textbox name "txt_password"
		
	// 
	if(empty($username)){						
		$errorMsg[]="un champs est vide";	//check si il y a un champs qui est vide
	}

	else
	{
		try
		{
			$select_stmt=$db->prepare("SELECT * FROM coproprietaires WHERE prenom=:uname"); //sql select query
			$select_stmt->execute(array(':uname'=>$username,));	//execute query with bind parameter
			$row=$select_stmt->fetch(PDO::FETCH_ASSOC);
			
			if($select_stmt->rowCount() > 0)	//check condition database record greater zero after continue
			{
					if($username==$row["prenom"] ) //check condition user taypable "password" are match from database "password" using password_verify() after continue
					{
						$_SESSION["user_login"] = $row["id"];	//session name is "user_login"
                        $_SESSION["name_user"] = $row["prenom"];
						$_SESSION['login_time'] = time();		//user login success message
						header("dashboard.php");			//refresh 2 second after redirect to "welcome.php" page
					
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

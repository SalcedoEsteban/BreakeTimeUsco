<?php

	session_start(); //Iniciar una nueva sesión o reanudar la existente
	require 'conexion.php';
	include 'funcs.php';
	
	$errors = array();
	
	if(!empty($_POST))
	{
		$usuario = $conexion->real_escape_string($_POST['usuario']);
		$password = $conexion->real_escape_string($_POST['password']);
		
		if(isNullLogin($usuario, $password))
		{
			$errors[] = "Debe llenar todos los campos";
		}
		
		$errors[] = login($usuario, $password);	
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>::Login::</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/materialize.min.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

</head>
<body>
	

	<div class="container">    
			<div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
				<div class="panel panel-info" >
					<div class="panel-heading">
						<div class="panel-title">Iniciar Sesi&oacute;n</div>
						<div><a href="recupera.php">¿Se te olvid&oacute; tu contraseña?</a></div>
					</div>     
					
					<div>
						
						<div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
						
						<form id="loginform" class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
							
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
								<input id="usuario" type="text" class="form-control" name="usuario" value="" placeholder="usuario o email" required>                                        
							</div>
							
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
								<input id="password" type="password" class="form-control" name="password" placeholder="password" required>
							</div>
							
							<div class="form-group">
								<div class="col-sm-12 controls">
									<button id="btn-login" type="submit" class="btn btn-success">Iniciar Sesi&oacute;n</a>
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-md-12 control">
									<div >
										No tiene una cuenta! <a href="registro_usuario.php">Registrate aquí</a>
									</div>
								</div>
							</div>    
						</form>
						<?php echo resultBlock($errors); ?>
					</div>                     
				</div>  
			</div>
		</div>

	<script type="text/javascript" src="js/materialize.min.js"></script>
</body>
</html>
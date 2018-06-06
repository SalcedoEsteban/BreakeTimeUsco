<?php

	require 'conexion.php';
	require 'funcs.php';

	$errors = array();
	
	if(!empty($_POST))
	{
		$nombre = $conexion->real_escape_string($_POST['nombre']);
		$usuario = $conexion->real_escape_string($_POST['usuario']);
		$password = $conexion->real_escape_string($_POST['password']);
		$con_password = $conexion->real_escape_string($_POST['con_password']);
		$email = $conexion->real_escape_string($_POST['email']);
		$captcha = $conexion->real_escape_string($_POST['g-recaptcha-response']);
		$activo = 0;
		$tipo_usuario = 2;
		$secret = '6Lc0BF0UAAAAAP-3WUxnF_65wRoquYU4vDybOA-Q';//Modificar
		
		if(!$captcha){
			$errors[] = "Por favor verifica el captcha";
		}
		
		if(isNull($nombre, $usuario, $password, $con_password, $email))
		{
			$errors[] = "Debe llenar todos los campos";
		}
		
		if(!isEmail($email))
		{
			$errors[] = "Dirección de correo inválida";
		}
		
		if(!validaPassword($password, $con_password))
		{
			$errors[] = "Las contraseñas no coinciden";
		}		
		
		if(usuarioExiste($usuario))
		{
			$errors[] = "El nombre de usuario $usuario ya existe";
		}
		
		if(emailExiste($email))
		{
			$errors[] = "El correo electronico $email ya existe";
		}
		
		if(count($errors) == 0)
		{
			
			$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha");
			
			$arr = json_decode($response, TRUE);
			
			if($arr['success'])
			{
				
				$pass_hash = hashPassword($password);
				$token = generateToken();
				
				$registro = registraUsuario($usuario, $pass_hash, $nombre, $email, $activo, $token, $tipo_usuario);			
				if($registro > 0)
				{				
					$url = 'http://'.$_SERVER["SERVER_NAME"].'/proyecto/activar.php?id='.$registro.'&val='.$token;
					
					$asunto = 'Activar Cuenta - BreakTimeUsco';
					$cuerpo = "Estimado $nombre: <br /><br />Para continuar con el proceso de registro, es indispensable de click en la siguiente link <a href='$url'>Activar Cuenta</a>";
					
					if(enviarEmail($email, $nombre, $asunto, $cuerpo)){
						
						echo "Para terminar el proceso de registro siga las instrucciones que le hemos enviado la direccion de correo electronico: $email";
						echo "<br><a href='index.php' >Iniciar Sesion</a>";
						exit;
						} else {
						$erros[] = "Error al enviar Email";
					}
					
					} else {
					$errors[] = "Error al Registrar";
				}
				
				} else {
				$errors[] = 'Error al comprobar Captcha';
			}
		}
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/materialize.min.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
	
	<div class="container">
			<div>
				<div>
					<div>
						<div>Reg&iacute;strate</div>
						<div><a id="signinlink" href="index.php">Iniciar Sesi&oacute;n</a></div>
					</div>  
					
					<div>
						<form id="signupform" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">
							
							<div id="signupalert" style="display:none" class="alert alert-danger">
								<p>Error:</p>
								<span></span>
							</div>
							
							<div class="form-group">
								<label for="nombre" class="col-md-3 control-label">Nombre:</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="nombre" placeholder="Nombre" value="<?php if(isset($nombre)) echo $nombre; ?>" required >
								</div>
							</div>
							
							<div class="form-group">
								<label for="usuario" class="col-md-3 control-label">Usuario</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="usuario" placeholder="Usuario" value="<?php if(isset($usuario)) echo $usuario; ?>" required>
								</div>
							</div>
							
							<div class="form-group">
								<label for="password" class="col-md-3 control-label">Password</label>
								<div class="col-md-9">
									<input type="password" class="form-control" name="password" placeholder="Password" required>
								</div>
							</div>
							
							<div class="form-group">
								<label for="con_password" class="col-md-3 control-label">Confirmar Password</label>
								<div class="col-md-9">
									<input type="password" class="form-control" name="con_password" placeholder="Confirmar Password" required>
								</div>
							</div>
							
							<div class="form-group">
								<label for="email" class="">Email</label>
								<div class="col-md-9">
									<input type="email" class="form-control" name="email" placeholder="Email" value="<?php if(isset($email)) echo $email; ?>" required>
								</div>
							</div>
							
							<div class="form-group">
								<label for="captcha" class="col-md-3 control-label"></label>
								<div class="g-recaptcha" data-sitekey="6Lc0BF0UAAAAADrbFUhG7fIhismTrvnfZKiIIbZs"></div> <!-- Modificar -->
							</div>
							
							<div class="form-group">                             
								<div class="col-md-offset-3 col-md-9">
									<button id="btn-signup" type="submit" class="btn btn-info"><i class="icon-hand-right"></i>Registrar</button> 
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
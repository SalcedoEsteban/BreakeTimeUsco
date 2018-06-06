<?php
	require 'conexion.php';
	include 'funcs.php';
	
	if(isset($_GET["id"]) AND isset($_GET['val']))
	{	
		$idUsuario = $_GET['id'];
		$token = $_GET['val'];
		
		$mensaje = validaIdToken($idUsuario, $token);
	}
?>
<html>
	<head>
		<title>Registro</title>
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="css/materialize.min.css">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	</head>
	
	<body>
		<div class="container">
			<div>
				
				<h1><?php echo $mensaje; ?></h1>
				
				<br />
				<p><a class="btn" href="index.php" role="button">Iniciar Sesi&oacute;n</a></p>
			</div>
		</div>
	</body>
</html>
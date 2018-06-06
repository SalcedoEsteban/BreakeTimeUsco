<?php
	session_start();
	require 'conexion.php';
	require 'funcs.php';

	if(!isset($_SESSION["id_usuario"]))//Si no ha iniciado sesión redirecciona a index.php
	{ 
		header("Location: index.php");
	}
	
	$idUsuario = $_SESSION['id_usuario'];
	
	$sql = "SELECT usu_id, usu_nom FROM usuario WHERE usu_id = '$idUsuario'";
	$result = $conexion->query($sql);
	
	$row = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<title>::Pantalla de inicio::</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/materialize.min.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>

	<div class="container center-align">
		<div class="row">
			
			<div class="container">
				<h4><?php echo 'Bienvenido: '.utf8_decode($row['usu_nom']); ?></h4>
			</div>

			<?php if($_SESSION['tipo_usuario']==1) { ?>
				<div class="col s12">
					<h1 class="center-align">¿Qué deseas hacer?</h1>
					<br><br>
				</div>	
		    	<div class="col s6">
		    		<a href="info_indicador.php"><img class="responsive-img" src="img/registrar_datos.png"></a>
		    		<p>Registrar Actividad</p>
		    	</div>
		    	<div class="col s6">
		    		<a href="info_estadistica.php"><img class="responsive-img" src="img/consultar_estadisticas.png"></a>
		    		<p>Consultar Informes</p>
		    	</div>
		    	<div class="container">
	    		<h4><a href="logout.php">Cerrar sesion</a></h4>
	    	</div>
			<?php } ?>
			
			<?php if($_SESSION['tipo_usuario']==2) { ?>
	    	<div class="col s12">
				<h1 class="center-align">Registro de Actividades</h1>
				<br><br>
			</div>	
	    	<div class="col s6">
	    		<a href="info_indicador.php"><img class="responsive-img" src="img/registrar_datos.png"></a>
	    		<h3>Registrar actividad</h3>
	    	</div>

	    	<div class="container">
	    		<h4><a href="logout.php">Cerrar sesion</a></h4>
	    	</div>
	    	<?php } ?>
    	</div>
	</div>

	<script type="text/javascript" src="js/materialize.min.js"></script>
</body>
</html>
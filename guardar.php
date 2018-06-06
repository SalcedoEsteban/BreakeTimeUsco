<?php
	require 'conexion.php';

	$valor = "";
	$nombre = "";
	$per_id = $_GET['per_id'];

	if (isset($_POST['checkbox_futbol']))
	{
		$valor = $_POST['checkbox_futbol'];
		$nombre = "Futbol";
	}
	elseif(isset($_POST['checkbox_tennis']))
	{
		$valor = $_POST['checkbox_tennis'];
		$nombre = "Tennis";
	}
	elseif(isset($_POST['checkbox_basquetball']))
	{
		$valor = $_POST['checkbox_basquetball'];
		$nombre = "Basquetball";
	}
	elseif(isset($_POST['checkbox_volleyball']))
	{
		$valor = $_POST['checkbox_volleyball'];
		$nombre = "Volleyball";
	}

	//echo "<br>el valor es: ".$valor."y el nombre es: ".$nombre;
	
	$insert1 = "INSERT INTO actividad VALUES('$valor', '$nombre')";
	$insert2 = "INSERT INTO persona_actividad(per_id_fk, act_id_fk, per_act_nom) VALUES('$per_id', '$valor', '$nombre')";
	$resultado1 = $conexion->query($insert1);
	$resultado2 = $conexion->query($insert2);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Guardar datos</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/materialize.min.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
	<div class="container">
		<?php if ($resultado1) { ?>
		<h1>Los datos se han guardado correctamente</h1>
		<?php } ?>
		<?php if($resultado2) { ?>
		<h1>Los datos se han guardado correctamente</h1>
		<?php } else{?>
		<h1>ERROR AL GUARDAR LOS DATOS</h1>
		<?php } ?>
	</div>
	<div class="container">
		<h3><a href="logout.php">Cerrar sesion</a></h3>
	</div>
	<div class="container">
		<h3><a href="info_estadistica.php">Ver estadisticas</a></h3>
	</div>
	<div class="container">
		<h3><a href="info_indicador.php">registrar Nueva actividad</a></h3>
	</div>
	<script type="text/javascript" src="js/materialize.min.js"></script>
</body>
</html>
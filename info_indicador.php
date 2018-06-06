<?php
	session_start();
	require 'conexion.php';
	require 'funcs.php';

	if(!isset($_SESSION["id_usuario"]))//Si no ha iniciado sesión redirecciona a index.php
	{ 
		header("Location: index.php");
	}

	$where = "";

	if (!empty($_POST))
	{
		$valor = $_POST['txt_busqueda'];
		if (!empty($valor))
		{
			$where = "WHERE per_cod LIKE '%$valor%' OR per_nom_com LIKE '%$valor%' OR per_ide LIKE '%$valor%'";
		}
	}

	$sql = "SELECT * FROM persona $where";
	$resultado = $conexion->query($sql);
?>


<!DOCTYPE html>
<html>
<head>
	<title>::Buscar persona::</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/materialize.min.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
	<div class="container">
		<h3><a href="logout.php">Cerrar sesion</a></h3>
	</div>
	<div class="container">
		<h3><a href="info_estadistica.php">Ver estadisticas</a></h3>
	</div>
	<div class="container">
		<div class="row">
		    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
				<div class="row">
		      		<div class="input-field col s6">
		          		<label>Ingresa tu busqueda</label>
		          		<input type="text" name="txt_busqueda" id="txt_busqueda" class="validate" for="icon_prefix" required="">
		      		</div>
		      		<div class="col s6">
		      			<br>
		      			<input type="submit" name="enviar" id="enviar" value="buscar">
		      		</div>
		    	</div>
		    </form>
  		</div>
  	<div>
		<table class="striped responsive-table">
        <thead>
          <tr>
              <th>ID</th>
              <th>Nombre Completo</th>
              <th>Identificación</th>
              <th>Sede - Carrera</th>
              <th>Código</th>
              <th></th>
          </tr>
        </thead>
        <tbody>
        	<?php while ($row = mysqli_fetch_array($resultado)) {?>
          <tr>
            <td><?php echo $row['per_id']; ?></td>
            <td><?php echo $row['per_nom_com']; ?></td>
            <td><?php echo $row['per_ide']; ?></td>
            <td><?php echo $row['per_sed_car']; ?></td>
            <td><?php echo $row['per_cod']; ?></td>
            <td><a href="registrar.php?per_id=<?php echo $row['per_id']; ?>"><i class="medium material-icons">assignment</i></a></td>
          </tr>
        	<?php } ?>
        </tbody>
      </table>
    </div>
	</div>
	<script type="text/javascript" src="js/materialize.min.js"></script>
</body>
</html>
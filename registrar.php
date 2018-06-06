<?php
	require 'conexion.php';
	$id = $_GET['per_id'];
	$sql = "select per_nom_com, per_cod from persona where per_id='$id'";
	$resultado = $conexion->query($sql);
	$datos = mysqli_fetch_array($resultado);
?>
<!DOCTYPE html>
<html>
<head>
	<title>::Registrar</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/materialize.min.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
	<div class="container center-align">
		<p>El registro de la actividad actual se esta haciendo para el estudiante <strong><?php echo $datos['per_nom_com']; ?></strong> con codigo: <strong><?php echo $datos['per_cod']; ?></strong></p>
	</div>
	<div class="container">
		<h3 class="center-align">Informacion de la actividad</h3>
		<br>
		<h4>Seleccione la actividad que el estudiante desea utilizar</h4>
	</div>
	<div class="container left-align">
	<form action="guardar.php?per_id=<?php echo $id ?>" method="post">
	    <p>
	      <label>
	        <input type="checkbox" name="checkbox_futbol" id="checkbox_futbol" value="1" class="only-one" />
	        <span>Futbol</span>
	      </label>
	    </p>
	    <p>
	      <label>
	        <input type="checkbox" name="checkbox_tennis" id="checkbox_tennis" value="2" class="only-one"/>
	        <span>Tennis</span>
	      </label>
	    </p>
	    <p>
	      <label>
	        <input type="checkbox" name="checkbox_basquetball" id="checkbox_basquetball" value="3" class="only-one"/>
	        <span>Basquetball</span>
	      </label>
	    </p>
	    <p>
	      <label>
	        <input type="checkbox" name="checkbox_volleyball" id="checkbox_volleyball" value="4" class="only-one"/>
	        <span>Volleyball</span>
	      </label>
	    </p>
	    <input type="hidden" name="" value="">
	    <input type="submit" name="enviar" id="enviar" value="Guardar">
  	</form>
</div>
	<script type="text/javascript">
		let Checked = null;
		for (let CheckBox of document.getElementsByClassName('only-one'))
		{
			CheckBox.onclick = function()
			{
				if (Checked != null)
				{
					Checked.checked = false;
					Checked = CheckBox;
				}

				Checked = CheckBox;
			}
		}
	</script>
	<script type="text/javascript" src="js/materialize.min.js"></script>
</body>
</html>
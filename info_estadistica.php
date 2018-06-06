<?php
	session_start();
	require 'conexion.php';
	require 'funcs.php';

	if(!isset($_SESSION["id_usuario"]))//Si no ha iniciado sesión redirecciona a index.php
	{ 
		header("Location: index.php");
	}
	
	/*$sql1 = "SELECT actividad.act_nom, persona_actividad.per_id_fk from actividad inner join persona_actividad on persona_actividad.act_id_fk=actividad.act_id";
	$resultado1 = $conexion->query($sql1);*/

	$sql1 = "SELECT actividad.act_id, persona_actividad.per_act_nom from actividad inner join persona_actividad on persona_actividad.act_id_fk=actividad.act_id";
	$resultado1 = $conexion->query($sql1);

	$sql2 = "SELECT persona.per_cod, persona.per_nom_com, persona_actividad.per_act_nom from persona inner join persona_actividad on persona_actividad.per_id_fk=persona.per_id";
	$resultado2 = $conexion->query($sql2);

	$consulta = "SELECT act_id, act_nom from actividad";
	$resultado3 = $conexion->query($consulta);
	$row3 = mysqli_fetch_array($resultado3);

	$contador_futbol = "";
	$contador_tennis = "";
	$contador_basquetball = "";
	$contador_volleyball = "";
	$total_personas ="";
	$total_actividades="";
	$deporte_mas_usado = "";

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
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
		<h3><a href="info_indicador.php">REGISTRAR NUEVAMENTE</a></h3>
	</div>
	<div class="container">
		<h4>Consulta de estadisticas por actividad</h4>
		<table class="striped responsive-table">
	        <thead>
	          <tr>
	              <th>id actividad</th>
	              <th>nombre actividad</th>
	          </tr>
	        </thead>
	        <tbody>
	        	<?php while ($row1 = mysqli_fetch_array($resultado1)) {?>
	          <tr>
				<?php
					$total_actividades++;
					if($row1['act_id'] == 1)
					{
						$contador_futbol++;		
					} 
					elseif($row1['act_id'] == 2)
					{
						$contador_tennis++;
					}
					elseif($row1['act_id'] == 3)
					{
					 	$contador_basquetball++;
					}
					else
					{
						$contador_volleyball++;
					}
				?>
	            <td><?php echo $row1['act_id']; ?></td>
	            <td><?php echo $row1['per_act_nom']; ?></td>
	          </tr>
	        	<?php } ?>
	        </tbody>
	    </table>
	    <div class="container left-align">
	    	
	    	<h5>El total de actividades de futbol es: <?php echo $contador_futbol."<br>" ?></h5>
	    	<h5>El total de actividades de tennis es: <?php echo $contador_tennis."<br>" ?></h5>
	    	<h5>El total de actividades de basquetball es: <?php echo $contador_basquetball."<br>" ?></h5>
	    	<h5>El total de actividades de volleyball es: <?php echo $contador_volleyball."<br>" ?></h5>
	    	<h4>El total de actividades es de: <?php echo $total_actividades."<br>" ?></h4>

	    	<?php 
	    		if ($contador_futbol > $contador_tennis && $contador_futbol > $contador_basquetball && $contador_futbol > $contador_volleyball)
	    		{
	    			$deporte_mas_usado = "Futbol";
	    		}
	    		elseif ($contador_tennis > $contador_futbol && $contador_tennis > $contador_basquetball && $contador_tennis > $contador_volleyball)
	    		{
	    			$deporte_mas_usado = "Tennis";
	    		}
	    		elseif ($contador_basquetball > $contador_futbol && $contador_basquetball > $contador_tennis && $contador_basquetball > $contador_volleyball)
	    		{
	    			$deporte_mas_usado = "Basquetball";
	    		}
	    		else
	    		{
	    			$deporte_mas_usado = "Volleball";
	    		}
	    	 ?>
	    	 <h4>El deporte más usado es: <?php echo $deporte_mas_usado."<br>" ?></h4>
	    </div>
      </div>
      <div class="container">
		<h4>Consulta de estadisticas por estudiantes</h4>
		<table class="striped responsive-table">
	        <thead>
	          <tr>
	              <th>Codigo estudiante</th>
	              <th>nombre completo</th>
	              <th>Nombre actividad</th>
	          </tr>
	        </thead>
	        <tbody>
	        	<?php while ($row2 = mysqli_fetch_array($resultado2)) {?>
	          <tr>
				<?php
					$total_personas++;
				?>
	            <td><?php echo $row2['per_cod']; ?></td>
	            <td><?php echo $row2['per_nom_com']; ?></td>
	            <td><?php echo $row2['per_act_nom']; ?></td>
	          </tr>
	        	<?php } ?>
	        </tbody>
	    </table>
	    <div class="container">
	    	<h4>El numero total de estudiantes que usaron los servicios son: <?php echo $total_personas."<br>" ?></h4>
	    </div>
      </div>
    

      <!--<div class="container">
		<h4>IDS ACTIVIDAD</h4>
		<table class="striped responsive-table">
	        <thead>
	          <tr>
	              <th>id</th>
	              <th>Nombre actividad</th>
	          </tr>
	        </thead>
	        <tbody>
	        	<?php while ($row3 = mysqli_fetch_array($resultado3)) {?>
	          <tr>

	            <td><?php echo $row3['act_id']; ?></td>
	            <td><?php echo $row3['act_nom']; ?></td>
	          </tr>
	        	<?php } ?>
	        </tbody>
	    </table>
      </div> -->

	<script type="text/javascript" src="js/materialize.min.js"></script>
</body>
</html>
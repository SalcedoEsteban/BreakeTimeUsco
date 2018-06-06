<?php
	$conexion = new mysqli('localhost', 'root', 'root123', 'indicadores');

	if ($conexion->connect_error)
	{
		die('Error en la conexion'.$conexion->connect_error);
	}

	printf("servidor indormacion: %s", $conexion->server_info);
?>
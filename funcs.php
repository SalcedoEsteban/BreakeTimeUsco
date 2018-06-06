<?php

	function isNull($nombre, $user, $pass, $pass_con, $email)
	{
		if (strlen(trim($nombre)) < 1 || strlen(trim($user)) < 1 || strlen(trim($pass)) < 1 || strlen(trim($pass_con)) < 1 || strlen(trim($email)) < 1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function isEmail($email)
	{
		if(filter_var($email, FILTER_VALIDATE_EMAIL))
		{
		return true;
		}
		else
		{
			return false;
		}
	}

	function validaPassword($var1, $var2)
	{
		if(strcmp($var1, $var2) !== 0)
		{
		return false;
		}
		else
		{
			return true;
		}
	}

	function validaIdToken($id, $token)
	{
		global $conexion;

		$stmt = $conexion->prepare("SELECT usu_act FROM usuario WHERE usu_id = ? AND usu_tok = ? LIMIT 1");
		$stmt->bind_param("is", $id, $token);
		$stmt->execute();
		$stmt->store_result();
		$rows = $stmt->num_rows;

		if ($rows > 0)
		{
			$stmt->bind_result($activacion);
			$stmt->fetch();

			if ($activacion == 1)
			{
				$msg = "La cuenta ya se activó anteriormente.";
			}
			else
			{
				if (activarUsuario($id))
				{
					$msg = 'Cuenta activada.';
				}
				else
				{
					$msg = 'Error al activar cuenta';
				}
			}
		}
		else
		{
			$msg = 'No existe el registro para activar';
		}

		return $msg;
	}

	function activarUsuario($id)
	{
		global $conexion;

		$stmt = $conexion->prepare("UPDATE usuario SET usu_act=1 WHERE usu_id = ?");
		$stmt->bind_param("s", $id);
		$result = $stmt->execute();
		$stmt->close();
		return $result;
	}

	function isNullLogin($usuario, $password)
	{
		if (strlen(trim($usuario)) < 1 || strlen(trim($password)) < 1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function login($usuario, $password)
	{
		global $conexion;

		$stmt = $conexion->prepare("SELECT usu_id, tip_usu_id2, usu_pas FROM usuario WHERE usu_usu = ? || usu_cor = ? LIMIT 1");
		$stmt->bind_param("ss", $usuario, $usuario);
		$stmt->execute();
		$stmt->store_result();
		$rows = $stmt->num_rows;

		if ($rows > 0)
		{
			if (isActivo($usuario))
			{
				$stmt->bind_result($id, $id_tipo, $passwd);
				$stmt->fetch();

				$validaPassw = password_verify($password, $passwd);

				if ($validaPassw)
				{
					lastSession($id);
					$_SESSION['id_usuario'] = $id;
					$_SESSION['tipo_usuario'] = $id_tipo;

					header("location: inicio.php");
				}
				else
				{
					$errors = "La contraseña es incorrecta";
				}
			}
			else
			{
				$errors = "el usuario no está activo";
			}
			
		}
		else
		{
			$errors = "El nombre de usuario o correo electronico no existe";
		}

		return $errors;
	}

	function lastSession($id)
	{
		global $conexion;

		$stmt = $conexion->prepare("UPDATE usuario SET usu_las_ses=NOW(), usu_tok_pas='', usu_pas_req=1 WHERE usu_id = ?");
		$stmt->bind_param("s", $id);
		$stmt->execute();
		$stmt->close();
	}

	function isActivo($usuario)
	{
		global $conexion;

		$stmt = $conexion->prepare("SELECT usu_act FROM usuario WHERE usu_usu = ? || usu_cor = ? LIMIT 1");
		$stmt->bind_param("ss", $usuario, $usuario);
		$stmt->execute();
		$stmt->bind_result($activacion);
		$stmt->fetch();

		if ($activacion == 1)
		{
			return true;	
		}
		else
		{
			return false;
		}
	}

	function minMax($min, $max, $valor)
	{
		if (strlen(trim($valor)) < $min)
		{
			return true;
		}
		elseif (strlen(trim($valor)) > $max)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function usuarioExiste($usuario)
	{
		global $conexion;

		$stmt = $conexion->prepare("SELECT usu_id FROM usuario WHERE usu_usu = ? LIMIT 1");
		$stmt->bind_param("s", $usuario);
		$stmt->execute();
		$stmt->store_result();
		$num = $stmt->num_rows;
		$stmt->close();

		if ($num > 0)
		{
			return true;
		}
		else
		{
			return false;
		}	
	}

	function emailExiste($email)
	{
		global $conexion;

		$stmt = $conexion->prepare("SELECT usu_id FROM usuario WHERE usu_cor = ? LIMIT 1");
		$stmt->bind_param("s", $email);
		$stmt->execute();
		$stmt->store_result();
		$num = $stmt->num_rows;
		$stmt->close();

		if ($num > 0)
		{
			return true;
		}
		else
		{
			return false;
		}	
	}

	function registraUsuario($usuario, $pass_hash, $nombre, $email, $activo, $token, $tipo_usuario)
	{
		global $conexion;
		$stmt = $conexion->prepare("INSERT INTO usuario(usu_usu, usu_pas, usu_nom, usu_cor, usu_act, usu_tok, tip_usu_id2) VALUES(?,?,?,?,?,?,?)");
		$stmt->bind_param('ssssisi', $usuario, $pass_hash, $nombre, $email, $activo, $token, $tipo_usuario);


		if($stmt->execute())
		{
			return $conexion->insert_id;
		}
		else
		{
			return 0;
		}
	}

	function generateToken()
	{
		$gen = md5(uniqid(mt_rand(), false));
		return $gen;
	}

	function hashPassword($password)
	{
		$hash = password_hash($password, PASSWORD_DEFAULT);
		return $hash;
	}

	function resultBlock($errors)
	{
		echo "<div id-'error' class-'alert-danger' role-'alert'>
		<a href='#' onclick=\"showHide('error');\">[X]</a>
		<ul>";
		foreach ($errors as $error)
		{
			echo "<li>".$error."</li>";
		}
		echo "</ul>";
		echo "</div>";
	}

	function enviarEmail($email, $nombre, $asunto, $cuerpo)
	{
		
		require 'PHPMailer/PHPMailerAutoload.php';
		
		$mail = new PHPMailer();
		$mail->isSMTP();
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = 'tls'; //Modificar
		$mail->Host = 'smtp.gmail.com'; //Modificar
		$mail->Port = '587'; //Modificar
		
		$mail->Username = 'estebansalcedoalvarez@gmail.com'; //Modificar
		$mail->Password = '862IXhuuN2nB'; //Modificar
		
		$mail->setFrom('estebansalcedoalvarez@gmail.com', 'Esteban, de USCO'); //Modificar
		$mail->addAddress($email, $nombre);
		
		$mail->Subject = $asunto;
		$mail->Body    = $cuerpo;
		$mail->IsHTML(true);
		
		if($mail->send())
		return true;
		else
		return false;

	}

<?php
	require('funciones/conexion.php');
	require('funciones/login.php');
	require('funciones/comprobarlogin.php');

	//array de secciones válidas
	$seccionesValidas = ['index', 'alta', 'consulta', 'mantenimiento'];
	
	//componente a cargar por defecto en la sección izquierda
	$seccion_izq = 'login'; 

	//comprobar si se ha conectado el usuario
	try {
		$usuario = comprobarLogin();
		//extraer el nombre y los apellidos del array
		extract($usuario);

		$seccion_izq = 'nav';

		//carga de la sección seleccionada si llega por la url y, en caso contrario, cargar la sección por defecto
		$seccion = $_GET['seccion'] ?? 'index';

		//validar que la sección que llega en la url sea una sección válida
		if (!in_array($seccion, $seccionesValidas)) {
			//$seccion = 'index';
			header("Location: hospital.php");
		}
		
	} catch (Exception $e) {
		$mensajes = $e->getMessage();

		//si el usuario no está conectado volver a cargar la sección de enlaces y la sección con la imagen del hospital
		$seccion_izq = 'login';
		$seccion = 'index';

		//borrar la variable de sesión
		unset($_SESSION['hospital']);
	}
	
	//añadir la operativa de comprobar login
	if (isset($_POST['login'])) {
		//recuperar nif y password del formulario
		$nif = addslashes(trim($_POST['usuario']));
		$password = addslashes(trim($_POST['password']));

		//operativa de login a partir del nif y el password
		try {
			login($nif, $password);

			//si el login es correcto cargar el componente con los enlaces de navegación y el componente de contenido que queramos mostrar por defecto
			$seccion_izq = 'nav';
		} catch (Exception $e) {
			$mensajes = $e->getMessage();
		}
	}

	//comprobar si llega el parámetro de desconexión
	if (isset($_GET['logoff'])) {
		//borrar la sesión o la cookie
		unset($_SESSION['hospital']);
		//volver a cargar la página
		header("Location: hospital.php");
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Hospital</title>
	<link rel="stylesheet" type="text/css" href="assets/css/hospital.css">
</head>
<body>
<div class="container">
	<header>
		<h1 id="title">HOSPITAL</h1>
	</header>

	<?php require("secciones/$seccion_izq.php");?>
	
	<section id='contenido'>
		<div>
			<?php require("secciones/$seccion.php"); ?>
		</div>
	</section>
</div>
</body>
</html>
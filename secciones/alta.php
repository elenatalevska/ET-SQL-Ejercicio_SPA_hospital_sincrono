	<?php
		require('funciones/validardatos.php');
		require('funciones/altapaciente.php');

		//comprobar se llega el formulario de alta
		if (isset($_POST['alta'])) {
			//recuperar los datos del formulario
			$nif 			= addslashes(trim($_POST['nif'] ?? null));
			$nombre 		= addslashes(trim($_POST['nombre'] ?? null));
			$apellidos		= addslashes(trim($_POST['apellidos'] ?? null));
			$fechaingreso	= addslashes(trim($_POST['fechaingreso'] ?? null));

			try {
				//validar los datos
				validarDatos($nif, $nombre, $apellidos, $fechaingreso);

				//alta de paciente en la bbdd
				altaPaciente($nif, $nombre, $apellidos, $fechaingreso);

				//mensaje de alta efectuada
				$mensajes = "Ingreso de paciente efectuado";

				//limpiar el formulario
				$nif = $nombre = $apellidos = $fechaingreso = null;
			} catch (Exception $e) {
				$mensajes = $e->getMessage();
			}
		}
	?>
	<h2>Ingreso de paciente</h2>
	<form id='formulario' action='#' method='post'>
		<label>NIF:</label>
		<input type="text" id="nif" name="nif" value='<?php echo $nif ?? null; ?>'>
		<br><br>
		<label>Nombre:</label>
		<input type="text" id="nombre" name="nombre" value='<?php echo $nombre ?? null; ?>'>
		<br><br>
		<label>Apellidos:</label>
		<input type="text" id="apellidos" name="apellidos" value='<?php echo $apellidos ?? null; ?>'>
		<br><br>
		<label>Fecha Ingreso:</label>
		<input type="date" id="fechaingreso" name="fechaingreso" value='<?php echo $fechaingreso ?? null; ?>'>
		<br><br>
		<input type="submit" id="alta" name="alta" value='Alta paciente'>
		<br><br>
		<span><?php echo $mensajes ?? null;?></span>
	</form>
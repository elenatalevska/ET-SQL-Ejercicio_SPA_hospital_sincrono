<?php 
	require('funciones/consultapaciente.php');
	require('funciones/validardatos.php');
	require('funciones/modificarpaciente.php');
	require('funciones/bajapaciente.php');
	
	//CONSULTA

	//recuperar el idpaciente de la url (GET) y validarlo (que llega informadado, tenga formato numérico sin decimnales y no sea menor que 0)
	$idpaciente = filter_input(INPUT_GET, 'idpaciente', FILTER_VALIDATE_INT);

	if (!$idpaciente || $idpaciente <= 0) {
		//volver a cargar el componente de consulta
		header("Location: ?seccion=consulta");
	}

	try {
		//realizar la consulta del paciente en la base de datos (utilizando una función)
		$paciente = consultaPaciente($idpaciente);
		/*			
		echo '<pre>';
		print_r($paciente);
		echo '</pre>';
		*/

		//extraer las claves asociativas del array pacientes para crear de forma automática todas las variables que necesitamos en el formulario
		extract($paciente);

	} catch (Exception $e) {
		$mensajes = $e->getMessage();
	}

	//MODIFICACION
	if (isset($_POST['modificacion'])) {
		try {
			//recuperar los datos del formulario
			$nif = addslashes(trim($_POST['nif']));
			$nombre = addslashes(trim($_POST['nombre']));
			$apellidos = addslashes(trim($_POST['apellidos']));
			$fechaingreso = addslashes(trim($_POST['fechaingreso']));
			$fechaalta = addslashes(trim($_POST['fechaalta']));

			//validar los datos
			validarDatos($nif, $nombre, $apellidos, $fechaingreso, $fechaalta);

			//realizar la modificación en la base de datos
			modificarPaciente($idpaciente, $nif, $nombre, $apellidos, $fechaingreso, $fechaalta);

			//mensaje de modificación efectuada
			$mensajes = 'Modificación efectuada';
		} catch (Exception $e) {
			$mensajes = $e->getMessage();
		}
	}

	//BAJA
	if (isset($_POST['baja'])) {
		try {
			//realizar la baja en la base de datos
			bajaPaciente($idpaciente);

			//mensaje de baja efectuada
			$mensajes = 'Baja efectuada';

			//limpiar el formulario
			$nif = $nombre = $apellidos = $fechaingreso = $fechaalta = null;

			//alternativa: volver a cargar el compnente de consulta
			header("Location: ?seccion=consulta");
		} catch (Exception $e) {
			$mensajes = $e->getMessage();
		}
	}
	
?>
<h2>Mantenimiento paciente</h2>
<form id='formulario' method='post' action='#'>
	<label>NIF:</label>
	<input type="text" name="nif" value="<?php echo $nif ?? null;?>">
	<!--button name='consultanif'>Consultar por nif</button-->
	<br><br>
	<label>Nombre:</label>
	<input type="text" name="nombre" value="<?php echo $nombre ?? null;?>">
	<br><br>
	<label>Apellidos:</label>
	<input type="text" name="apellidos" value="<?php echo $apellidos ?? null;?>">
	<br><br>
	<label>Fecha Ingreso:</label>
	<input type="date" name="fechaingreso" value="<?php echo $fechaingreso ?? null;?>">
	<br><br>
	<label>Fecha Alta Médica:</label>
	<input type="date" name="fechaalta" value="<?php echo $fechaalta ?? null;?>">
	<br><br>
	<input type="submit" name="modificacion" value='Modificar paciente' >
	<input type="submit" name="baja" value='Baja paciente' >
	<br><br>
	<span id='mensajes'><?php echo $mensajes ?? null;?></span>
</form>
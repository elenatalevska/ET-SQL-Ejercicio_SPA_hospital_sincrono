	<?php 
		//operativa a realizar cuando se carga el componente (sección): consulta de pacientes en la base de datos
		require('funciones/consultapacientes.php');
		$pacientes = [];
		$paginas = 0;

		//recuperar la página a consultar (por defecto será la página 1)
		//$pagina = $_GET['pagina'] ?? 1;
		$pagina = filter_input(INPUT_GET, 'pagina', FILTER_VALIDATE_INT);

		//validar que pagina llega informada, sea numérica sin decimales y que página sea mayor que 0
		if (!$pagina || $pagina <= 0) {$pagina = 1;}

		//realizar la consulta utilizando una función que recibirá como parámetro el número de página y nos entregará un array de dos elementos: array con todos los pacientes a mostrar y el número de páginas
		try {
			$datos = consultaPacientes($pagina);

			$pacientes 	= $datos[0];
			$paginas 	= $datos[1];

		} catch (Exception $e) {
			$mensajes = $e->getMessage();
		}

	?>
	<h2>Consulta de pacientes</h2>
	<table id='pacientes'>
		<tr><th>NIF</th><th>NOMBRE</th><th>APELLIDOS</th></tr>
		<?php 
			//confección dinámica de las filas de la tabla con todos los pacientes (foreach)
			foreach($pacientes as $paciente) {
				echo "<tr onclick='consultaPaciente($paciente[idpaciente])'>";
				echo "<td>$paciente[nif]</td>";
				echo "<td>$paciente[nombre]</td>";
				echo "<td>$paciente[apellidos]</td>";
				echo "</tr>";
			}
		?>
	</table><br><br>
	<span id='mensajes'><?php echo $mensajes ?? null;?></span>
	<p id='paginas'>
		<?php 
			//confección dinámica de los enlaces de paginación (for)
			for ($p = 1; $p <= $paginas; $p++) {
				if ($p == $pagina) {
					echo "<a class='seleccionado' href='?seccion=consulta&pagina=$p'>$p</a>";
				} else {
					echo "<a href='?seccion=consulta&pagina=$p'>$p</a>";
				}
			}
		?>
	</p>
	<script>
		function consultaPaciente(idpaciente) {
			//cargar la sección de mantenimiento pasando como parámetrp el id del paciente
			window.location.href = "?seccion=mantenimiento&idpaciente=" + idpaciente
		}
	</script>

<?php 

    function consultaPacientes($pagina) {
        //numero de pacientes a mostrar en cada página
        $pacientes_a_mostrar = 5;

        //calcular la fila inicial a mostrar en función de la página seleccionada por el usuario y el número de filas a mostrar
        $fila_inicial = ($pagina - 1) * $pacientes_a_mostrar;
       
        //incorporar fichero de conexión
        require('conexion.php');

        //confeccionar sentecia sql
        $sql = "SELECT idpaciente, nif, nombre, apellidos FROM paciente ORDER BY nombre, apellidos LIMIT $fila_inicial, $pacientes_a_mostrar";

        //trasladar la sentencia al SGBD
        if (!$consulta = mysqli_query($conexionHospital, $sql)) {
            throw new Exception(mysqli_error($conexionHospital));
        }

        //comprobar si la consulta nos devuelve alguna fila
        if ($consulta->num_rows == 0) {
            throw new Exception("No existen pacientes en la tabla");   
        }

        //extraer los datos de los pecientes del objeto de consulta en formato array escalar-asociativo
        $pacientes =  mysqli_fetch_all($consulta, MYSQLI_ASSOC);

        //OBTENER EL NÚMERO DE PÁGINAS A MOSTRAR

        $sql = "SELECT COUNT(*) AS contador FROM paciente"; 

        if (!$consulta = mysqli_query($conexionHospital, $sql)) {
            throw new Exception(mysqli_error($conexionHospital));
        }

        $contador_filas =  mysqli_fetch_assoc($consulta);

        //calcular el número de páginas
        $paginas = ceil($contador_filas['contador'] / $pacientes_a_mostrar);

        //retornar el array de pacientes y el número de páginas en formato array escalar
        return [$pacientes, $paginas];
       
    }
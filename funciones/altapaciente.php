<?php 

    function altaPaciente($nif, $nombre, $apellidos, $fechaingreso) {
        //incorporar el fichero de conexión
        require('conexion.php');

        //confeccionar la sentencia SQL
        $sql = "INSERT INTO paciente 
        VALUES(NULL, '$nif', '$nombre', '$apellidos', '$fechaingreso', NULL)";

        //trasladar la sentencia al SGBD y comprobar claves únicas duplicadas
        if (!mysqli_query($conexionHospital, $sql)) {
            //comprobar si el error se produce al intentar insertar una fila con una clave duplicada
            if (mysqli_errno($conexionHospital) == 1062) {
                throw new Exception("Este nif ya este en la base de datos");
            }

            //mostrar error genérico o literalmente el error que nos devuelva el SGBD
            //throw new Exception('Se ha producido un error al insertar el dato', 90);
            throw new Exception(mysqli_error($conexionHospital));
        }

    }
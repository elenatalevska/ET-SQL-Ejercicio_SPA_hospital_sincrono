<?php 

    function bajaPaciente($idpaciente) {
        //incorporar el fichero de conexión
        require('conexion.php');

        //confeccionar la sentencia SQL
        $sql = "DELETE FROM paciente WHERE idpaciente = $idpaciente";

        //trasladar la sentencia al SGBD
        if (!mysqli_query($conexionHospital, $sql)) {
            //mostrar error genérico o literalmente el error que nos devuelva el SGBD
            //throw new Exception('Se ha producido un error al insertar el dato', 90);
            throw new Exception(mysqli_error($conexionHospital));
        }

        //comprobar si se ha borrado la fila 
        if (mysqli_affected_rows($conexionHospital) == 0) {
            throw new Exception("Paciente no existe");
        }

    }
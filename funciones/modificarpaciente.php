<?php 

    function modificarPaciente($idpaciente, $nif, $nombre, $apellidos, $fechaingreso, $fechaalta) {
        //incorporar el fichero de conexión
        require('conexion.php');

        //Informar el valor NULL en la tabla paciente si la fecha de alta llega sin informar (if ternario)
        //$fechaalta = empty($fechaalta) ? 'NULL' : "'$fechaalta'";
        //                  'NULL'                  '2023-11-05'

        //misma operativa por con if tradicional
        if (empty($fechaalta)) {
            $fechaalta = 'NULL';
        } else {
            $fechaalta = "'$fechaalta'"; //'2023-05-11'
        }

        //confeccionar la sentencia SQL
        $sql = "UPDATE paciente SET nif ='$nif', nombre='$nombre', apellidos='$apellidos', fechaingreso='$fechaingreso', fechaalta=$fechaalta WHERE idpaciente=$idpaciente";

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

        //comprobar si se ha modificado la fila 
        if (mysqli_affected_rows($conexionHospital) == 0) {
            throw new Exception("No se han modificado datos o el paciente no existe");
        }

    }
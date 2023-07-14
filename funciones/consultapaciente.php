<?php 

    function consultaPaciente($idpaciente) {  
        //incorporar fichero de conexión
        require('conexion.php');

        //confeccionar sentecia sql
        $sql = "SELECT * FROM paciente WHERE idpaciente = $idpaciente";

        //trasladar la sentencia al SGBD
        if (!$consulta = mysqli_query($conexionHospital, $sql)) {
            throw new Exception(mysqli_error($conexionHospital));
        }

        //comprobar si la consulta nos devuelve alguna fila
        if ($consulta->num_rows == 0) {
            throw new Exception("Paciente no existe o se ha borrado");   
        }

        //extraer los datos del peciente del objeto de consulta en formato array escalar-asociativo
        return  mysqli_fetch_assoc($consulta);
    }

?>
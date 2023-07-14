<?php 
    function comprobarLogin() {
        //comprobar si el usuario ha realizado el proceso de login (1. comprobar si existe la sesión o la cookie)
        if (!isset($_SESSION['hospital'])) {
            throw new Exception ('Usuario no conectado');
        }
        
        //comprobar si el usuario ha realizado el proceso de login (2, comprobar si el id del usuario existe en la BD)
        global $conexionHospital;

        //extraer el id de usuario de la sesión o la cookie      
        $idusuario = $_SESSION['hospital'];

        //confeccionar la sentencia sql
        $sql = "SELECT nombre AS nombre_usuario, apellidos AS apellidos_usuario FROM usuarios WHERE idusuario = $idusuario";

        if (!$consulta = mysqli_query($conexionHospital, $sql)) {
            throw new Exception(mysqli_error($conexionHospital));
        }

        //comprobar si nos devuelve alguna fila
        if ($consulta->num_rows == 0) {
           throw new Exception("Usuario no conectado");
        }

        //recuperar los datos del usuario conectado
        return mysqli_fetch_assoc($consulta);

    }
?>
<?php 
    session_start();

    function login($nif_formulario, $password_formulario) {
        //incorporar la variable de conexión
        global $conexionHospital;

        //validar que lleguen informados
        if (empty($nif_formulario) || empty($password_formulario)) {
            throw new Exception("Nif y password son obligatorios");
        }

		//acceder a la tabla usuarios para comprobar si el nif existe
        $sql = "SELECT idusuario, nif, password FROM usuarios WHERE nif = '$nif_formulario'";

        if (!$consulta = mysqli_query($conexionHospital, $sql)) {
            throw new Exception(mysqli_error($conexionHospital));
        }

        //Comprobar si la consulta nos devuelve una fila
        if ($consulta->num_rows == 0) {
            throw new Exception("Credenciales incorrectas");
        }

        //validar que la contraseña del formulario coincide con la contraseña de la BD
       
        $usuario = mysqli_fetch_assoc($consulta);

        if ($password_formulario != $usuario['password']) {
            throw new Exception("Credenciales incorrectas");
        }

        //guardar el identificador del usuario conectado (la PK idusuario) en una variable de sesion o en una cookie
        $_SESSION['hospital'] = $usuario['idusuario'];
    }
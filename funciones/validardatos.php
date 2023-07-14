<?php 
    function validarDatos($nif, $nombre, $apellidos, $fechaingreso, $fechaalta = null) {
        //validar todos los errores a la vez para mostrar un único mensaje
        $errores = '';

        if (empty($nif)) {
            $errores .= "Nif obligatorio<br>";
        }

        if (empty($nombre)) {
            $errores .= "Nombre obligatorio<br>";
        }

        if (empty($apellidos)) {
            $errores .= "Apellidos obligatorios<br>";
        }

        if (empty($fechaingreso)) {
            $errores .= "Fecha ingreso obligatoria<br>";
        }

        //lanzar la excepción si la variable errores no está vacia
        try {
            if (!empty($errores)) {
                throw new Exception($errores);
            }
            
            //validar fecha ingreso válida (mes, dia, año)
            //formato fechas formulario: aaaa-mm-dd;
            $mes = substr($fechaingreso, 5, 2); //mm
            $dia = substr($fechaingreso, 8, 2); //dd
            $anio = substr($fechaingreso, 0, 4); //aaaa

            if (!checkdate($mes, $dia, $anio)) {
                throw new Exception("Fecha ingreso no válida");
            }

            //validar fecha de alta pero solo si llega informada
            if (!empty($fechaalta)) {
                $mes = substr($fechaalta, 5, 2); //mm
                $dia = substr($fechaalta, 8, 2); //dd
                $anio = substr($fechaalta, 0, 4); //aaaa

                if (!checkdate($mes, $dia, $anio)) {
                    throw new Exception("Fecha alta médica no válida");
                }
            }
            
        } catch (Exception $e) {
            $mensaje = "Se han producido los siguientes errores:<br><br>".$e->getMessage();
            //relanzar una excepción con información adicional sobre los errores de validación
            throw new Exception($mensaje);
        }
    }
?>
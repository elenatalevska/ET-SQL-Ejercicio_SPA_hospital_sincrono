<?php 
    //desactivar las excepciones de la instrucción mysqli_query
    mysqli_report(MYSQLI_REPORT_STRICT);

    //servidor, usuario, password, base de datos  
    if (!$conexionHospital = mysqli_connect('localhost', 'root', '', 'hospital')) {  
        throw new Exception("Error de conexión a la base de datos", 99);  
    }  
    
    //forzar a la conexión que utilice la codificación utf8
    mysqli_set_charset($conexionHospital, "utf8");

?>
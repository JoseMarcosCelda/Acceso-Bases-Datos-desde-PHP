<?php
    // Incluir archivo cabecera.php
    include 'cabecera.php';
    
    // Crear conexión
    $conn = mysqli_connect($servidor, $userBD, $passwdBD);

    // Verificar conexión
    if (!$conn) {
        die("Error conexión: " . mysqli_connect_error());
    }
    //    echo "Conexión establecida";

    // Seleccion de Base Datos
    mysqli_select_db($conn, $nomBD);
    
    // Obtener datos del formulario de consulta
    function recuperar() {
        $usuario = $_POST["usuario"];
        $clave = $_POST["clave"];
        return [$usuario, $clave];
    }
    // Llamada a la funcion recuperar y almacenar resultados en una variable  
    $valores = recuperar();
    $usuario = $valores[0];
    $clave = $valores[1];
    // print ("USUARIO: $usuario CLAVE: $clave");
    
    // Creacion de la consulta 
    $consulta = sprintf('SELECT * FROM usuarios WHERE nombre="%s" and clave="%s"', $usuario, $clave);
    // print ("<p>Valor consulta es: $consulta</p>");

    // Enviar la consulta a la base de datos
    $resultado = mysqli_query($conn, $consulta);
    
    // Verificar que la consulta es correcta
    if (mysqli_num_rows($resultado) > 0) {
        print("El usuario: $usuario con Clave: $clave ya está registrado");
    }
    else {
        print("El usuario: $usuario con Clave: $clave NO ESTA REGISTRADO");
    }

    // Cierre de la conexion de la base de datos
    mysqli_close($conn);
        // echo "Conexión cerrada";
?> 
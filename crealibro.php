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
        $nombre = $_POST["nombre"];
        $autor = $_POST["autor"];
        $isbn = $_POST["isbn"];
        $puntuacion = $_POST["puntuacion"];
        $genero = $_POST["genero"];
        return [$nombre, $autor, $isbn, $puntuacion, $genero];
    }
    // Llamada a la funcion recuperar y almacenar resultados en una variable  
    $valores = recuperar();
    $nombre = $valores[0];
    $autor = $valores[1];
    $isbn = $valores[2]; 
    $puntuacion = $valores[3];
    $genero = $valores[4];

    // print ("Nombre: $nombre CLAVE: $autor ISBN: $isbn PUNTUACION: $puntuacion GENERO: $genero");
    
    // Creacion de la consulta 
    $consulta = sprintf('SELECT * FROM libros WHERE isbn="%s"', $isbn);
    // print ("<p>Valor consulta es: $consulta</p>");

    // Enviar la consulta a la base de datos
    $resultado = mysqli_query($conn, $consulta);
    
    // Verificar que la consulta es correcta
    if (mysqli_num_rows($resultado) > 0) {
        print("El libro: $nombre con ISBN: $isbn ya está registrado");
    }
    else {
        $sql = "INSERT INTO libros (nombre, autor, isbn, puntuacion, genero)
        VALUES ('$nombre', '$autor', '$isbn', '$puntuacion', '$genero')";    
    }
    if (mysqli_query($conn, $sql)) {
        echo "Registro nuevo libro realizado";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Cierre de la conexion de la base de datos
    mysqli_close($conn);
        // echo "Conexión cerrada";
?> 
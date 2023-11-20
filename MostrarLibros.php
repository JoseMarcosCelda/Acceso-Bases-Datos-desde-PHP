<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar Libros</title>
</head>

<body>

    <!-- Inicializar variables -->
    <?php
        $resultado=0;
        $resultadotabla=0;
    ?>

    <h1>Mostrar Libros</h1>
        <form action="" method="post">
        
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre">
        
        <label for="autor">Autor:</label>
        <input type="text" id="autor" name="autor">
        
        <label for="isbn">ISBN:</label>
        <input type="text" id="isbn" name="isbn">

        <label for="puntuacion">Puntuacion:<no/label>
        <input type="number" id="puntuacion" name="puntuacion" required>

        <label for="genero">Genero:</label>
        <input type="text" id="genero" name="genero">

        <button type="submit">Enviar</button>
        </form>
    <br>
    <br>

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
    $consulta = sprintf('SELECT * FROM libros WHERE puntuacion="%s"', $puntuacion);
    $consultatabla = sprintf('SELECT * FROM libros');
    // print ("<p>Valor consulta es: $consulta</p>");

    // Enviar la consulta a la base de datos
    $resultado = mysqli_query($conn, $consulta);
    $resultadotabla = mysqli_query($conn, $consultatabla);
    
    // Verificar que la consulta es correcta
    if (mysqli_num_rows($resultado) > 0) {
        echo "<table>";
        while($row = mysqli_fetch_assoc($resultado)) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td style='width: 55px;'>" . "</td>";
            echo "<td>" . $row["nombre"] . "</td>";
            echo "<td style='width: 130px;'>" . "</td>";
            echo "<td>" . $row["autor"] . "</td>";
            echo "<td style='width: 110px;'>" . "</td>";
            echo "<td>" . $row["isbn"] . "</td>";
            echo "<td style='width: 250px;'>" . "</td>";
            echo "<td>" . $row["puntuacion"] . "</td>";
            echo "<td style='width: 170px;'>" . "</td>";
            echo "<td>" . $row["genero"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<table>";
        while($row = mysqli_fetch_assoc($resultadotabla)) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td style='width: 55px;'>" . "</td>";
            echo "<td>" . $row["nombre"] . "</td>";
            echo "<td style='width: 130px;'>" . "</td>";
            echo "<td>" . $row["autor"] . "</td>";
            echo "<td style='width: 110px;'>" . "</td>";
            echo "<td>" . $row["isbn"] . "</td>";
            echo "<td style='width: 250px;'>" . "</td>";
            echo "<td>" . $row["puntuacion"] . "</td>";
            echo "<td style='width: 170px;'>" . "</td>";
            echo "<td>" . $row["genero"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";    
    }

    // Cierre de la conexion de la base de datos
    mysqli_close($conn);
        // echo "Conexión cerrada";
    ?> 
</body>
</html>
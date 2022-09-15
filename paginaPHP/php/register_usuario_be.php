<?php

    include 'conexion_be.php';

    $nombre_completo = $_POST["nombre_completo"];
    $user = $_POST["usuario"];
    $pass = $_POST["contrasena"];
    $correo = $_POST["correo"];
    //Encriptamiento de contraseña
    $pass = hash('sha512', $pass);

    $query = "INSERT INTO usuarios(nombre_completo,user,pass,email)
              VALUES('$nombre_completo','$user','$pass','$correo')";
    //Verificar que el usuario no se repita en la base de datos
    $verificar_user = mysqli_query($conexion,"SELECT * FROM usuarios WHERE user = '$user'");

    if(mysqli_num_rows($verificar_user) > 0){
        echo '
            <script>
                alert("Este usuario ya esta registrado, intenta con otro diferente");
                window.location = "../login-register.php";
            </script>
        ';
        exit();
        mysqli_close($conexion);
    }
    //Verificar que el correo no se repita en la base de datos
    $verificar_email = mysqli_query($conexion,"SELECT * FROM usuarios WHERE email = '$correo'");

    if(mysqli_num_rows($verificar_email) > 0){
        echo '
            <script>
                alert("Este correo ya esta registrado, intenta con otro diferente");
                window.location = "../login-register.php";
            </script>
        ';
        exit();
        mysqli_close($conexion);
    }


    $ejecutar = mysqli_query($conexion, $query);

    if ($ejecutar){
        echo '
            <script>
                alert("Usuario almacenado exitosamente");
                window.location = "../index.php";
            </script>
        ';
    }else{'
        <script>
        alert("Usuario no almacenado intentalo de nuevo");
        window.location = "../login-register.php";
    </script>';
    }

    mysqli_close($conexion);


?>
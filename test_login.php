<?php
require_once "funciones.php";

$usuario = "Daniel";
$password = "Daniel145";

$resultado = iniciarSesion($usuario, $password);

if ($resultado) {
    echo "✅ Login exitoso. Bienvenido: " . $resultado->usuario;
} else {
    echo "❌ Usuario o contraseña incorrectos.<br>";

    // DEBUG: Revisar si existe el usuario
    $ver = select("SELECT * FROM usuarios WHERE usuario = ?", [$usuario]);
    if (!$ver) {
        echo "🛑 El usuario no existe en la base de datos.<br>";
    } else {
        echo "✅ Usuario encontrado.<br>";
        $hash = $ver[0]->password;
        echo "Hash guardado en BD: <code>$hash</code><br>";

        $verifica = password_verify($password, $hash);
        echo "¿Verifica el password?: " . ($verifica ? "Sí" : "No") . "<br>";
    }
}

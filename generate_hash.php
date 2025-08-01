<?php
$password = "Daniel145";
$hash = password_hash($password, PASSWORD_DEFAULT);
echo "Hash generado: <br><code>$hash</code>";

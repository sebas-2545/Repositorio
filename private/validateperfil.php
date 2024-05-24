<?php

    $roles_permitidos=['Administrador','Coordinador','Instructor'];
    
    if (!array_key_exists('rol', $_SESSION) || !in_array($_SESSION['rol'],$roles_permitidos)){
        session_destroy();
        header("Location:../loginphp/index.php");
    }

?>
<?php

session_start();
session_destroy();
header("Location:../loginphp/index.php");
?>
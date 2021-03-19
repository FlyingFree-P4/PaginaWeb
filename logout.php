<?php
// Inicia la sessió
session_start();
 
// Desactiva totes les variables de la sessió
$_SESSION = array();
 
// Destrueix la sessió.
session_destroy();
 
// Portar a la pàgina del login
header("location: login.php");
exit;
?>
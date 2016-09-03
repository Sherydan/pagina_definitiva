<?php
if(empty($_SESSION['SES_ADMIN'])) {
	echo "<center>";
	echo "<br> <br> <b>Lo Sentimos Tu Sesion Caduco, No Tienes Acceso!</b> <br>
		 Por favor, introduzca sus datos de acceso correctamente para poder acceder a esta página.";
	echo "</center>";
	include_once "login.php";
	exit;
}
?>
<?php
if(! empty($_SESSION['SES_ADMIN'])) {
	echo "<h2 style='margin:-5px 0px 5px 0px; padding:0px;'>BIENVENIDO........!</h2></p>";
	echo "<b> Ha iniciado sesion como Administrador";
	exit;
}
else {
	echo "<h2 style='margin:-5px 0px 5px 0px; padding:0px;'>BIENVENIDO..!</h2></p>";
	echo "<b> Por favor <a href='?open=Login' alt='Iniciar Sesion'>Iniciar Sesion </a>para acceder a esta seccion ";	
}

?>
<?php
$my['host']	= "localhost";
$my['user']	= "root";
$my['pass']	= "";
$my['dbs']	= "radjabangunandb";

$koneksidb	= mysql_connect($my['host'], $my['user'], $my['pass']);
if (! $koneksidb) {
  echo "Fallo en la Conexion !";
}
// memilih database pda server
mysql_select_db($my['dbs'])
	 or die ("Base de Datos no encontrada, porfavor ponganse en contacto con el administrador del sistema!");
?>
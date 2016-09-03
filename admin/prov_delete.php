<?php
/**
 * Created by PhpStorm.
 * User: herry.prasetyo
 * Date: 4/27/2016
 * Time: 9:18 AM
 */
#validasi halaman harus melakukan login terlebih dahulu
include_once "../library/inc.sesadmin.php";
//PERIKSA data kode pada URL
if (empty($_GET['Kode'])) {
	echo "<b>No hay Datos para Eliminar</b>";
}
else
{
	$Kode 	= $_GET['Kode'];
	$mySql  = "DELETE FROM prov WHERE id_prov= '$Kode'";
	$myQry = mysql_query($mySql, $koneksidb) or die("Error hapus data".mysql_error());
	if ($myQry) {
		echo "<meta http-equiv='refresh' content='0; url=?open=Prov-Data'>";
	}
}
?>

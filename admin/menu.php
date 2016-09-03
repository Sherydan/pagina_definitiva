<?php
# JIKA DIKENALI YANG LOGIN ADMIN
if(isset($_SESSION['SES_ADMIN'])){
?>
	<ul>
	<li><a href='?open' title='Halaman Utama'>Inicio</a></li>
	<li><a href='?open=Password-Admin' title='Password Admin'>Cambiar Contrase&#241;a </a></li>
	<li><a href='?open=Prov-Data' title='Provinsi 2' target="_self">Departamento</li>
	<!--<li><a href='?open=Provinsi-Data' title='Provinsi' target="_self">Datos Provincia</a></li>-->
    <li><a href='?open=Kota-Data' title='Kota' target="_self">Ciudad/Provincia</a></li>
	<li><a href='?open=Kecamatan-Data' title='Kecamatan' target="_self">Distrito</a></li>
	<li><a href='?open=Kategori-Data' title='Kategori' target="_self">Categorias</a></li>
    <!--<li><a href="" title="Data-Perusahaan" target="_self">Datos de Empresa</a></li>-->
	<!--<li><a href="?open=Brand-Data" title="Brand" target="_self">Datos Marca</a></li>-->
	<!--<li><a href='?open=Tiki-Data' title='Data Tiki' target="_self"><b>Pedidos</b></a></li>-->
	<li><a href='?open=Barang-Data' title='Barang' target="_self">Productos</a></li>
	<li><a href='?open=Pelanggan-Data' title='Pelanggan' target="_self">Clientes</a></li>
	<li><a href='?open=Konfirmasi-Transfer' title='Konfirmasi Transfer' target="_self">Confirmar Transferencia</a></li>
	<li><a href='?open=Pemesanan-Barang' title='Pemesanan Barang' target="_self">Confirmar Pedidos</a></li>
	<li><a href='?open=Laporan' title='Laporan' target="_self">Informes</a></li>
	<li><a href='?open=Logout' title='Logout (Exit)'>Cerrar Sesion</a></li>
	</ul>
<?php
}
else {

// JIKA BELUM ADA YANG LOGIN
?>
	<ul>
	<li><a href='?open=Login' title='Login' target="_self">Iniciar Sesi&#243;n</a></li>
	</ul>
<?php } ?>
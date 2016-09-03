<?php
include_once "../library/inc.sesadmin.php";   // Validasi, mengakses halaman harus Login
include_once "../library/inc.connection.php"; // Membuka koneksi
include_once "../library/inc.library.php";    // Membuka librari peringah fungsi

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$baris 	= 50;
$hal 	= isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM konfirmasi";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jumlah	 = mysql_num_rows($pageQry);
$maksData= ceil($jumlah/$baris);
?>
<h1><b>CONFIRMACION DE TRANSFERENCIA - CLIENTE</b></h1>
<table class="table-list" width="800" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <th width="26" align="center" bgcolor="#CCCCCC">Nro</th>
    <th width="100" align="center" bgcolor="#CCCCCC">Fecha</th>
    <th width="150" bgcolor="#CCCCCC">Nro.&nbsp;Transferencia </th>
    <th width="230" bgcolor="#CCCCCC">Nombre Cliente </th>    
    <th width="180" bgcolor="#CCCCCC">Cod. Transferencia</th>    
    <th width="130" bgcolor="#CCCCCC">Descripcion</th>    
    <td align="center" bgcolor="#CCCCCC"><strong>Herramientas</strong></td>  
  </tr>
	<?php
	// Menampilkan data Konfirmasi
	$mySql = "SELECT * FROM konfirmasi ORDER BY konfirmasi.id DESC LIMIT $hal, $baris";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $myData['id'];
	?>
  <tr>
    <td><?php echo $nomor; ?></td> 
    <td><?php echo IndonesiaTgl($myData['tanggal']); ?></td>
    <td><?php echo $myData['no_pemesanan']; ?></td>
    <td><?php echo $myData['nm_pelanggan']; ?></td>
    <td><?php echo format_angka($myData['jumlah_transfer']); ?></td>
    <td><?php echo $myData['keterangan']; ?></td>
    <td width="39" align="center"><a href="?open=Konfirmasi-Delete&Kode=<?php echo $Kode; ?>" target="_self" alt="Eliminar" onclick="return confirm('Seguro que va ELIMINAR ESTA CONFIRMACION ... ?')">Delete</a></td>
  </tr>
  <?php } ?>
  <tr>
    <td colspan="4" bgcolor="#CCCCCC"><b>Numero de Datos :</b> <?php echo $jumlah; ?> </td>
    <td colspan="3" align="right" bgcolor="#CCCCCC"><b>Pagina de</b>
      <?php
	for ($h = 1; $h <= $maksData; $h++) {
		$list[$h] = $baris * $h - $baris;
		echo " <a href='?open=Konfirmasi-Transfer&hal=$list[$h]'>$h</a> ";
	}
	?></td>
  </tr>
</table>

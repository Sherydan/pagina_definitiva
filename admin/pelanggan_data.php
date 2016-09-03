<?php
include_once "../library/inc.sesadmin.php";
include_once "../library/inc.library.php";

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$baris = 50;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM pelanggan";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jumlah	 = mysql_num_rows($pageQry);
$maksData= ceil($jumlah/$baris);

// Membaca data form cari
$dataCari	= isset($_POST['txtCari']) ? $_POST['txtCari'] : '';
?>
<table width="800" border="0" cellpadding="2" cellspacing="1" class="table-border">
  <tr>
    <td colspan="2" align="right"><h1><b>DATOS CLIENTE</b></h1></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="right">
	<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
      <b>Busqueda por Nombre :</b>
        <input name="txtCari" type="text" value="<?php echo $dataCari; ?>" size="40" maxlength="100" />
      <input name="btnCari" type="submit" value="Buscar" />
      </form></td>
  </tr>
  <tr>
    <td colspan="2">
	<table class="table-list" width="100%" border="0" cellspacing="1" cellpadding="2">
      <tr>
        <th width="25">Nro</th>
        <th width="66">Codigo</th>
        <th width="250">Nombre</th>
		<th width="250">Apellidos</th>
        <!--<th width="60">Sexo</th>-->
        <th width="143">Nro. Telefono</th>
		<th width="143">Nro. Celular</th>
        <th width="119">Usuario</th>
        <td align="center" bgcolor="#CCCCCC"><strong>Herramientas</strong><b></b></td>
        </tr>
      <?php
	# Jika tombol Cari/Search diklik, maka pencarian dilakukan
	if(isset($_POST['btnCari'])){
		$mySql = "SELECT * FROM pelanggan WHERE nm_pelanggan LIKE '%$dataCari%' ORDER BY kd_pelanggan DESC LIMIT $hal, $baris";
	}
	else {
		$mySql = "SELECT * FROM pelanggan ORDER BY kd_pelanggan DESC LIMIT $hal, $baris";
	} 
	
	// Menjalankan query di atas
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor  = $hal; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $myData['kd_pelanggan'];
	?>
      <tr>
        <td><?php echo $nomor; ?></td>
        <td><?php echo $myData['kd_pelanggan']; ?></td>
        <td><?php echo $myData['nm_pelanggan']; ?></td>
		<td><?php echo $myData['nm_belakang']; ?></td>
        <!--<td><?php //echo $myData['kelamin']; ?></td>-->
        <td><?php echo $myData['no_telepon']; ?></td>
		<td><?php echo $myData['mobile']; ?></td>
        <td><?php echo $myData['username']; ?></td>
        <td width="44" align="center"><a href="?open=Pelanggan-Delete&Kode=<?php echo $Kode; ?>" target="_self" alt="Eliminar Cliente" onclick="return confirm('Seguro que va a ELIMINAR ESTE CLIENTE ... ?')">Eliminar</a></td>
      </tr>
      <?php } ?>
    </table></td>
  </tr>
  <tr class="selKecil">
    <td><b>Numero de Datos :</b> <?php echo $jumlah; ?> </td>
    <td align="right"><b>Pagina de:</b> 
	<?php
	for ($h = 1; $h <= $maksData; $h++) {
		$list[$h] = $baris * $h - $baris;
		echo " <a href='?open=Pelanggan-Data&hal=$list[$h]'>$h</a> ";
	}
	?>
	</td>
  </tr>
</table>

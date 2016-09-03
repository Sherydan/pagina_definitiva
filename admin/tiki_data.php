<?php
// Validasi supaya yang mengakses hanya Admin (yang sudah login)
include_once "../library/inc.sesadmin.php";
include_once "../library/inc.connection.php";


$baris = 20;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM tiki";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jumlah  = mysql_num_rows($pageQry);
$maksData= ceil($jumlah/$baris);

?>
<table width="800" border="0" cellpadding="2" cellspacing="1" class="table-border">
  <tr>
    <td colspan="2" align="right"><h1>Lista de Pedidos </h1></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="right"><a href="?open=Tiki-Add" target="_self"><img src="../images/btn_add_data.png" border="0" /></a></td>
  </tr>
  
  <tr>
    <td colspan="2">
	<table class="table-list" width="100%" border="0" cellspacing="1" cellpadding="2">
      <tr>
        <th width="35" align="center" bgcolor="#CCCCCC">Nro</th>
        <th width="150"  bgcolor="#CCCCCC">Nombre de Ciudad</th>
        <th width="80"  bgcolor="#CCCCCC"> ONS / TDS</th>
        <th width="10"  bgcolor="#CCCCCC">REG</th>
        <th width="10" bgcolor="#CCCCCC">Eco</th>
        <th width="120" bgcolor="#CCCCCC">Administracion</th>
        <td colspan="2" align="center" bgcolor="#CCCCCC"><strong>Herramientas</strong></td>
      </tr>
	<?php
	$mySql = "SELECT * FROM tiki ORDER BY nm_kota ASC LIMIT $hal, $baris";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor  = $hal; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $myData['kd_kota'];
	?>
      <tr>
        <td align="center"><?php echo $nomor; ?></td>
        <td> <?php echo $myData['nm_kota']; ?></td>
        <td>Rp. <?php echo format_angka($myData['ons']); ?></td>
        <td>Rp. <?php echo format_angka($myData['reg']); ?></td>
        <td>Rp. <?php echo format_angka($myData['eco']); ?></td>
        <td>Rp. <?php echo format_angka($myData['administrasi']); ?></td>
        <td width="44" align="center"><a href="?open=Tiki-Edit&Kode=<?php echo $Kode; ?>" target="_self" alt="Edit Data">Editar</a></td>
        <td width="44" align="center"><a href="?open=Tiki-Delete&Kode=<?php echo $Kode; ?>" target="_self" alt="Delete Data" onclick="return confirm('Seguro que deseas eliminar esta CATEGORÍA ... ?')">Eliminar</a></td>
      </tr>
      <?php } ?>
    </table></td>
  </tr>
   <tr class="selKecil">
    <td width="407"><b>Numero de Datos :</b> <?php echo $jumlah; ?> </td>
    <td width="384" align="right"><b>Pagina de :</b>
      <?php
  for ($h = 1; $h <= $maksData; $h++) {
    $list[$h] = $baris * $h - $baris;
    echo " <a href='?open=Tiki-Data&hal=$list[$h]'>$h</a> ";
  }
  ?></td>
  </tr>
</table>

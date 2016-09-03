<?php
include_once ("../library/inc.sesadmin.php");
include_once ("../library/inc.library.php");

$SqlPeriode = ""; $awalTgl=""; $akhirTgl=""; $tglAwal=""; $tglAkhir="";

# Establecer Fecha skrg
$awalTgl 	= isset($_GET['awalTgl']) ? $_GET['awalTgl'] : "01-".date('m-Y');
$tglAwal 	= isset($_POST['txtTglAwal']) ? $_POST['txtTglAwal'] : $awalTgl ;

$akhirTgl 	= isset($_GET['akhirTgl']) ? $_GET['akhirTgl'] : date('d-m-Y'); 
$tglAkhir 	= isset($_POST['txtTglAkhir']) ? $_POST['txtTglAkhir'] : $akhirTgl;

# Si se hace clic en el botón Mostrar
if (isset($_POST['btnTampil'])) {
	$SqlPeriode = " tgl_pemesanan BETWEEN '".InggrisTgl($tglAwal)."' AND '".InggrisTgl($tglAkhir)."'";
}
else {
	$SqlPeriode = " tgl_pemesanan BETWEEN '".InggrisTgl($awalTgl)."' AND '".InggrisTgl($akhirTgl)."'";
}

# Para paginación (PÁGINA DE DISTRIBUCIÓN)
$baris = 50;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM pemesanan WHERE $SqlPeriode";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$maksData	 = ceil($jml/$baris); 
?>
<h1><b>CONFIRMAR LISTA DE PEDIDOS </b></h1>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
  <table width="550" border="0"  class="table-list">
    <tr>
      <td colspan="3" bgcolor="#CCCCCC"><b>FILTRAR DATOS</b></td>
    </tr>
    <tr>
      <td width="55"><b>Periodo </b></td>
      <td width="5"><b>:</b></td>
      <td width="426"><input name="txtTglAwal" type="text" class="tcal" value="<?php echo $tglAwal; ?>" /> 
        a 
          <input name="txtTglAkhir" type="text" class="tcal"  value="<?php echo $tglAkhir; ?>" />
      <input name="btnTampil" type="submit" value="Mostrar" /></td>
    </tr>
  </table>
</form>

<table width="850" border="0" cellpadding="2" cellspacing="1" class="table-list" >
  <tr>
    <th width="4%" align="center" bgcolor="#CCCCCC"><b>N&#176;</b></th>
    <th width="15%" bgcolor="#CCCCCC"><b>Nro Reserva </b></th>
    <th width="11%" bgcolor="#CCCCCC"><b>Fecha</b></th>
    <th width="19%" bgcolor="#CCCCCC"><strong>Nombre de Cliente</strong></th>
    <th width="18%" align="right" bgcolor="#CCCCCC"><b>Cod. Transferencia</b></th>
    <th width="10%" align="right" bgcolor="#CCCCCC"><strong>Estado </strong></th>
    <td width="23%" align="center" bgcolor="#CCCCCC"><b>Ajuste de Pago </b></td>
    <td align="center" bgcolor="#CCCCCC"><b>Herramientas</b></td>
  </tr>
  <?php
  // Deklrasi variabel angka
  $totalBayar = 0;
  $unikTransfer = 0;

  // Menampilkan daftar transaksi
  $mySql = "SELECT pemesanan.*, pelanggan.nm_pelanggan, prov.biaya_kirim
  			  FROM pelanggan, pemesanan, prov
			  WHERE pelanggan.kd_pelanggan=pemesanan.kd_pelanggan AND pemesanan.id_prov=prov.id_prov
			  AND $SqlPeriode ORDER BY RIGHT(pemesanan.no_pemesanan,5) DESC";
  $myQry = @mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
  $nomor = 0;
  while ($myData =mysql_fetch_array($myQry)) {
	  $nomor++;
	  $Kode = $myData['no_pemesanan'];
	  $digitHp 	= substr($myData['no_telepon'],-2); // ambil 3 digit no HP
	  
	  # CÁLCULO DE PAGO TOTAL NÚMERO TOTAL DE MERCANCÍAS con comandos SQL
	  $my2Sql	= "SELECT SUM(harga * jumlah) As total_bayar,
	  				SUM(jumlah) As total_barang FROM pemesanan_item WHERE no_pemesanan='$Kode'";
	  $my2Qry 	= @mysql_query($my2Sql, $koneksidb) or die ("Gagal query".mysql_error());
	  $my2Data 	= mysql_fetch_array($my2Qry);
		
		// Menghitung Total Bayar dari harga setelah diskon, dikali jumlah barang
		$totalBayar = $my2Data['total_bayar'] + ($myData['biaya_kirim'] * $my2Data['total_barang']);
		//$unikTransfer = substr($totalBayar,0,-3).$digitHp;
		$unikTransfer = $totalBayar + $digitHp;
  ?>
  <tr>
    <td align="center"><?php echo $nomor; ?></td>
    <td><?php echo $myData['no_pemesanan']; ?></td>
    <td><?php echo IndonesiaTgl($myData['tgl_pemesanan']); ?></td>
    <td><?php echo $myData['nm_pelanggan']; ?></td>
    <td align="right"><b><?php echo format_angka($unikTransfer); ?></b></td>
    <td align="right" bgcolor="#FFFF66"><?php echo $myData['status_bayar']; ?></td>
    <td align="center">
	<?php if($myData['status_bayar']=="Pendiente") { ?> 
	  <a href="?open=Pemesanan-Bayar&Aksi=Completo&Kode=<?php echo $myData['no_pemesanan']; ?>" class='button orange small' target="_blank"> <strong>Pagar </strong></a>
	  <?php } else { ?> 
	  <a href="?open=Pemesanan-Bayar&Aksi=Pendiente&Kode=<?php echo $myData['no_pemesanan']; ?>" class='button red small'  target="_blank"> <strong>Cancelar</strong></a>
	  <?php } ?>	  </td>
    <td width="9%" align="center"><a href="pemesanan_lihat.php?Kode=<?php echo $Kode; ?>" target="_blank" class='button white small'>VER</a> </td>
  </tr>
  <?php } ?>
</table>

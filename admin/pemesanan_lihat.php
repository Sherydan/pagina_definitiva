<?php
session_start();
include_once "../library/inc.sesadmin.php";   // Validasi halaman harus Login
include_once "../library/inc.connection.php"; // Membuka koneksi
include_once "../library/inc.library.php";    // Membuka librari peringah fungsi

if(isset($_GET['Kode'])) {
	// Membaca Kode dari URL
	$Kode	= $_GET['Kode'];
	
	// Query membaca data Utama Pemesanan 
	$mySql = "SELECT pemesanan.*, pelanggan.nm_pelanggan, prov.*
			FROM pemesanan, pelanggan, prov
			WHERE pemesanan.kd_pelanggan=pelanggan.kd_pelanggan AND pemesanan.id_prov=prov.id_prov
			AND pemesanan.no_pemesanan ='$Kode'";
	$myQry = mysql_query($mySql, $koneksidb) or die ("Gagal query");
	$myData = mysql_fetch_array($myQry);
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>DETALLES PRODUCTO EN RESERVA</title>
<link href="../style/styles_cetak.css" rel="stylesheet" type="text/css">
<link href="../style/button.css" rel="stylesheet" type="text/css">
</head>
<body>
<h1>Orden de Transacciones </h1>
<table width="550" border="0" cellspacing="2" cellpadding="3">
  <tr>
    <td bgcolor="#CCCCCC"><strong>OPERACIONES</strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="31%"><b>Nro. Reserva</b></td>
    <td width="2%">:</td>
    <td width="67%"><?php echo $myData['no_pemesanan']; ?></td>
  </tr>
  <tr>
    <td><b>Fecha</b></td>
    <td>:</td>
    <td><?php echo IndonesiaTgl($myData['tgl_pemesanan']); ?></td>
  </tr>
  <tr>
    <td><b>Codigo Cliente</b></td>
    <td>:</td>
    <td><?php echo $myData['kd_pelanggan']; ?></td>
  </tr>
  <tr>
    <td><b>Nombre Cliente</b></td>
    <td>:</td>
    <td><?php echo $myData['nm_pelanggan']; ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><strong>RECEPTOR</strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><b>Nombre Beneficiario</b></td>
    <td>:</td>
    <td><?php echo $myData['nama_penerima']; ?></td>
  </tr>
  <tr>
    <td><b>Direccion Destino</b></td>
    <td>:</td>
    <td><?php echo $myData['alamat_lengkap']; ?></td>
  </tr>
  <tr>
    <td><strong>Provincia</strong></td>
    <td>:</td>
    <td><?php echo $myData['nama_prov'];  ?></td>
  </tr>
  <tr>
    <td><b>Nro. Telefono</b></td>
    <td>:</td>
    <td><?php echo $myData['no_telepon'];  ?></td>
  </tr>
  <tr>
    <td><b>Codigo Unico de Transferencia</b></td>
    <td>:</td>
    <td><?php echo substr($myData['no_telepon'],-3); ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#FFFF99"><b>Estado de Pago </b></td>
    <td>:</td>
    <td><?php echo $myData['status_bayar']; ?> * </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<h2>LISTA DE PEDIDO DE PRODUCTOS</h2>
<table width="800" border="0" cellpadding="2" cellspacing="0" class="table-list">
  <tr>
    <td width="30" align="center" bgcolor="#CCCCCC"><strong>Nro</strong></td>
    <td width="74" bgcolor="#CCCCCC"><strong>Codigo</strong></td>
    <td width="404" height="22" bgcolor="#CCCCCC"><b>Nombre de Productos</b></td>
    <td width="111" align="right" bgcolor="#CCCCCC"><b><b>Precio (S/.)</b></b></td>
    <td width="54" align="center" bgcolor="#CCCCCC"><b>Cantidad</b></td>
    <td width="103" align="right" bgcolor="#CCCCCC"><b>Total (S/.)</b></td>
  </tr>
  <?php 
	  // Deklarasi variabel
	  $subTotal		= 0;
	  $totalBarang 	= 0;
	  $totalBiayaKirim = 0;
	  $totalHarga 	= 0;
	  $totalBayar 	= 0;
	  $unik_transfer = 0;
	  
	// SQL Menampilkan data Barang yang dipesan
	$tampilSql = "SELECT barang.nm_barang, pemesanan_item.*
				FROM pemesanan, pemesanan_item
				LEFT JOIN barang ON pemesanan_item.kd_barang=barang.kd_barang
				WHERE pemesanan.no_pemesanan=pemesanan_item.no_pemesanan
				AND pemesanan.no_pemesanan='$Kode'
				ORDER BY pemesanan_item.kd_barang";
	$tampilQry = mysql_query($tampilSql, $koneksidb) or die ("Gagal SQL".mysql_error()); 
	$total = 0;
	$nomor = 0;
	while ($tampilData = mysql_fetch_array($tampilQry)) {
	  $nomor++;
	  // Menghitung harga bersih
	  $subTotal		= $tampilData['harga'] * $tampilData['jumlah']; 
	  
	  // Menghitung total harga semua barang
	  $totalHarga 	= $totalHarga + $subTotal;  
	  
	  // Menghitung total barang
	  $totalBarang	= $totalBarang + $tampilData['jumlah']; 
  ?>
  <tr>
    <td align="center"><?php echo $nomor; ?></td>
    <td><?php echo $tampilData['kd_barang']; ?></td>
    <td><?php echo $tampilData['nm_barang']; ?></td>
    <td align="right">S/. <?php echo $tampilData['harga']; ?></td>
    <td align="center"><?php echo $tampilData['jumlah']; ?></td>
    <td align="right">S/.<?php echo format_angka($subTotal); ?></td>
  </tr>
  <?php
	}
  	# SKRIP REKAP DATA
	// Total biaya Kirim = Biaya kirim x Total barang
	
	$totalBiayaKirim = $myData['biaya_kirim'] * $totalBarang;
	
	// Menghitung total bayar
	$totalBayar = $totalHarga + $totalBiayaKirim;  
	
	// ambil 3 digit terakhir no HP
	$digitHp 	= substr($myData['no_telepon'],-2); 
	
	// Membuat unik transfer
	$unik_transfer = $totalBayar + $digitHp;
	?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5" align="right" bgcolor="#F5F5F5"><strong>Total (S/.) : </strong></td>
    <td align="right" bgcolor="#F5F5F5"><?php echo format_angka($totalHarga); ?></td>
  </tr>
  <tr>
    <td colspan="5" align="right"><strong>Gasto de Envio  (S/.) : </strong></td>
    <td align="right"><?php echo format_angka($totalBiayaKirim); ?></td>
  </tr>
  <tr>
    <td colspan="5" align="right" bgcolor="#F5F5F5"><strong>TOTAL  (S/.) : </strong></td>
    <td align="right" bgcolor="#F5F5F5"><?php echo format_angka($totalBayar); ?></td>
  </tr>
  <tr>
    <td colspan="6" align="right">Codigo Transferencia<b>:<?php echo format_angka($unik_transfer); ?></b> </td>
  </tr>
  <tr>
    <td colspan="6" align="right">
	<?php if($myData['status_bayar']=="Pendiente") { ?>
        <a href="index.php?open=Pemesanan-Bayar&Aksi=Completo&Kode=<?php echo $myData['no_pemesanan']; ?>" class='button orange small'> <strong>PAGAR</strong></a>
        <?php } else { ?>
        <a href="index.php?open=Pemesanan-Bayar&Aksi=Pendiente&Kode=<?php echo $myData['no_pemesanan']; ?>" class='button red small'> <strong>CANCELAR</strong></a>
    <?php } ?>    </td>
  </tr>
</table>
<?php
} 
else {
	// Kode tidak terbaca
	echo "<meta http-equiv='refresh' content='0; url=?open=Transaksi-Tampil'>";
}
?>
<p><b>* Observaciones de Pago :</b></p>
<ul>
  <li><b>Pendiente :</b> Todavia en la reserva (se puede cancelar), o <strong>Modificar</strong>.</li>
  <li><b>Completado:</b> Orden ya pagada y <strong>en proceso de Entrega</strong>.</li>
  <li><b>Nulo      :</b> Reservas Canceladas.     </li>
</ul>
</body>
</html>

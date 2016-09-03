<?php
/**
 * Created by PhpStorm.
 * User: Gorqui Ramiro Chavez
 * Date: 22/01/2016
 * Time: 9:05 AM
 */
include_once "../library/inc.sesadmin.php";

# MEMBACA TOMBOL SIMPAN DIKLIK
if(isset($_POST['btnSimpan'])){
	# Baca Variabel
	$txtNama=$_POST['txtNama'];
	$txtNama= str_replace("'","&acute;",$txtNama);
	
	$txtBiaya	=$_POST['txtBiaya'];
	$txtBiaya 	= str_replace("'","&acute;",$txtBiaya);

	// Validasi form
	$pesanError = array();
	if (trim($txtNama)=="") {
		$pesanError[] = "Datos <b>Nombre Departamento</b> Incorrecto!";		
	}
	if (trim($txtBiaya)=="" or ! is_numeric(trim($txtBiaya))) {
		$pesanError[] = "Data <b>Biaya Kirim (Rp)</b> tidak boleh kosong, dan harus diisi angka !";		
	}
		

	// Validasi Nama Provinsi, tidak boleh ada yang kembar (namanya sama)
	$txtNamaLama	= $_POST['txtNamaLama'];
	$cekSql	= "SELECT * FROM prov WHERE nama_prov='$txtNama' AND NOT(nama_prov='$txtNamaLama')";
	$cekQry	= mysql_query($cekSql, $koneksidb) or die ("Eror Query".mysql_error()); 
	if(mysql_num_rows($cekQry)>=1){
		$pesanError[] = "Maaf, Provinsi <b> $txtNama </b> sudah ada, ganti dengan yang nama berbeda";
	}
	
	# JIKA ADA PESAN ERROR DARI VALIDASI
	if (count($pesanError)>=1 ){
		echo "<div class='mssgBox'>";
		echo "<img src='../images/attention.png'> <br><hr>";
			$noPesan=0;
			foreach ($pesanError as $indeks=>$pesan_tampil) { 
			$noPesan++;
				echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";	
			} 
		echo "</div> <br>"; 
	}
	else {
		# SIMPAN DATA KE DATABASE. Jika tidak menemukan pesanError, simpan data ke database
		$Kode	= $_POST['txtKode'];
		$mySql	= "UPDATE prov SET nama_prov ='$txtNama', biaya_kirim ='$txtBiaya' WHERE id_prov ='$Kode'";
		$myQry	= mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=?open=Prov-Data'>";
		}
		exit;
	}	
} // End if($_POST) 

# ======================================================================
# MEMBACA DATA DARI FORM / DATABASE, UNTUK DITAMPILKAN KEMBALI PADA FORM
// Membaca data dari database, Sesuai kode yang dipilih dari Tampil Data (dikirim ke URL browser)
$Kode	= isset($_GET['Kode']) ?  $_GET['Kode'] : $_POST['txtKode'];
$mySql	 = "SELECT * FROM prov WHERE id_prov='$Kode'";
$myQry	 = mysql_query($mySql, $koneksidb)  or die ("Query ambil data salah : ".mysql_error());
$myData  = mysql_fetch_array($myQry);

	// Masukkan data ke variabel, untuk dibaca di form input
	$dataKode	= $myData['id_prov'];
	$dataNama 	= isset($_POST['txtNama']) ?  $_POST['txtNama'] : $myData['nama_prov'];
	$dataBiaya	= isset($_POST['txtBiaya']) ?  $_POST['txtBiaya'] : $myData['biaya_kirim'];
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="frmedit">
<table class="table-list" width="100%" style="margin-top:0px;">
	<tr>
	  <th colspan="3">Actualizar Ciudad/Provincia</th>
	</tr>
	<tr>
	  <td width="18%"><strong>Codigo</strong></td>
	  <td width="1%"><strong>:</strong></td>
	  <td width="81%"><input name="textfield" value="<?php echo $dataKode; ?>" size="10" maxlength="10" readonly="readonly"/>
    <input name="txtKode" type="hidden" value="<?php echo $dataKode; ?>" /></td></tr>
	<tr>
	  <td><strong>Nombre Ciudad/Provincia</strong></td>
	  <td><strong>:</strong></td>
	  <td><input name="txtNama" type="text" value="<?php echo $dataNama; ?>" size="80" maxlength="100" />
      <input name="txtNamaLama" type="hidden" value="<?php echo $myData['nama_prov']; ?>" /></td></tr>
	<tr>
      <td><strong>Gastos de Envio (S/.) </strong></td>
	  <td><strong>:</strong></td>
	  <td><input name="txtBiaya" type="text" value="<?php echo $dataBiaya; ?>" size="20" maxlength="12" /></td>
    </tr>
	<tr><td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td><input type="submit" name="btnSimpan" value=" GUARDAR " style="cursor:pointer;"></td>
    </tr>
</table>
</form>


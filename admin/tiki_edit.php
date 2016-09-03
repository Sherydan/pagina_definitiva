<?php
// Validasi : Halaman ini hanya untuk yang sudah login
include_once "../library/inc.sesadmin.php";

# MEMBACA TOMBOL SIMPAN DIKLIK
if(isset($_POST['btnSimpan'])){
	// Baca form
	$txtNama	= $_POST['txtNama'];
	$txtNama 	= str_replace("'","&acute;",$txtNama); // Membuang karakter petik (')
	$txtNama 	= ucwords(strtolower($txtNama));

	$txtOns	=$_POST['txtOns'];

	$txtOns	= str_replace("."," ", $txtOns);
	$txtOns	= str_replace(",", " ", $txtOns);
	$txtOns	= str_replace(" ", "", $txtOns);

	$txtReg = $_POST ['txtReg'];
	$txtReg = str_replace(".", "", $txtReg);
	$txtReg = str_replace(",", "", $txtReg);
	$txtReg = str_replace(" ", "", $txtReg);

	$txtEco	= $_POST['txtEco'];
	$txtEco =  str_replace(".", "", $txtEco);
	$txtEco = str_replace(",", "", $txtEco);
	$txtEco = str_replace("", " ", $txtEco);

	$txtAdministrasi = $_POST['txtAdministrasi'];
	
	// Validasi form
	$pesanError = array();
	if (trim($txtNama)=="") {
		$pesanError[] = "Data <b>Nama Kategori</b> Incorrecto!";		
	}
	
	// Validasi Nama Kategori, tidak boleh ada yang kembar (namanya sama)
	$txtNamaLama	= $_POST['txtNamaLama'];
	$cekSql	="SELECT * FROM tiki WHERE nm_kota='$txtNama' AND NOT(nm_kota='$txtNamaLama')";
	$cekQry	=mysql_query($cekSql, $koneksidb) or die ("Eror Query".mysql_error()); 
	if(mysql_num_rows($cekQry)>=1){
		$pesanError[] = "Maaf, Kota <b> $txtNama </b> sudah ada, ganti dengan yang nama berbeda";
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
		# SIMPAN DATA KE DATABASE. Jika tidak menemukan pesan error, simpan data ke database
		$Kode 	= $_POST['txtKode'];
		$mySql	= "UPDATE tiki SET 
				   nm_kota='$txtNama',
				   ons='$txtOns',
				   reg = '$txtReg',
				   eco='$txtEco',
				   administrasi  ='$txtAdministrasi' WHERE kd_kota='$Kode'";
		$myQry	= mysql_query($mySql) or die ("Query salah : ".mysql_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=?open=Tiki-Data'>";
		}
		exit;
	}
} // End if($_POST) 


# Membuat nilai data pada form input
$Kode 	= isset($_GET['Kode']) ? $_GET['Kode'] : $_POST['txtKode1'];
$mySql 	= "SELECT * FROM tiki WHERE kd_kota='$Kode'";
$myQry 	= mysql_query($mySql, $koneksidb) or die("Query Ambil data salah :".mysql_error());
$myData = mysql_fetch_array($myQry);

	//MASUKKAN DATA KE VARIABLE UNTUK DIBACA DI FORM INPUT
	$dataKode = $myData['kd_kota'];
	$dataKota = isset($_POST['txtNama']) ? $_POST['txtNama'] : $myData['nm_kota'];
	$dataOns = isset($_POST['txtOns']) ? $_POST['txtOns'] : $myData['ons'];
	$dataReg	= isset($_POST['txtReg']) ? $_POST['txtReg'] : $myData['reg'];
	$dataEco = isset($_POST['txtEco']) ? $_POST['txtEco'] : $myData['eco'];
	$dataAdministrasi = isset($_POST['txtAdministrasi']) ? $_POST['txtAdministrasi'] : $myData['administrasi'];
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="frmadd" target="_self">
<table class="table-list" width="100%" style="margin-top:0px;">
	<tr>
	  <th colspan="3">TAMBAH DATA TIKI</th>
	</tr>
	<tr>
	  <td width="18%"><strong>Kode Kota</strong></td>
	  <td width="1%"><strong>:</strong></td>
	  <td width="81%"><input name="txtKode" value="<?php echo $dataKode; ?>" size="10" maxlength="10" />
		<input name="txtKode1" type="hidden" value="<?php echo $dataKode; ?>"></td></tr>
	<tr>
	  <td><strong>Nama Kota</strong></td>
	  <td><strong>:</strong></td>
	  <td><input name="txtNama" value="<?php echo $dataKota; ?>" size="80" maxlength="100" />
	  <input name="txtNamaLama" type="hidden" value="<?php echo $myData['nm_kota']; ?>"></td>
	</tr>
	<tr>
		<td><strong>Harga Ons</strong></td>
		<td><b>:</b></td>
		<td><input name="txtOns" type="text" size="5" maxlength="20" value="<?php echo $dataOns; ?>"></td>
	</tr>
	<tr>
		<td><strong>Harga Reg</strong></td>
		<td><strong>:</strong></td>
		<td><input name="txtReg" type="text" size="5" maxlength="20" value="<?php echo $dataReg; ?>"></td>
	</tr>
	<tr>
		<td><strong>Harga Eco</strong></td>
		<td><b>:</b></td>
		<td><input name="txtEco" type="text" size="5" maxlength="20" value="<?php echo $dataEco; ?>"></td>
	</tr>
	<tr>
		<td><strong>Administrasi</strong></td>
		<td><b>:</b></td>
		<td><input name="txtAdministrasi" type="text" size="5" maxlength="20" value="<?php echo $dataAdministrasi; ?>"></td>
	</tr>
	<tr><td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td><input type="submit" name="btnSimpan" value=" SIMPAN " style="cursor:pointer;"></td>
    </tr>
</table>
</form>

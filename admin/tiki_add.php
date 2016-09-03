<?php
// Validasi : Halaman ini hanya untuk yang sudah login
include_once "../library/inc.sesadmin.php";

# MEMBACA TOMBOL SIMPAN DIKLIK
if(isset($_POST['btnSimpan'])){
	// Baca form
	$txtNama	= $_POST['txtNama'];
	$txtNama 	= str_replace("'","&acute;",$txtNama); // Membuang karakter petik (')


	$txtOns		= $_POST['txtOns'];
	$txtOns = str_replace(".", "", $txtOns);
	$txtOns	=str_replace(",", "", $txtOns);
	$txtOns	= str_replace(" ", "", $txtOns);

	$txtReg =$_POST['txtReg'];
	$txtReg  = str_replace(".", "", $txtReg);
	$txtReg= str_replace("", "", $txtReg);
	$txtReg = str_replace(",", "", $txtReg);

	$txtEco = $_POST['txtEco'];
	$txtEco	= str_replace("","", $txtEco);
	$txtEco	= str_replace(".", "", $txtEco);
	$txtEco = str_replace(",", "", $txtEco);

	$txtAdministrasi	= $_POST['txtAdministrasi'];
	// Validasi form
	$pesanError = array();
	if (trim($txtNama)=="") {
		$pesanError[] = "Data <b>Nama Kategori</b> Incorrecto!";		
	}

	if (trim($txtOns)=="") {
		$pesanError[]= "Data <b>Ons</b> Tidak Boleh kosong";
	}
	if (trim($txtReg)=="") {
		$pesanError[]= "Data <b>Reg</b> Tidak Boleh kosong";
	}
	if(trim($txtEco)==""){
			$pesanError[]= "Data <b>Eco</b> Tidak Boleh kosong";
	}
	if (trim($txtAdministrasi)=="") {
			$pesanError[]= "Data <b>Administrasi</b> Tidak Boleh kosong";
	}
	
	// Validasi Nama Kategori, tidak boleh ada yang kembar (namanya sama)
	$cekSql	="SELECT * FROM tiki WHERE nm_kota='$txtNama'";
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
		$kodeBaru= $_POST['txtKode'];
		$mySql	= "INSERT INTO tiki SET 
				   kd_kota='$kodeBaru', 
				   nm_kota='$txtNama',
				   ons  ='$txtOns',
				   reg ='$txtReg',
				   eco = '$txtEco', 
				   administrasi= '$txtAdministrasi'
				  ";
		$myQry	= mysql_query($mySql) or die ("Query salah : ".mysql_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=?open=Tiki-Data'>";
		}
	}
} // End if($_POST) 


# Membuat nilai data pada form input
$dataKode 		= isset($_POST['txtKode']) ? $_POST['txtKode'] : '';
$dataKota       = isset($_POST['txtNama']) ?  $_POST['txtNama'] : '';
$dataOns		= isset($_POST['txtOns']) ? $_POST['txtOns'] : '';
$dataReg		= isset($_POST['txtReg']) ? $_POST['txtReg'] : '';
$dataEco 		= isset($_POST['txtEco']) ? $_POST['txtEco'] : '' ;

$dataAdministrasi	= isset($_POST['txtAdministrasi']) ? $_POST['txtAdministrasi'] : '' ;
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="frmadd" target="_self">
<table class="table-list" width="100%" style="margin-top:0px;">
	<tr>
	  <th colspan="3">DATOS ENVIAR AGREGADOS</th>
	</tr>
	<tr>
	  <td width="18%"><strong>Codigo de Ciudad</strong></td>
	  <td width="1%"><strong>:</strong></td>
	  <td width="81%"><input name="txtKode" value="<?php echo $dataKode; ?>" size="10" maxlength="10" /></td></tr>
	<tr>
	  <td><strong>Nombre de Ciudad</strong></td>
	  <td><strong>:</strong></td>
	  <td><input name="txtNama" value="<?php echo $dataKota; ?>" size="80" maxlength="100" /></td>
	</tr>
	<tr>
		<td><strong>Precio ONS</strong></td>
		<td><b>:</b></td>
		<td><input name="txtOns" type="text" value="<?php echo $dataOns; ?>"></td>
	</tr>
		<tr>
		<td><strong>Precio Reg</strong></td>
		<td><b>:</b></td>
		<td><input name="txtReg" type="text" value="<?php echo $dataReg; ?>"></td>
	</tr>
		<tr>
		<td><strong>Precio Eco </strong></td>
		<td><b>:</b></td>
		<td><input name="txtEco" type="text" value="<?php echo $dataEco; ?>"></td>
	</tr>

	<tr>
		<td><strong>Gastos Administrativos</strong></td>
		<td><strong>:</strong></td>
		<td><input name ="txtAdministrasi" type="text" size="7" maxlength="10" value="<?php echo $dataAdministrasi; ?>"></td>
	</tr>
	<tr><td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td><input type="submit" name="btnSimpan" value="Agregar" style="cursor:pointer;"></td>
    </tr>
</table>
</form>

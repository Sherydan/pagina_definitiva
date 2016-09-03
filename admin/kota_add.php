<?php
include_once "../library/inc.connection.php";
include_once "../library/inc.library.php";
include_once "../library/inc.sesadmin.php";   // Validasi, mengakses halaman harus Login

#MEMBACA TOMBOL simpan klik
if (isset($_POST['btnSimpan'])) {
	#baca variabel 
	$txtCodigo=$_POST['textfield'];
	$cmbdepa=$_POST['cmbdepa'];
	$txtNama =$_POST['txtNama'];
	$txtNama	=str_replace("'", "&acute;", $txtNama);

	#VALIDASI UNTUK FORM JIKA FORM KOSONG

	$pesanError= array();
	if (trim($txtNama)=="") {
		$pesanError[]= "Data <b>Nama kabkot </b> Tidak Boleh KOSONG";
	}

	//validación de la ciudad, no debe haber ninguna ciudad del mismo nombre
	$cekSql ="SELECT id_prov,id_kabkot,nama_kabkot FROM kabkot WHERE nama_kabkot='$txtNama'";
	$cekQry = mysql_query($cekSql, $koneksidb) or die("Error Query:".mysql_error());
	if (mysql_num_rows($cekQry)>=1) {
		$pesanError[]= "Maaf, kabkot <b>$txtNama</b> Sudah Dimasukkan ganti dengan nama lain";
	}

	#JIKA ADA PESAN ERROR DARI VALIDASI FORM 
	if (count($pesanError)>=1) {
		echo "<div class='mssgBox'>";
		echo "<img src ='../images/attention.png'><br><hr>";
		$noPesan= 0;
		foreach ($pesanError as $indeks => $pesan_tampil) {
			$noPesan++;
				echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";
		}
		echo "</div><br />";
	}
	else{
		#SIMPAN DATA KE DALAM DATABASE jika tidak menemukan error 
		//$kodeBaru= buatKode("kabkot","C");
		$mySql= "INSERT INTO kabkot (id_prov,id_kabkot,nama_kabkot)VALUES ('$cmbdepa','$txtCodigo','$txtNama')";
		$myQry= mysql_query($mySql, $koneksidb)or die("Gagal Simpan".mysql_error());
		if ($myQry) {
			echo "<meta http-equiv='refresh' content='0; url=?open=Kota-Data'>";
		}
	}
}
$pageSql = "SELECT id_kabkot FROM kabkot";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
//$dataKode		= buatKode("kabkot","C");
$dataKode	 = mysql_num_rows($pageQry)+1;
$dataNama		= isset($_POST['txtNama']) ? $_POST['txtNama']: '';
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" name="frmadd">
<table class="table-list" width="100%" style="margin-top:0px;">
	<tr>
		<th colspan="3">DATOS DE CIUDAD</th>
	</tr>
	<tr>
		<td width="18%"><strong>ID CIUDAD</strong></td>
		<td width="1%"><strong>:</strong></td>
		<td width="81%"><input name="textfield" id="textfield" value="<?php echo $dataKode; ?>" size="10" maxlength="10" readonly="readonly"></td>
	</tr>
	<tr>
	  <td><strong>DEPARTAMENTO</strong></td>
	  <td><strong>:</strong></td>
	  <td><select name="cmbdepa">
        <option value="VACIO">....</option>
        <?php
		  $mySql = "SELECT id_prov, nama_prov FROM prov ORDER BY nama_prov";
		  $myQry = mysql_query($mySql, $koneksidb) or die ("Error en la Consulta SQL".mysql_error());
		  while ($myData = mysql_fetch_array($myQry)) {
			if ($myData['id_prov']== "....") {
				$cek = " selected";
			} else { $cek=""; }
			echo "<option value='$myData[id_prov]' $cek> $myData[nama_prov] </option>";
		  }
		  ?>
      </select></td>
    </tr>
	<tr>
		<td><strong>Nombre Ciudad</strong></td>
		<td><strong>:</strong></td>
		<td><input name="txtNama" value="<?php echo $dataNama; ?>" size="80" maxlength="100"></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><input name="btnSimpan" type="submit" value="Agregar" style="cursor:pointer;"></td>
	</tr>
</table>
	
</form>
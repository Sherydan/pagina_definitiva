<?php
// Validasi Login : yang boleh mengakses halaman ini hanya yang sudah Login admin
include_once "../library/inc.sesadmin.php";
include_once "../library/inc.library.php";

# TOMBOL SIMPAN DIKLIK
if(isset($_POST['btnSimpan'])){
	// Baca form
	$txtNama	= $_POST['txtNama'];
	$txtNama 	= str_replace("'","&acute;",$txtNama);
	$txtNama	= ucwords(strtolower($txtNama));

	$txtItem	= $_POST['txtItem'];
	$txtItem 	= str_replace("'","&acute;",$txtItem);
	$txtItem	= ucwords(strtolower($txtItem)); 	
	
	$txtHrgModal	= $_POST['txtHrgModal'];
	$txtHrgModal 	= str_replace("'","&acute;",$txtHrgModal);
	
	$txtHrgJual		= $_POST['txtHrgJual'];
	$txtHrgJual 	= str_replace("'","&acute;",$txtHrgJual);
	
	$txtStok	= $_POST['txtStok'];
	$txtStok 	= str_replace("'","&acute;",$txtStok);
	
	$txtKeterangan	=$_POST['txtKeterangan'];
	$txtKeterangan 	= str_replace("'","&acute;",$txtKeterangan);

	$txtBrand		=$_POST['txtBrand'];
	$txtBrand		= str_replace("'", "&acute;", $txtBrand);

	$txtModel		=$_POST['txtModel'];
	$txtModel		= str_replace("'", "&acute;", $txtModel);

	$txtReleased	=$_POST['txtReleased'];
	$txtReleased	=str_replace("'", "&acute;", $txtReleased);

	$txtDimension	=$_POST['txtDimension'];
	$txtDimension	=str_replace("'", "&acute;", $txtDimension);

	$txtDisplay		=$_POST['txtDisplay'];
	$txtDisplay		= str_replace("'", "&acute;", $txtDisplay);
	
	$cmbKategori	=$_POST['cmbKategori'];
	
	// Validasi form
	$pesanError = array();
	if (trim($txtNama)=="") {
		$pesanError[] = "Data <b>Nama Barang</b> Incorrecto!";		
	}	
	if (trim($txtHrgModal)==""  or ! is_numeric(trim($txtHrgModal))) {
		$pesanError[] = "Data <b>Harga Modal (Rp)</b> Incorrecto!";		
	}
	if (trim($txtHrgJual)==""  or ! is_numeric(trim($txtHrgJual))) {
		$pesanError[] = "Data <b>Harga Jual (Rp)</b> Incorrecto!";		
	}
	if (trim($txtStok)=="" or ! is_numeric(trim($txtStok))) {
		$pesanError[] = "Data <b>Stok</b>  Incorrecto!";		
	}
	if (trim($txtKeterangan)=="") {
		$pesanError[] = "Data <b>Keterangan</b> Incorrecto!";		
	}
	if (trim($txtBrand)=="") {
		$pesanError[]="Data <b>Brand</b> Masih kosong";
	}
	if (trim($txtReleased)=="") {
		$pesanError[]="Data <b>Released</b> Masih kosong !!";
	}
	if (trim($txtModel)=="") {
		$pesanError[]= "Data <b>Model</b>Masih kosong";
	}
	if (trim($txtDimension)=="") {
		$pesanError[]= "Data <b>Dimension</b> masih kosong";
	}
	if (trim($txtDisplay)=="") {
		$pesanError[]= "Data <b>Display</b> masih kosong";
	}
	if (trim($cmbKategori)=="KOSONG") {
		$pesanError[] = "Data <b>Kategori</b> belum dipilih !";		
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
		// Membuat kode baru
		$kodeBaru	= buatKode("barang", "B");

		// Mengkopi file gambar
		if (! empty($_FILES['namaFile']['tmp_name'])) {
			//$target_path = "../assets/products/";
			//$target_path = $target_path . basename( $_FILES['namafile']['name']); 
			$nama_file = $_FILES['namaFile']['name'];
			$nama_file = stripslashes($nama_file);
			$nama_file = str_replace("'","",$nama_file);
			$nama_file = str_replace(" ","-",$nama_file);
			$nama_file = $kodeBaru.".".$nama_file;
			//copy($_FILES['namaFile']['tmp_name'],"../assets/products/".$nama_file);
			move_uploaded_file($_FILES['namaFile']['tmp_name'], "../assets/products/".$nama_file);
			//move_uploaded_file($_FILES['namaFile']['tmp_name'], $target_path)
			
				
			//if(move_uploaded_file($_FILES['namaFile']['tmp_name'], $target_path)) 
			//{ 
				//echo "El archivo ". basename( $_FILES['namaFile']['name']). " ha sido subido";
			//} 
			//else
			//{
				//echo "Ha ocurrido un error, trate de nuevo!";
			//}
			}
		else {
			$nama_file = "";
		}
		
		// Simpan data dari form ke database
		$mySql	= "INSERT INTO barang (kd_barang, nm_barang, harga_modal, harga_jual, stok, keterangan, brand,model,realeased,dimension,display,file_gambar,kd_kategori) 
					VALUES('$kodeBaru', '$txtNama', '$txtHrgModal', '$txtHrgJual',  '$txtStok', '$txtKeterangan','$txtBrand','$txtModel','$txtReleased','$txtDimension','$txtDisplay', '$nama_file', '$cmbKategori')";
		$myQry	= mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
		if($myQry){				
			// Refresh
			echo "<meta http-equiv='refresh' content='0; url=?open=Barang-Add'>";
		}
	}	
} 

# MEMBUAT NILAI DATA PADA FORM
# SIMPAN DATA PADA FORM, Jika saat Sumbit ada yang kosong (lupa belum diisi)
$dataKode		= buatKode("barang", "B");
$dataNama		= isset($_POST['txtNama']) ? $_POST['txtNama'] : '';
$dataHrgModal	= isset($_POST['txtHrgModal']) ? $_POST['txtHrgModal'] : '';
$dataHrgJual	= isset($_POST['txtHrgJual']) ? $_POST['txtHrgJual'] : '';
$dataStok		= isset($_POST['txtStok']) ? $_POST['txtStok'] : '';  
$dataKeterangan	= isset($_POST['txtKeterangan']) ? $_POST['txtKeterangan'] : ''; 
$dataBrand		= isset($_POST['txtBrand']) ? $_POST['txtBrand'] :'';
$dataModel		= isset($_POST['txtModel']) ? $_POST['txtModel'] : '';
$dataReleased	= isset($_POST['txtReleased']) ? $_POST['txtReleased'] : '';
$dataDimension	= isset($_POST['txtDimension']) ? $_POST['txtDimension'] : '';
$dataDisplay	= isset($_POST['txtDisplay']) ? $_POST['txtDisplay'] : '';
$dataKategori	= isset($_POST['cmbKategori']) ? $_POST['cmbKategori'] : '';
$dataItem	= isset($_POST['txtItem']) ? $_POST['txtItem'] : '';
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" name="frmadd" >
<table class="table-list" width="100%" style="margin-top:0px;">
	<tr>
	  <th colspan="3"><strong>AGREGAR PRODUCTOS </strong></th>
	</tr>
	<tr>
	  <td width="14%"><strong>Codigo</strong></td>
	  <td width="1%"><strong>:</strong></td>
	  <td width="85%"><input name="textfield" value="<?php echo $dataKode; ?>" size="10" maxlength="10" readonly="readonly"/></td></tr>
	  <tr>
	  	<td><strong>ID Producto</strong></td>
	  	<td><strong>:</strong></td>
	  	<td><input name="txtItem" type="text" value="<?php echo $dataItem; ?>" size="10" maxlength="8"></td>
	  </tr>
	<tr>
	  <td><strong>Nombre Producto </strong></td>
	  <td><strong>:</strong></td>
	  <td><input name="txtNama" value="<?php echo $dataNama; ?>" size="80" maxlength="200" /></td>
	</tr>
	<tr>
      <td><strong>Precio Compra (S/.) </strong></td>
	  <td><strong>:</strong></td>
	  <td><input name="txtHrgModal" type="text" value="<?php echo $dataHrgModal; ?>" size="20" maxlength="12" /></td>
    </tr>
	<tr>
	  <td><strong>Precio Venta (S/.) </strong></td>
	  <td><strong>:</strong></td>
	  <td><input name="txtHrgJual" type="text" value="<?php echo $dataHrgJual; ?>" size="20" maxlength="12" /></td>
    </tr>
	<tr>
	  <td><strong>Stock </strong></td>
	  <td><strong>:</strong></td>
	  <td><input name="txtStok" type="text" value="<?php echo $dataStok; ?>" size="10" maxlength="4" /></td>
    </tr>
	<tr>
	  <td><strong>Fotos</strong></td>
	  <td><strong>:</strong></td>
	  <td><input name="namaFile" type="file" size="70" /></td>
    </tr>
	<tr>
	  <td><strong>Descripcion</strong></td>
	  <td><strong>:</strong></td>
	  <td><textarea id="elm1" name="txtKeterangan" cols="70" rows="6"><?php echo $dataKeterangan; ?></textarea></td>
    </tr>
	<tr>
		<td><strong>Marca</strong></td>
		<td><strong>:</strong></td>
		<td><input name="txtBrand" type="text" size="20" maxlength="50" value="<?php echo $dataBrand; ?>"></td>
	</tr>
	<tr>
		<td><strong>Modelo</strong></td>
		<td><b>:</b></td>
		<td><input name="txtModel" type="text" size="20" maxlength="60" value="<?php echo $dataModel; ?>"></td>
	</tr>	
	<tr>
		<td><strong>Agregado</strong></td>
		<td><strong>:</strong></td>
		<td><input name="txtReleased" type="text" size="30" maxlength="100" value="<?php echo $dataReleased; ?>"></td>
	</tr>
	<tr>
		<td><strong>Dimension</strong></td>
		<td><strong>:</strong></td>
		<td><input name="txtDimension" type="text" size="30" maxlength="100" value="<?php echo $dataDimension; ?>"></td>
	</tr>
	<tr>
		<td><strong>Display</strong></td>
		<td><strong>:</strong></td>
		<td><input name="txtDisplay" type="text"  size="30" maxlength="100" value="<?php echo $dataDisplay; ?>"></td>
	</tr>
	<tr>
	  <td><strong>Categoria</strong></td>
	  <td><strong>:</strong></td>
	  <td><select name="cmbKategori">
        <option value="VACIO">....</option>
        <?php
		  $mySql = "SELECT * FROM kategori ORDER BY nm_kategori";
		  $myQry = mysql_query($mySql, $koneksidb) or die ("Gagal Query".mysql_error());
		  while ($myData = mysql_fetch_array($myQry)) {
			if ($myData['kd_kategori']== $dataKategori) {
				$cek = " selected";
			} else { $cek=""; }
			echo "<option value='$myData[kd_kategori]' $cek> $myData[nm_kategori] </option>";
		  }
		  ?>
      </select></td>
    </tr>
	<tr><td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td><input type="submit" name="btnSimpan" value="Agregar" style="cursor:pointer;"></td>
    </tr>
</table>
</form>

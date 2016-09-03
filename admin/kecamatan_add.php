<?php
/**
 * Created by PhpStorm.
 * Coder: Gorqui Ramiro Chavez
 * Date: 01/22/2016
 * Time: 9:06 AM
 */
if (isset($_POST['btnSimpan'])) {
    #baca variabel
	$txtCodigo=$_POST['textfield'];
	$cmbdepa=$_POST['propinsi'];
	$cmbciu=$_POST['kota'];
	$txtKode= $_POST['txtKode'];
    $txtKode= str_replace("'","&acute;", $txtKode);

    $txtNama =$_POST['txtNama'];
    $txtNama	=str_replace("'", "&acute;", $txtNama);

    #VALIDASI UNTUK FORM JIKA FORM KOSONG

    $pesanError= array();
    if(trim($txtKode)==""){
        $pesanError[]= "Data <b>Kode</b> Tidak Boleh Kosong";
    }

    if (trim($txtNama)=="") {
        $pesanError[]= "Data <b>Nama Kota </b> Tidak Boleh KOSONG";
    }

    //VALIDASI nama kota, tidak boleh ada nama kota yang sama
    $cekSql ="SELECT id_kec,nama_kec FROM kec WHERE nama_kec='$txtNama'";
    $cekQry = mysql_query($cekSql, $koneksidb) or die("Error Query:".mysql_error());
    if (mysql_num_rows($cekQry)>=1) {
        $pesanError[]= "Lo Sentimos, <b>$txtNama</b> ya fue agregado";
    }

    #JIKA ADA PESAN ERROR DARI VALIDASI FORM
    if (count($pesanError)>=1) {
        echo "<div class='mssgBox'>";
        echo "<img src ='images/attention.png'><br><hr>";
        $noPesan= 0;
        foreach ($pesanError as $indeks => $pesan_tampil) {
            $noPesan++;
            echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";
        }
        echo "</div><br />";
    }
    else{
        #SIMPAN DATA KE DALAM DATABASE jika tidak menemukan error
        //$kodeBaru= buatKode("kota","K");
        $mySql= "INSERT INTO kec (id_prov,id_kabkot,id_kec,nama_kec)VALUES ('$cmbdepa','$cmbciu','$txtKode','$txtNama')";
        $myQry= mysql_query($mySql, $koneksidb)or die("Gagal Simpan".mysql_error());
        if ($myQry) {
            echo "<meta http-equiv='refresh' content='0; url=?open=Kecamatan-Data'>";
        }
    }
}
$pageSql = "SELECT id_kec FROM kec";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$dataKode= mysql_num_rows($pageQry)+1;
//$dataKode		= isset($_POST['textfield'])? $_POST['textfield'] :'';
$dataNama		= isset($_POST['txtNama']) ? $_POST['txtNama']: '';
?>
<script type="text/javascript" src="../jquery.js"></script>
		<script type="text/javascript">
var htmlobjek;
$(document).ready(function(){
  //apabila terjadi event onchange terhadap object <select id=propinsi>
  $("#propinsi").change(function(){
    var propinsi = $("#propinsi").val();
    $.ajax({
        url: "../ambilkota.php",
        data: "propinsi="+propinsi,
        cache: false,
        success: function(msg){
            //jika data sukses diambil dari server kita tampilkan
            //di <select id=kota>
            $("#kota").html(msg);
        }
    });
  });
  $("#kota").change(function(){
    var kota = $("#kota").val();
    $.ajax({
        url: "../ambilkecamatan.php",
        data: "kota="+kota,
        cache: false,
        success: function(msg){
            $("#kec").html(msg);
        }
    });
  });
});

</script>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" name="frmadd">
    <table class="table-list" width="100%" style="margin-top:0px;">
        <tr>
            <th colspan="3">AGREGAR DISTRITO</th>
        </tr>
        <tr>
            <td width="18%"><strong>ID DISTRITO</strong></td>
            <td width="1%"><strong>:</strong></td>
            <td width="81%"><input name="txtKode" value="<?php echo $dataKode; ?>" size="4" maxlength="3" readonly="readonly"></td>
        </tr>
		<tr><div class="control-group">
				<td><label class="control-label" for="city" ><b>Departamento</b></label></td>
				<td width="1%"><strong>:</strong></td>
				<div class="controls">
					<td><select type="text" id="propinsi" name="propinsi" required>
						<option value="BLANK">-Seleccionar Departamento-</option>
						<?php
							//MENGAMBIL NAMA PROVINSI YANG DI DATABASE
							$propinsi =mysql_query("SELECT * FROM prov ORDER BY nama_prov");
							while ($dataProvinsi=mysql_fetch_array($propinsi)) {
								echo "<option value=\"$dataProvinsi[id_prov]\">$dataProvinsi[nama_prov]</option>\n";
							}
						?>
					</select></td>
				</div>
			</div>
		</tr>
		<tr><div class="control-group">
			<td><label class="control-label" for="state"><b>Ciudad / Provincia</b></label></td>
			<td width="1%"><strong>:</strong></td>
			<div class="controls">
			  <td><select type="text" id="kota"  name="kota">
				<option value="BLANK">-Seleccionar Ciudad / Provincia-</option>
				<?php
				//mengambil nama-nama provinsi yang ada di database
				$kota=mysql_query("SELECT * FROM kabkot ORDER BY nama_kabkot ");
				while ($kab=mysql_fetch_array($kota)) {
					echo "<option value=\"$kota[id_kabkot]\">$kota[nama_kabkot]</option>\n";
				}
				?>
				</select></td>
			</div>
		</div>
		</tr>
        <tr>
            <td><strong>Nombre Distrito</strong></td>
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
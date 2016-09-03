<?php
/**
 * Created by PhpStorm.
 * Coder: herry prasetyo
 * Date: 4/27/2016
 * Time: 9:06 AM
 */
if (isset($_POST['btnSimpan'])) {
    #baca variabel
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
    $cekSql ="SELECT id_prov,nama_prov FROM prov WHERE nama_prov='$txtNama'";
    $cekQry = mysql_query($cekSql, $koneksidb) or die("Error Query:".mysql_error());
    if (mysql_num_rows($cekQry)>=1) {
        $pesanError[]= "Maaf, Provinsi <b>$txtNama</b> Sudah Dimasukkan ganti dengan nama lain";
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
        $mySql= "INSERT INTO prov (id_prov,nama_prov)VALUES ('$txtKode','$txtNama')";
        $myQry= mysql_query($mySql, $koneksidb)or die("Gagal Simpan".mysql_error());
        if ($myQry) {
            echo "<meta http-equiv='refresh' content='0; url=?open=Prov-Data'>";
        }
    }
}
$dataKode		= isset($_POST['textfield'])? $_POST['textfield'] :'';
$dataNama		= isset($_POST['txtNama']) ? $_POST['txtNama']: '';
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" name="frmadd">
    <table class="table-list" width="100%" style="margin-top:0px;">
        <tr>
            <th colspan="3">AGREGAR DEPARTAMENTO</th>
        </tr>
        <tr>
            <td width="18%"><strong>ID DEPARTAMENTO</strong></td>
            <td width="1%"><strong>:</strong></td>
            <td width="81%"><input name="txtKode" value="<?php echo $dataKode; ?>" size="4" maxlength="3" ></td>
        </tr>
        <tr>
            <td><strong>Nombre Departamento</strong></td>
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
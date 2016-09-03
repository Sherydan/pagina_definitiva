<?php
//VALIDASI HALAMAN INI HANYA UNTUK YANG SUDAH LOGIN
include_once "../library/inc.sesadmin.php";

#MEMBACA TOMBOL SIMPAN KLIK
if (isset($_POST['btnSimpan'])) {
    //baca form
    $txtNmBrand    = $_POST['txtNmBrand'];
    $txtNmBrand   = str_replace("'", "&acute;", $txtNmBrand); //membuang karakter petik

    $txtBrand = $_POST['txtBrand'];
    $txtBrand = str_replace("'", "&acute;", $txtBrand);

    $txtAlamat  = $_POST['txtAlamat'];
    $txtAlamat = str_replace("'", "&acute;", $txtAlamat);

    $pesanError= array();
    if (trim($txtNmBrand)=="") {
        $pesanError[] = "Data <b>Nama Brand</b> Masih Kosong !!";

    }

    if (trim($txtBrand)=="") {
        $pesanError[]= "Data <b>ID Brand</b> Incorrecto!!";
    }

    if (trim($txtAlamat)=="") {
        $pesanError[]= "Data <b>Alamat</b> Incorrecto!!";
    }
  // Validasi Nama Kategori, tidak boleh ada yang kembar (namanya sama)
    $cekSql ="SELECT * FROM brand WHERE nm_brand='$txtNmBrand'";
    $cekQry =mysql_query($cekSql, $koneksidb) or die ("Eror Query".mysql_error());
    if(mysql_num_rows($cekQry)>=1){
        $pesanError[] = "Maaf, Kategori <b> $txtNama </b> sudah ada, ganti dengan yang nama berbeda";
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
        $kodeBaru= buatKode("brand", "BR");
        $mySql  = "INSERT INTO brand SET kd_brand='$kodeBaru',
                                        no_brand ='$txtBrand',
                                        nm_brand='$txtNmBrand',
                                        alamat = '$txtAlamat'";
        $myQry  = mysql_query($mySql) or die ("Query salah : ".mysql_error());
        if($myQry){
            echo "<meta http-equiv='refresh' content='0; url=?open=Brand-Add'>";
        }
    }
}//END POST

$dataKode = buatKode("brand","BR");
$dataNmBrand = isset($_POST['txtNmBrand']) ? $_POST['txtNmBrand'] : '';
$dataBrand = isset($_POST['txtBrand']) ? $_POST['txtBrand'] : ' ';
$dataAlamat = isset($_POST['txtAlamat']) ? $_POST['txtAlamat'] : '' ;
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" name="frmadd" target="_self">
<table class="table-list" width="100%" style="margin-top:0px;">
        <tr>
            <th colspan="3">Tambah Data Brand</th>
        </tr>
        <tr>
            <td width="18%"><strong>Kode</strong></td>
            <td width="1%"><strong>:</strong></td>
            <td><input name="textfield" type="text" value="<?php echo $dataKode; ?>" size="10" maxlength="10" readonly="readonly"></td>
        </tr>
        <tr>
            <td><strong>Id Brand</strong></td>
            <td><strong>:</strong></td>
            <td><input name="txtBrand" type="text" value="<?php echo $dataBrand; ?>" size="50" maxlength="100"></td>
        </tr>
        <tr>
            <td><strong>Nama Brand</strong></td>
            <td><strong>:</strong></td>
            <td><input name="txtNmBrand" type="text" value="<?php echo $dataNmBrand; ?>" size="50" maxlength="100"></td>
        </tr>
        <tr>
            <td><strong>Alamat</strong></td>
            <td><strong>:</strong></td>
            <td><input name="txtAlamat" type="text" size="50" maxlength="100" value="<?php echo $dataAlamat; ?>"></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
             <td>&nbsp;</td>
              <td><input type="submit" name="btnSimpan" value="SIMPAN"></td>
        </tr>
</table>
</form>
<?php
/*
Nama : Deo G Bastian
Created : 26 mei 2016
Radja Bangunan
*/

//Validasi : Halaman ini hanya untuk yang sudah login
include_once "../library/inc.sesadmin.php";

# MEMBACA TOMBOL SIMPAN DIKLIK
if (isset($_POST['btnSave'])) {
    # code...
    $textname=$_POST['textname'];
    $textname=str_replace("'", "&acute;",$textname); // Membuang karakter petik
    
    //Validasi FORM
    $message = array();
        if (trim($textname)=="")
            {
              $message[] = "Data <b>Nama Perusahaan </b> Tidak boleh kosong bos!!";
            }
    //Validasi nama perusahaan yang sama
    $cekSql ="SELECT * FROM perusahaan WHERE nm_perusahaan='$textname'";
    $cekquery = mysql_query($cekSql, $koneksidb) or die("error Query SEEETT" .mysql_error());
        if(mysql_num_rows($cekquery)>=1)
            {
              $message[] = "Maaf, Nama perusahaan <b> $textname </b> sudah ada boy, ganti yang lain";
            }
    // MEMUNCULKAN VALIDASI ERROR
    if (count($message)>=1)
            {
               echo "<div class='mssgBox'>";
               echo "<img src='../images/attention.png'> <br><hr>";
                    $noMessage=0;
                    foreach ($message as $indeks => $show_message) 
                    {
                        $noMessage++;
                            echo "&nbsp;&nbsp; $noMessage. $show_message<br>";
                    }
               echo "</div> <br>";     
            }     
    else{
        # SIMPAN DATA KE DATABASE. Jika tidak menemukan pesan error,simpan data ke database
        $newcode= buatKode("perusahaan","P");
        $savesql = "INSERT INTO perusahaan SET kd_perusahaan='$newcode',
                    nm_perusahaan='$textname'";
        $actqry = mysql_query($savesql,$koneksidb) or die ("Data tidak tersimpan :" .mysql_error());            
        if($actqry)
          {
          echo "<meta http-equiv='refresh' content='0; url=?open=Perusahaan-Add'> ";
          }
        }       
}
$dataKode = buatKode("perusahaan","P");
$dataName = isset($_POST['textname']) ? $_POST['textname'] : '' ;

?>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="frmadd" target="_self"> 
    <table class="table-list" width="100%" style="margin-top:0px;">
        <tr>
            <th colspan="3">TAMBAH DATA PERUSAHAAN</th>
        </tr>
        <!---------------------------kode perusahaan---------------->
        <tr>
            <td width="18%"><strong>Kode</strong> </td> 
            <td width="1%"><strong>:</strong></td> 
            <td width="81%"><input name="textcode" type="text" value="<?php echo $dataKode; ?>" size="10" maxlength="10" readonly="readonly"/>  </td>
        </tr>
        <!---------------------------name perusahaan---------------->
        <tr>
            <td> <strong>Nama Perusahaan</strong> </td>
            <td> <strong>:</strong></td>
            <td><input name="textname" type="text" value="<?php echo $dataName; ?>" size="10" maxlenght="20"></td>
        </tr>
        <!---------------------------tombol simpan---------------->
        <tr> 
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><input name="btnSave" type="submit" value="Save"></td>
        </tr>

    </table>
</form>
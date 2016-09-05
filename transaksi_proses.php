<?php


include_once "inc.session.php";
include_once "library/inc.connection.php";
include_once "library/inc.library.php";
//include_once "Veritrans/Veritrans.php";




//BACA KODE PELANGGAN  YANG LOGIN
$KodePelanggan  = $_SESSION['SES_PELANGGAN'];
$NamaPelanggan  = $_SESSION ['SES_USERNAME'];

// Use sandbox account
//Veritrans_Config::$isProduction = false;

// Set our server key
//Veritrans_Config::$serverKey = 'VT-server-zl2uCIcsHIIbBVopZFNFN4D7';



$sql_plg="SELECT * FROM pelanggan JOIN prov on pelanggan.id_prov=prov.id_prov JOIN kabkot ON pelanggan.id_kabkot=kabkot.id_kabkot JOIN kec ON pelanggan.id_kec=kec.id_kec WHERE kd_pelanggan='$KodePelanggan' ";
$qry_plg= mysql_query($sql_plg);
$hsl_plg=mysql_fetch_array($qry_plg);

#MEMERIKSA DATA DALAM KERANJANG
$cekSql ="SELECT * FROM tmp_keranjang WHERE kd_pelanggan='$KodePelanggan' AND nm_pelanggan='$NamaPelanggan'";
$cekQry = mysql_query($cekSql, $koneksidb) or die("Gagal Keranjang".mysql_error());
$cekQty =mysql_num_rows($cekQry);
if($cekQty < 1){
    echo "<br><br>";
    echo "<center>";
    echo "<b>Belum Ada Transaksi</b>";
    echo "</center>";

    //JIKA BARANG MASIH KOSONG, MAKA HALAMAN REFRESH KE DATA BARANG
    echo "<meta http-equiv='refresh' content='2; url=?open=Barang2'>";
}

#SAAT TOMBOL SIMPAN DIKLIK
if(isset($_POST['btnSimpan'])){
    #baca variable yang ada diform
    $txtNama        = $_POST['txtNama'];
    $txtNama        = str_replace("'","&acute;", $txtNama);

    $txtAlamat      =$_POST['txtAlamat'];
    $txtAlamat      = str_replace("'","&acute;", $txtAlamat);

    $prov    = $_POST['prov'];

    $kota       = $_POST['kota'];

    $kec        = $_POST['kec'];

    $txtKodePos    =$_POST['txtKodePos'];
    $txtKodePos     =str_replace("'","&acute;",$txtKodePos);

    $txtNotelpon    =$_POST['txtNotelpon'];
    $txtNotelpon    =str_replace("'","&acute;", $txtNotelpon);

    $txtEmail= $_POST['txtEmail'];

    $cmbPayment = $_POST['cmbPayment'];

    $pesanError =array();

    #JIKA ADA PESAN ERROR MAKA MUNCULKAN 
    if (count($pesanError)>=1) {
        echo "<div class='pesanError' align='left'>";
        echo "<img src='../images/attention.png'><br><hr>";
        $noPesan= 0;
        foreach ($pesanError as $indeks => $pesan_tampil) {
            $noPesan++;
                echo "&nbsp;&nbsp; $noPesan.$pesan_tampil<br>";
        }
        echo "</div><br>";
    }
    else{
        #simpan data ke database
        #jika jumlah error pesanEroor tidak ada 
       $KodePemesanan   =buatKode("pemesanan","PS");
       $tanggal         = date('Y-m-d');
        $mySql ="INSERT INTO pemesanan(no_pemesanan,tgl_pemesanan, kd_pelanggan,nm_pelanggan,nama_penerima,payment,
                 alamat_lengkap,id_prov, id_kabkot,id_kec, kode_pos, no_telepon,email) VALUES
                ('$KodePemesanan','$tanggal','$KodePelanggan','$NamaPelanggan','$txtNama','$cmbPayment','$txtAlamat','$prov','$kota','$kec','$txtKodePos','$txtNotelpon','$txtEmail')";
        $myQry= mysql_query($mySql, $koneksidb)or die("Gagal Query1".mysql_error());
        if ($myQry) {
            //membaca data dari tmp keranjang 
            $bacaSql="SELECT *  FROM tmp_keranjang WHERE nm_pelanggan='$NamaPelanggan' AND kd_pelanggan='$KodePelanggan'";
            $bacaQry =mysql_query($bacaSql, $koneksidb)or die("Gagal Keranjang tmp".mysql_error());
            while ($bacaData =mysql_fetch_array($bacaQry)) {
                # SIMPAN DATA DARI KERANJANG BELANJA KE PEMESANAN ITEM
                $Kode       = $bacaData['kd_barang'];
                $Harga      = $bacaData['harga'];
                $Jumlah     = $bacaData['jumlah'];

                $simpanSql ="INSERT INTO pemesanan_item(no_pemesanan, kd_barang, harga,payment, jumlah)
                              VALUES('$KodePemesanan', '$Kode','$Harga','$cmbPayment', '$Jumlah')";
                mysql_query($simpanSql, $koneksidb) or die ("Gagal Query 2 Simpan tuh".mysql_error());
          
           $sqlStok="UPDATE barang SET stok=stok- $Jumlah WHERE kd_barang='$Kode'";
                mysql_query($sqlStok,$koneksidb) or die("Gagal Query Stok".mysql_error());
            }

            //KOSONGKAN DATA KERANJANG MILIK PELANGGAN 
            $hapusSql = "DELETE FROM tmp_keranjang WHERE kd_pelanggan='$KodePelanggan' AND nm_pelanggan='$NamaPelanggan'";
            mysql_query($hapusSql, $koneksidb) or die("Gagal Query hapus Keranjang".mysql_error());

            //refresh
            echo "<meta http-equiv='refresh' content='0; url=?open=Transaksi-Tampil&Kode=$KodePemesanan'>";
        }
        exit;
    }
    
}//END POST
$dataNama = isset($_POST['txtNama']) ? $_POST['txtNama']: '' ;
$dataAlamat = isset($_POST['txtAlamat']) ? $_POST['txtAlamat'] :'';
$dataProvinsi =isset($_POST['prov']) ? $_POST['prov'] :'';
$dataKota       =isset($_POST['kota']) ? $_POST['kota']:'';
$dataKec    =isset($_POST['kec']) ? $_POST['kec'] :'';
$dataPos       =isset($_POST['txtPos']) ? $_POST['txtPos'] :'';
$dataNotelpon   =isset($_POST['txtNotelpon']) ? $_POST['txtNotelpon'] :'';

?>

<!DOCTYPE html>
    <html>
    <head>
        <title>TRANSACCION</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description">
        <meta name="author" content="radja bangunan">

        <!-- LE STYLES-->
        <link href="assets/css/bootstrap.css" rel="stylesheet">
        <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">
        <link href="assets/css/docs.css" rel="stylesheet">

        <link href="style.css" rel="stylesheet">
        <link href="assets/js/google-code-prettify/prettify.css" rel="stylesheet">

        <!-- LE FAV AND TOUCH ICONS-->
        <link rel="shortcut icon" href="assets/ico/favicon.ico">
        <link rel="apple-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-72-precomposed.png">
    <script type="text/javascript" src="jquery.js"></script>
     <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
        <script type="text/javascript">

function validarTarjetas(){

  
  visa = document.getElementById("visa").value;

  visa_error = "";
  mastercard_error = "";     
     
  if (!visa.match(/^4\d{3}-?\d{4}-?\d{4}-?\d{4}$/)) {
    visa_error = "No es un número de Visa correcto";

  
 // if (!mastercard.match(/^5[1-5]\d{2}-?\d{4}-?\d{4}-?\d{4}$/))
    //mastercard_error = "No es un número de Mastercard correcto";
  
   $("#message").html("<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>ERROR: No es un número de tarjeta Visa correcto</div>");

   
  
  } 

}
var htmlobjek;
$(document).ready(function(){
$("#pagar").click(function(){

    var minombre = $("#inputNama").val();
    var mitelefono = $("#inputTelepon").val();
    var midireccion = $("#inputAlamat").val();
    var codigopostal = $("#inputKodePos").val();
    var miemail = $("#inputEmail").val();
   var mivisa = $("#visa").val();
var mipassword = $("#clavetarjeta").val();
  var expr = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;


  if(minombre == "") {
      $("#message").html("<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button> Por favor ingrese Nombre</div>");

  }else if (mitelefono == "") {
      $("#message").html("<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Por favor ingrese celular </div>");

  }else if (midireccion == "") {
      $("#message").html("<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Por favor ingrese su direccion ciudad</div>");

  }else if (codigopostal == "") {
      $("#message").html("<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Por favor ingrese su codigo postal</div>");

  }else if (miemail == "" || !expr.test(miemail)) {
      $("#message").html("<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Por favor ingrese su email valido</div>");

 }else if ($("#methodpayment option:selected").val() == 0) {
      $("#message").html("<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Por favor ingrese metodode pago valido </div>");

  }else if (mivisa == "" || !mivisa.match(/^4\d{3}-?\d{4}-?\d{4}-?\d{4}$/)) {
      $("#message").html("<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Porfavor ingrese un numero  de tarjeta valido</div>");
 }else if (mipassword == "") {
      $("#message").html("<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Porfavor ingrese una clave</div>");

  }else if ($("#propinsi option:selected").val() == 0) {
      $("#message").html("<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Por favor seleccione alguna Ciudad</div>");

  }else if ($("#kota option:selected").val() == 0) {
      $("#message").html("<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Por favor seleccione alguna Comuna</div>");

  }else if ($("#kec option:selected").val() == 0) {
      $("#message").html("<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Por favor seleccione alguna Region</div>");
  }
    else {
    
    $.ajax({
    type: "POST",
    url: "crear_usuario.php",
    data: "rut="+mirut+"&nombre="+minombre+"&direccion="+midireccion+"&telefono="+mitelefono+"&email="+miemail+"&password1="+miemail+"&password1="+miclave,
    success: function(){

    $("#propinsi").change(function(){
    var propinsi = $("#propinsi").val();
    $.ajax({
        url: "ambilkota.php",
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
        url: "ambilkecamatan.php",
        data: "kota="+kota,
        cache: false,
        success: function(msg){
            $("#kec").html(msg);
        }
    });
  });
      
  //apabila terjadi event onchange terhadap object <select id=propinsi>
       var text = $(html).text();
            //Pulls hidden div that includes "true" in the success response
            var response = text.substr(text.length - 4);

          if(response == ""){
             alert("fgfdgdfg");
            $("#message").html(html);
            $('#pagar').hide();
            }
        else {
            $("#message").html(html);
            $('#pagar').show();
            }
      

    },
        beforeSend: function()
        {
          $("#message").html("<p class='text-center'><img src='images/ajax-loader.gif'></p>")
        }
      });
    }
    return false;
  });
});

function justNumbers(e)
        {
        var keynum = window.event ? window.event.keyCode : e.which;
        if ((keynum == 8) || (keynum == 46))
        return true;
         
        return /\d/.test(String.fromCharCode(keynum));
        }

</script>

    </head>
    <body>
    <div class="page-header">
            <h3>Confirmar Reserva</h3>
        </div>
        <div class="row-fluid">
            <div class="span9">
                <table class="table table-striped" >
                        <thead>
                            <tr>
                                <th colspan="5" bgcolor="#a9a9a9"><strong>Confirmar Compra</strong></th>
                            </tr>
                        </thead>
                    <tbody>
                    <tr>
                        <td><strong>No</strong></td>
                        <td><strong>Nombre Productos</strong></td>
                        <td><strong>Precio CLP ($)</strong></td>
                        <td><strong>Cantidad</strong></td>
                        <td align="right"><strong>Total CLP ($).</strong></td>
                    </tr>
                    </tbody>
                  
                    <?php 
                        //buat variable data
                        $subTotal = 0 ;
                        $totalHarga  =0;
                        $totalBarang=0;

                        //MENAMPILKAN DAFTAR BARANG YANG SUDAH DIPILIH (ada keranjang)
                        $mySql ="SELECT barang.nm_barang, tmp_keranjang.*
                                 FROM tmp_keranjang LEFT JOIN barang ON tmp_keranjang.kd_barang=barang.kd_barang
                                WHERE barang.kd_barang=tmp_keranjang.kd_barang AND tmp_keranjang.kd_pelanggan='$KodePelanggan'
                                ORDER BY tmp_keranjang.id";
                        $myQry = mysql_query($mySql, $koneksidb)or die("Gagal SQL".mysql_error());
                        $nomor=0;
                        while ($myData =mysql_fetch_array($myQry)) {
                            $nomor++;
                            //mendapatkan total harga (harga * jumlah)
                            $subTotal= $myData['harga'] * $myData['jumlah'];

                            //MENDAPATKAN TOTAL HARGA DARI SELURUH BARANG    
                            $totalHarga = $totalHarga + $subTotal;

                            //MENDAPATKAN TOTAL BARANG
                            $totalBarang = $totalBarang + $myData['jumlah'];
                    ?>
                    <tr>
                        <td align="center" width="4%"><?php echo $nomor; ?></td>
                        <td align="center"><?php echo $myData['nm_barang']; ?></td>
                        <td>$ <?php echo format_angka($myData['harga']); ?></td>
                        <td> <?php echo $myData['jumlah']; ?></td>
                        <td align="right">$ <?php echo format_angka($subTotal); ?> </td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="3" align="right"><b>TOTAL :</b></td>
                        <td align="center" bgcolor="#F5F5F5"><?php echo $totalBarang; ?></td>
                        <td align="right" bgcolor="#F5F5F5">$ <?php echo format_angka($totalHarga); ?></td>
                    </tr>
                    
                    </tbody>
                    </table>

     <div class="alert alert-block alert-info fade in">
        <!--<button type="button" class="close" data-dismiss="alert">×</button>-->
        <strong> Verifique la dirección de destino del envío. Cambie la dirección de envío si es diferente de la dirección inicial.</strong>
    
     </div>

        <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
        <table class="table table-striped table-bordered">
            <tbody>
                <tr>
                    <th colspan="2">ENTREGA DE PRODUCTOS A DOMICILIO</th>
                </tr>
                <td width="200">
                    <label class="control-label" for="inputNama">Nombre de Beneficiario</label>
                    </td>
                    <td>
                    <div class="controls">
                        <input class="span6" name="txtNama" id="inputNama" maxlength="50" type="text" placeholder="Beneficiario" value="<?php echo  $hsl_plg['nm_pelanggan'];  ?> ">
                    </div>
                    </td>
                    </tr>
            <tr>
                <td>
                    <label class="control-label" for="inputTelepon">Celular/Telefono</label>
                </td>
                <td><div class="controls">
                    <input class="span6" name="txtNotelpon" id="inputTelepon" type="text" maxlength="13" onkeypress="return justNumbers(event);" placeholder="Celular/Telefono" value="<?php echo $hsl_plg['no_telepon']; ?>">
                </div></td>
            </tr>
             <tr>
                <td>
                    <label class="control-label" for="inputAlamat">Direccion</label>
                    </td>
                    <td>
                    <div class="controls">
                        <input class="span6" maxlength="60" name="txtAlamat" type="text" id="inputAlamat" placeholder="Direccion" value="<?php echo $hsl_plg['alamat']; ?>">
                    </div>
               </td>
               </tr> 
            <tr>
                <td><label class="control-label">Codigo Postal</label></td>
                <td><div class="controls">
                    <input class="span3" name="txtKodePos" type="text" maxlength="10"  id="inputKodePos" onkeypress="return justNumbers(event);" placeholder="Codigo Postal" value="<?php echo $hsl_plg['kode_pos']; ?>">
                </div></td>
            </tr>
            <tr>
                <td><label class="control-label">Correo Electronico</label></td>
                <td><div class="controls">
                    <input class="span5" name="txtEmail" type="text" id="inputEmail" maxlength="40" placeholder="Correo Electronico" value="<?php echo $hsl_plg['email']; ?>">
                </div></td>
            </tr>
            <tr>
                <td><label class="control-label">Metodo de Pago</label></td>
                <td><div class="controls">
                    <select type="text" id="methodpayment" name="cmbPayment">
                        <option value="0">-Seleccione Metodo de Pago- </option>
                          <option value="1"> Trasferencia bancaria Visa</option>
                   

                    </select><font color="Red"> <b>Seleccione Metodo de Pago</b></font>
                </div></td>
            </tr>
         <td><label class="control-label">Tarjeta de Visa</label></td>
                <td><div class="controls">
    <input class="span5" name="visa" onBlur="validarTarjetas();" type="text" id="visa" onkeypress="return justNumbers(event);" placeholder="N° Tarjeta" maxlength="16" >
                </div></td>
            </tr>
  <td><label class="control-label">Clave</label></td>
                <td><div class="controls">
                <input class="span5" name="clavetarjeta" type="password" id="clavetarjeta" onkeypress="return justNumbers(event);" placeholder="Clave" maxlength="4">
                </div></td>
            </tr>
            <tr>
                <td><div class="control-group">
                    <label class="control-label" for="city">Ciudad<sup>*</sup></label>
                    <div class="controls"></td>
                    <td>
                        <select type="text" id="propinsi" name="prov" value="">
                            <option value="0">-Seleccione Ciudad-</option>
                            <?php
                            //MENGAMBIL NAMA PROVINSI YANG DIDATABASE
                            $propinsi =mysql_query("SELECT * FROM prov ORDER BY nama_prov");
                            while ($dataProvinsi=mysql_fetch_array($propinsi)) {
                                if ($dataProvinsi['id_prov']==$hsl_plg['id_prov']) {
                                    $cek ="selected";
                                }
                                else{
                                    $cek= "";
                                }
                                echo "<option value=\"$dataProvinsi[id_prov]\" $cek>$dataProvinsi[nama_prov]</option>\n";
                                }
                            ?>
                        </select>
                    </div>
                </div></td>
            </tr>
            <tr>
                <td><div class="control-group">
                    <label class="control-label" for="state">Comuna<sup>*</sup></label>
                </div></td>
                <td><div class="controls">
                    <select type="text" id="kota" name="kota">
                        <option value="0">-Seleccione comuna-</option>
                        <?php
                        //MENGAMBIL NAMA KOTA DI DATABASE
                        $kota=@mysql_query("SELECT * FROM kabkot ORDER BY nama_kabkot");
                        while ($dataKota=mysql_fetch_array($kota)) {
                            if ($dataKota['id_kabkot']==$hsl_plg['id_kabkot']) {
                                $cek ="selected";
                            }
                            else{
                                $cek ="";
                            }
                            echo "<option value='$dataKota[id_kabkot]' $cek>$dataKota[nama_kabkot]</option>\n";
                        }
                        ?>
                    </select>
                </div></td>
            </tr>
            <tr>
                <td><div>
                    <label class="control-label" for="kecamatan">Region<sup>*</sup></label>
                </div></td>
                <td>
                    <div class="controls">
                        <select type="text" id="kec" name="kec">
                            <option value="0">-Seleccione pais-</option>
                            <?php
                            //MENGAMBIL NAMA KECAMATAN DARI DATABASE
                            $kec=mysql_query("SELECT * FROM kec ORDER BY nama_kec");
                            while ($dataKec=mysql_fetch_array($kec)) {
                                if ($dataKec['id_kec']==$hsl_plg['id_kec']) {
                                    $cek ="selected";
                                }
                                else
                                {
                                    $cek = "";
                                }
                                echo "<option value=\"$dataKec[id_kec]\"$cek>$dataKec[nama_kec]</option>";
                            }
                             ?>
                        </select>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>   
        <input class="btn btn-large pull-right" id="pagar" name="btnSimpan" type="submit" value="PAGAR"> 
        </form>  
            <div id="message"></div>     
           <div>
        <!--<form method="post" action="<?php echo "check_out2.php";?>">
            <input name="txtNamaH" type="hidden" value="<?php echo $dataNama; ?>">
            <input name="txtAlamatH" type="hidden" value="<?php echo $dataAlamat; ?>">
            <input name="txtKodePosH" type="hidden" value="<?php echo $dataPos; ?>">
            <button class="btn btn-large" name="pay" type="submit"><i class="icon-arrow-left" id="payment-form"></i> Tarjeta Credito o Débito /VISA - Mastercard</button>
        </form>-->
        </div>
        <hr>
<br><br>
        <table class="table table-condensed">
        <thead>
          <tr>
              <th width="94%" colspan="3"><strong><h3>Metodos de Pago </h3></strong></th>
          </tr>
            <tr> <th colspan="3">Para proporcionar la comodidad de comprar en línea con nosotros, le ofrecemos varias formas de pago:</th> </tr>
        </thead>
        <tbody>
          <tr>
            <td width="4%"><img src="images/arow.gif"></td>
            <td colspan="3"><strong>Transferencia Bancaria: </strong></td>
            
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td width="2%" align="center" valign="top">-</td>
            <td width="94%" colspan="2">El pago puede hacerse a través de transferencias de dinero entre bancos. Usted puede transferir dinero de su banco y también a través de cajeros automáticos. Aceptamos transferencias de dinero a través de cuentas bancarias BCP.</td>
          </tr>
          <tr>
            <td><img src="images/arow.gif"></td>
            <td colspan="3"><strong>Pago en Efectivo : </strong></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td align="center" valign="top">-</td>
            <td colspan="2">También aceptamos pagos con tarjeta de crédito seguro y confiable. Para su comodidad, el número de su tarjeta de crédito a través del mejor sistema de seguridad. Vamos a garantizar la confidencialidad de todos los datos de su tarjeta de crédito para proporcionar una experiencia de compra que sea seguro y cómodo en nuestro sitio.</td>
          </tr>
          <tr>
              <td>&nbsp;</td>
              <td colspan="3"><strong>Nota : </strong></td>
          </tr>
          <tr>
              <td>&nbsp;</td>
              <td align="center" valign="top">*</td>
              <td colspan="2">•	El límite máximo de pago es 7x24 horas (7 días) desde el momento de la reserva, a través de los métodos de pago anteriores.</td>
          </tr>
         <tr>
              <td>&nbsp;</td>
              <td>*</td>
              <td  colspan="2">Después de hacer el pago, usted tiene que hacer la confirmación del pago (Confirmar) en el menú Historial De Pedidos acuerdo con el código de reserva.</td>
          </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
          </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
          </tr>
        </tbody>
      </table>
         
            </div>
<div>
</div>

    </body>
    </html>


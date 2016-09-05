<?php
#session_start();
include_once "inc.session.php";
include_once "library/inc.connection.php";
include_once "library/inc.library.php";

// Baca Kode Pelanggan yang Login
$KodePelanggan  = $_SESSION['SES_PELANGGAN'];
$NamaPelanggan  = $_SESSION['SES_USERNAME'];

// data Kode di URL harus ada
if(isset($_GET['Kode'])) {
  // Membaca Kode (No reserva)
  $Kode = $_GET['Kode'];

  // Sql membaca data Pemesanan utama sesuai Kode yang dipilih
  $mySql  = "SELECT reserva.*, clientes.id_clientes, ciudad.cod_ciudad, pais.cod_pais, prov.*
        FROM reserva
        LEFT JOIN cliente ON reserva.id_cliente= cliente.id_cliente
        LEFT JOIN comuna ON reserva.id_comuna=comuna.id_reserva
        LEFT JOIN ciudad ON reserva.id_ciudad=ciudad.id_ciudad
        LEFT JOIN pais ON reserva.id_pais=pais.id_pais
        WHERE reserva.id_cliente='$codcliente' AND  reserva.nombre='$mombren' AND reserva.no_reserva ='$cod'";
  $myQry = mysql_query($mySql, $coneciondb) or die ("error");
  $myData= mysql_fetch_array($myQry);
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Reservas y Transacciones completas</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

  <!--less style -->
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-responsive.css">
  <link rel="stylesheet" type="text/css" href="assets/css/docs.css">


    <link href="style.css" rel="stylesheet"/>
  <link href="assets/js/google-code-prettify/prettify.css" rel="stylesheet"/>
  <link rel="stylesheet" type="text/css" href="style/style_cetak.css">
  <!-- Less styles
  <link rel="stylesheet/less" type="text/css" href="less/bootsshop.less">
  <script src="less.js" type="text/javascript"></script>
   -->

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
</head>
<body>
 <div class="alert  alert-success span8">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>Historial de Compras</strong>
Por favor, continúe compras con el método de pago elegido
     </div>
<div>
  <img src="images/history.gif">
</div>
<div class="row-fluid">
  <div class="span9">
<table class="table table-striped table-bodered">
  <thead>
    <tr>
      <th colspan="3" align="center"><strong>Detalles de transaccion</strong></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td width="30%"><strong>Nro Reserva</strong></td>
      <td width="3%"><strong>:</strong></td>
      <td width="67%"><?php echo $myData['no_reserva']; ?></td>
    </tr>
    <tr>
      <td><strong>Fecha</strong></td>
      <td><strong>:</strong></td>
      <td><?php echo IndonesiaTgl($myData['fecha']); ?></td>
    </tr>
    <tr>
      <td><strong>Cod. Cliente</strong></td>
      <td><strong>:</strong></td>
      <td><?php echo $myData['id_cliente']; ?></td>
    </tr>
    <tr>
      <td><b>Nombre Cliente</b></td>
      <td><strong>:</strong></td>
      <td><?php echo $myData['nombre']; ?></td>
    </tr>
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
    <tr>
      <td><strong>Nombre Beneficiario</strong></td>
      <td><strong>:</strong></td>
      <td><?php echo $myData['nombre']; ?></td>
    </tr>
    <tr>
      <td><strong>Direccion</strong></td>
            <td><strong>:</strong></td>
            <td><?php echo $myData['direccion'];?></td>
    </tr>
    
    <tr>
      <td><strong>Ciudad/Provincia</strong></td>
      <td><strong>:</strong></td>
      <td><?php echo $myData['provincia']; ?></td>
    </tr>
        <tr>
            <td><strong>Comuna</strong></td>
            <td><strong>:</strong></td>
            <td><?php echo $myData['comuna']; ?></td>
        </tr>
        <tr>
            <td><strong>Codigo Postal</strong></td>
            <td><strong>:</strong></td>
            <td><?php echo $myData['cod_postal']; ?></td>
        </tr>
        <tr>
            <td><strong>Codigo Unico de Transferencia</strong></td>
            <td><strong>:</strong></td>
            <td><?php echo substr($myData['cod_trans'],-2); ?></td>
        </tr>

        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>

        <tr>
            <td><strong>Estado de Pago</strong></td>
            <td><strong>:</strong></td>
            <td><strong><font color="red"><?php echo $myData['status']; ?></font><sup>*</sup></strong></td>
        </tr>

        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
  </tbody>
</table>
<table class="table table-bordered" >
  <thead>
    <tr>
      <th width="23" align="center" bgcolor="#CCCCCC"><strong>Nro</strong></th>
      <th width="76" bgcolor="#CCCCCC"><strong>Codigo</strong></th>
      <th width="324" bgcolor="#CCCCCC"><strong>Nombre de Producto</strong></th>
      <th width="132" align="right" bgcolor="#CCCCCC"><strong>Precio($)</strong></th>
      <th width="60" align="right" bgcolor="#CCCCCC"><strong>Cantidad</strong></th>
      <th width="122" align="right" bgcolor="#CCCCCC"><strong>Total($)</strong></th>
    </tr>
         <?php
      // Deklarasi variabel
      $subTotal = 0;
      $totalpoducto = 0;
      $totalenvio = 0;
      $totalprecio = 0;
      $total pagar =0;
      $unica_transfer =0;

      // SQL Menampilkan data Barang yang dipesan
    $sql = "SELECT producto.nm_producto, reserva_item.*
                FROM pemesanan, reserva_item
                LEFT JOIN producto ON reserva_item.cod_producto=producto.cod_producto
                WHERE reserva.numero_reserva=reserva_item.numero_reserva
                AND reserva.numero_reserva='$cod'
                ORDER BY reserva_item.kd_barang";
    $querry = mysql_query($sql, $coneciondb) or die ("error SQL".mysql_error());
    $no = 0;
    while ($mostrardatos = mysql_fetch_array($querry)) {
      $no++;
      // Menghitung subtotal precio (harga  * cantidad)
      $subTotal     = $mostrardatos['precio'] * $mostrardatos['cantidad'];

      // Mencantidad total semua precio
      $totalprecio   = $totalprecio + $subTotal;

      // Mencantidad item barang
      $totalproductos  = $totalproductos + $mostrardatos['cantidad'];
  ?>
  </thead>
  <tbody>
    <tr>
      <td><?php echo $no; ?></td>
      <td><strong><?php echo $mostrardatos['kd_barang']; ?></strong></td>
      <td><strong><?php echo $mostrardatos['nm_barang']; ?></strong></td>
      <td><strong>$ <?php echo format_angka($mostrardatos['precio']); ?></strong></td>
      <td><?php echo $mostrardatos['cantidad']; ?></td>
      <td><b>$ <?php echo format_angka($subTotal); ?></b></td>

    </tr>
        <?php }
//MEGNHITUNG LAGI
       
    // Total biaya Kirim = Biaya kirim x Total barang
    $totalenvio = $myData['envio'] * $totalproductos;
    
    $totalpagar = $totalprecio + $totalenvio;  
    
    $telefono  = substr($myData['telefonon'],-2); // ambil 3 digit terakhir no HP
    $unik_transfer = $totalpagar + $telefono;
        ?>
      <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5" align="right"><strong>Gasto Total ($) : </strong></td>
    <td align="right">$ <?php echo format_angka($totalprecio); ?></td>
  </tr>
 <tr>
    <td colspan="5" align="right"><strong>Gasto Envio ($) : </strong></td>
    <td colspan="5" align="right">$ <?php echo format_angka($totalenvio); ?></td>
  </tr>
   <tr>
    <td colspan="5" align="right"><strong>TOTAL  ($) : </strong></td>
    <td align="right">$<?php echo format_angka($totalpagar); ?></td>
  </tr>
  <tr>
    <td colspan="6" align="right" >Numero de <b>TRANSFERENCIA</b>:<font color="red"><b><?php echo format_angka($unik_transfer); ?></b> </font></td>
  </tr>
  </tbody>
</table>
<table class="table table-bordered" border="1">
    <thead>
        <tr>
          <td colspan="3" bgcolor="#CCCCCC"><strong>Nro. Cuenta <font color="red" align="center"><b>San Fernando Store/b></font> <font color="green"><b>SIT<b></font></strong></td>
        </tr>
    </thead>
    <tbody>
      <tr>
            <td colspan="2" width="20%"><img src="images/BCP.jpg"></td>
            <td><p><strong>  
            A/C          : 342 333 6699<br />
            A/N          : Luis Tobar<br />
            Direccion    : San Fernando, Chile</strong></p></td>
      </tr>
      <!--<tr>
           <td colspan="2" width="20%"><img src="images/mandiri2.png"></td>
           <td><p><strong>  
            A/C          : 166 0000 4902 43<br />
            A/N          : PT. RADJA BANGUNAN<br />
            CABANG       : PONDOK KELAPA, JAKARTA</strong></p></td>
      </tr>-->
    </tbody>
</table>
</div>
</div>
</body>
</html>
<?php
include_once "inc.session.php";
include_once "library/inc.connection.php";
include_once "library/inc.library.php";

// Baca Kode Pelanggan yang Login
$codigosesion	= $_SESSION['SES_COD'];
$nombre	= $_SESSION['SES_USERNAME'];

# TOMBOL SIMPAN DIKLIK
if(isset($_POST['btnpagar'])){
	$arrData = count($_POST['txtcantidad']);
	$qty = 1;
	for ($i=0; $i < $arrData; $i++) {
		# Melewati biar tidak 0 atau minus
		if ($_POST['txtcantidad'][$i] < 1) {
			$qty = 1;
		}
		else {
			$qty = $_POST['txtcantidad'][$i];
		}

		# Simpan Perubahan
		$codigo	= $_POST['txtcodigo'][$i];
		$fecha	= date('fecha');
	

		$sql = "UPDATE productos SET cantidad='$qty', fecha='$fecha'
				WHERE id_categoria='$codigo' AND id_clientes='$cod_cliente' AND nom_cliente='$nombre_cliente'";
		$query = mysql_query($sql, $koneksidb);
	}
	// Refresh
	echo "<meta http-equiv='refresh' content='2; url=?open=KeranjangBelanja'>";
	exit;
}

# MENGHAPUS DATA BARANG YANG ADA DI KERANJANG
// Membaca Kode dari URL
if(isset($_GET['accion']) and trim($_GET['accion'])!==""){
	// Membaca Id data yang dihapus
	$idHapus	= $_GET['accion'];

	// Menghapus data keranjang sesuai Kode yang dibaca di URL
	$mySql = "DELETE FROM tmp_carrito  WHERE id='$idHapus' AND id_cliente='$cod_cliente' AND nom_cliente='$nombre_cliente'";
	$myQry = mysql_query($mySql, $conexiondb) or die ("Eror hapus data".mysql_error());
	if($myQry){
		echo "<meta http-equiv='refresh' content='2; url=?open=Barang2'>";
	}
}

# MEMERIKSA DATA DALAM KERANJANG
$Sql = "SELECT * FROM tmp_carrito WHERE id_cliente='$cod_cliente' AND nom_cliente='$nombre_cliente'";
$cekQry = mysql_query($Sql, $conexiodb) or die (mysql_error());
$cekQty = mysql_num_rows($cekQry);
if($cekQty < 1){
	echo "<br><br>";
	echo "<center>";
	echo "<b> CARRITO DE COMPRA VACIO </b>";
	echo "<center>";

	// Jika Keranjang masih Kosong, maka halaman Refresh ke data Barang
	echo "<meta http-equiv='refresh' content='1; url=?page=Barang2'>";
	exit;
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Tienda Online</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet"/>
    <link href="assets/css/bootstrap-responsive.css" rel="stylesheet"/>
	<link href="assets/css/docs.css" rel="stylesheet"/>

    <link href="style.css" rel="stylesheet"/>
	<link href="assets/js/google-code-prettify/prettify.css" rel="stylesheet"/>

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
  <!-- Navbar
    ================================================== -->

<!-- ======================================================================================================================== -->

<!-- ==================================================Header End====================================================================== -->


	<div class="span9">
    <ul class="breadcrumb">
		<li><a href="index.html">Inicio</a> <span class="divider">/</span></li>
		<li class="active"> Carrito de Compras</li>
    </ul>
	<img src="images/compras_en_linea.png" width="900" height="41px">
	<hr class="soft"/>
	<form action="<?php $_SERVER['PHP_SELF']; ?>" METHOD="POST" target="_self">
	<table class="table table-bordered">
              <thead>
                <tr>
                  <th>Producto</th>
                  <th>Nombre Producto</th>
                  <th>Precio ($)</th>
				  <th>Cantidad</th>
                  <th colspan="2">Total</th>

				</tr>
				<?php
				// Menampilkan data Barang dari tmp_keranjang (Keranjang Belanja)
	$mySql = "SELECT id, file_images, categoria, tmp_carro.*
			FROM tmp_carrito
	

			WHERE tmp_carro.id_cliente='$idcliente'
			ORDER BY tmp_carro.id";
	$myQry = mysql_query($mySql, $coneciondb) or die ("Gagal SQL".mysql_error());
	$total = 0; $grandTotal = 0;
	$no	= 0;
	while ($myData = mysql_fetch_array($myQry)) {
	  $no++;
	  // Menghitung sub total harga
	  $total 		= $myData['precio'] * $myData['numero'];
	  $grandTotal	= $grandTotal + $total;

	  // Menampilkan gambar
	  if ($myData['file_gambar']=="") {
			$fileproducto = "assets/products/noimage.jpg";
	  }
	  else {
			$fileproducto	= $myData['file_pror'];
	  }

	  #Kode Barang
	  $Kode = $myData['id_cliente'];
	?>
              </thead>
              <tbody>
                <tr>
                  <td> <img width="60" src="assets/products/<?php echo $fileGambar; ?>" width="70" alt=""/></td>
                  <td><b><?php echo $myData['nm_barang']; ?> </b></td>

                  <td>$ <?php echo format_angka($myData['precio']); ?></td>
                  <td><input name="txtJum[]" type="text" value="<?php echo $myData['total']; ?>" width="2" >
               

                  <td> $ <?php echo format_angka($total); ?></td>
                  <td><a href="?open=KeranjangBelanja&aksi=Hapus&idHapus=<?php echo $myData['id']; ?>"><img src="images/hapus.gif" alt="Eliminar datos de Compra" width="16" height="16" border="0"></a></td>
                </tr>

                <?php } ?>
				 <tr>
                  <td colspan="4" align="right"><strong>TOTAL</strong></td>
                  <td class="label label-important" colspan="2"> <strong><?php echo "$".format_angka($grandTotal); ?> </strong></td>
                </tr>
                    <tr>
                            <td colspan="4">&nbsp;</td>
                            <td colspan="2"><input name="btnpagar" type="submit" value="VER TOTAL"></td>
                    </tr>
	</tbody>
	</form>
            </table>
        
	<a href="?open=Transaksi-Proses" class="btn btn-large pull-right">Siguiente <i class="icon-arrow-right"></i></a><br><BR>
<a href="?open=Barang2" class="btn btn-large pull-right"><i class="icon-arrow-left"></i> Seguir Comprando </a> <br /><BR>
        
			<table class="table table-bordered">
			<tbody>
                <tr><th colspan="2"><strong>ACTUALIZAR</strong> </th></tr>
                 <tr>
				 <td>
					<form class="form-horizontal">
		
					  <div class="control-group">
						<label class="span2 control-label" for="inputPost"><input name="" type="button" value="VER TOTAL"></label>
						<div class="controls">
						  <b>(Total) Pulse para ver la cantidad que se debe pagar de acuerdo a la cantidad que se ha actualizado</b>
						</div>
					  </div>
                        <!---
					  <div class="control-group">
						<div class="controls">
						  <button type="submit" class="btn">ESTIMATE</button>
						</div>-->
					  </div>
					</form>
				  </td>
				  </tr>
              </tbody>
            </table>
</div>
</div>

  </body>
</html>
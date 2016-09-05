<?php
include_once "library/inc.connection.php";
include_once "library/inc.library.php";

$filterSql	= "";
// Membaca variabel form
$KeyWord	= isset($_GET['KeyWord']) ? $_GET['KeyWord'] : '';
$txtKeyword	= isset($_POST['txtKeyword']) ? $_POST['txtKeyword'] : $KeyWord;

// Jika tombol Cari diklik
if(isset($_POST['btnCari'])){
	if($_POST) {
         // Skrip pencarian
		$filterSql = "WHERE cod_producto LIKE '%$txtKeyword%' OR nombre_producto LIKE '$txtKeyword%'";
	}
}
else {
	if($KeyWord){
         // Skrip pencarian
		$filterSql = "WHERE cod_producto LIKE '%$txtKeyword%' OR nombre_producto LIKE '$txtKeyword%'";
	}
	else {
		$filterSql = "";
	}
}

# Nomor Halaman (Paging)
$baris	= 10;
$hal 	= isset($_GET['caso']) ? $_GET['caso'] : 1;
$pageSql= "SELECT * FROM producto $filterSql ORDER BY cod_producto DESC";
$pageQry= mysql_query($pageSql, $conectaridb) or die ("error : ".mysql_error());
$jml	= mysql_num_rows($pageQry);
$maks	= ceil($jml/$baris);
$mulai	= $baris * ($caso-1);
?>
<html>
<head>
<title></title>
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
    <link rel="stylesheet" type="text/css" href="admin/styles_user.css">
    <link rel="shortcut icon" href="assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

</head>
<body>
<div>
<table width="75%" border="0" cellspacing="1" cellpadding="3">
  <tr>
    <td colspan="2" align="center" bgcolor="#CCCCCC" scope="col"><strong>RESULTADOS DE LA BÚSQUEDA </strong> " <?php echo $txtKeyword; ?> "</td>
  </tr>
<?php
// Menampilkan daftar producto
$producto2Sql = "SELECT producto.*,  categoria.cod_categoria FROM producto
			LEFT JOIN categoria ON producto.cod_categoria=categoria.cod_categoria
			$filterSql
			ORDER BY producto.cod_producto ASC LIMIT $mulai, $baris";
$producto2Qry = mysql_query($producto2Sql, $koneksidb) or die ("error".mysql_error());
$nomor = 0;
while ($producto2Data = mysql_fetch_array($producto2Qry)) {
  $nomor++;
  $codproducto = $producto2Data['cod_producto'];
  $codcategoria = $producto2Data['cod_categoria'];

  // Menampilkan gambar utama
  if ($producto2Data['file_precio']=="") {
		$fileGambar = "noimage.jpg";
  }
  else {
		$fileGambar	= $producto2Data['file_precio'];
  }

// Warna baris data
if($nomor%2==1) { $warna=""; } else {$warna="#F5F5F5";}
?>
  <tr>
    <td width="24%" align="center">
		<a href="?open=producto-Lihat&Kode=<?php echo $codproducto; ?>">
		<img src="assets/products/<?php echo $fileGambar; ?>" width="100" border="0"> </a> <br>
		<div class='harga'>$ <?php echo format_angka($producto2Data['harga_jual']); ?> </div> <br>
		<a href="?open=producto-Beli&Kode=<?php echo $codproducto; ?>" class="btn btn-small"><i class=" icon-shopping-cart"></i> Agregar al Carrito</a>
    <td width="76%" valign="top">
		<a href="?open=producto-Lihat&Kode=<?php echo $codproducto; ?>">
	  <div class='judul'> <font color="red"><strong><?php echo $producto2Data['cod_producto']; ?></strong></font> </div> </a>
		<p><?php echo substr($producto2Data['keterangan'], 0, 200); ?> ....</p>
		<p><strong>Stock :</strong> <?php echo $producto2Data['stock']; ?></p>
	<strong>Categoria :</strong> <?php echo $producto2Data['cod_categoria']; ?>	</td>
  </tr>
<?php } ?>
  <tr>
    <td colspan="2" align="center"><b>Paginas:
      <?php
	for ($h = 1; $h <= $maks; $h++) {
			echo "[  <a href='?open=productoPencarian&KeyWord=$txtKeyword&caso=$h'>$h</a> ]";
	}
	?>
    </b></td>
  </tr>
</table>
</div>
</div
</body>
</html>

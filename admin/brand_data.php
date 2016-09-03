<?php
// Validasi supaya yang mengakses hanya Admin (yang sudah login)
include_once "../library/inc.sesadmin.php";
?>
<table width="800" border="0" cellpadding="2" cellspacing="1" class="table-border">
  <tr>
    <td colspan="2" align="right"><h1>DATA BRAND</h1></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="right"><a href="?open=Brand-Add" target="_self"><img src="../images/btn_add_data.png" border="0" /></a></td>
  </tr>

  <tr>
    <td colspan="2">
    <table class="table-list" width="100%" border="0" cellspacing="1" cellpadding="2">
      <tr>
        <th width="35" align="center" bgcolor="#CCCCCC">No</th>
        <th width="550" bgcolor="#CCCCCC">Nama Brand</th>
        <th width="400" bgcolor="#CCCCCC">Alamat</th>
        <td colspan="2" align="center" bgcolor="#CCCCCC"><strong>Tools</strong></td>
      </tr>
    <?php
    $mySql = "SELECT * FROM brand ORDER BY no_brand ASC";
    $myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
    $nomor  = 0;
    while ($myData = mysql_fetch_array($myQry)) {
        $nomor++;
        $Kode = $myData['kd_brand'];
    ?>
      <tr>
        <td align="center"><?php echo $nomor; ?></td>
        <td><?php echo $myData['nm_brand']; ?></td>
        <td><?php echo $myData['alamat']; ?></td>
        <td width="44" align="center"><a href="?open=Brand-Edit&Kode=<?php echo $Kode; ?>" target="_self" alt="Edit Data">Edit</a></td>
        <td width="44" align="center"><a href="?open=Brand-Delete&Kode=<?php echo $Kode; ?>" target="_self" alt="Delete Data" onclick="return confirm('ANDA YAKIN INGIN MENGHAPUS DATA KATEGORI INI ... ?')">Delete</a></td>
      </tr>
      <?php } ?>
    </table></td>
  </tr>
</table>

<?php
include_once "../library/inc.sesadmin.php";   // Validasi, mengakses halaman harus Login
include_once "../library/inc.connection.php"; // Membuka koneksi
include_once "../library/inc.library.php";    // Membuka librari peringah fungsi

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$baris = 50;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM prov";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jumlah	 = mysql_num_rows($pageQry);
$maksData= ceil($jumlah/$baris);
?>
<table width="800" border="0" cellpadding="2" cellspacing="1" class="table-common">
    <tr>
        <td colspan="2" align="right"><h1><b>DATOS DEPARTAMENTOS</b></h1></td>
    </tr>

    <tr>
        <td colspan="2"></td>
    </tr>
    <tr>
        <td colspan="2" align="right"><a href="?open=Prov-Add" target="_self"><img src="../images/btn_add_data.png" height="30" border="0" /></a></td>
    </tr>
    <tr>
        <td colspan="2">
            <table class="table-list" width="100%" border="0" cellspacing="1" cellpadding="2">
                <tr>
                    <th width="26" align="center" bgcolor="#CCCCCC"><strong>Nro</strong></th>
                    <th width="88" align="center" bgcolor="#CCCCCC"><strong>ID Dep</strong></th>
                    <th width="20" bgcolor="#CCCCCC"><strong>Nombre Departamento</strong></th>
                    <td colspan="2" align="center" bgcolor="#CCCCCC"><strong>Herramientas</strong></td>
                </tr>
                <?php
                $mySql = "SELECT id_prov,nama_prov FROM prov ORDER BY id_prov ASC LIMIT $hal, $baris";
                $myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
                $nomor = $hal;
                while ($myData = mysql_fetch_array($myQry)) {
                    $nomor++;
                    $Kode = $myData['id_prov'];
                    ?>
                    <tr>
                        <td align="center"><?php echo $nomor; ?></td>
                        <td align="center"><?php echo $myData['id_prov']; ?></td>
                        <td><?php echo $myData['nama_prov']; ?></td>
                        <td width="44" align="center"><a href="?open=Prov-Edit&Kode=<?php echo $Kode; ?>" target="_self" alt="Edit Data">Editar</a></td>
                        <td width="42" align="center"><a href="?open=Prov-Delete&Kode=<?php echo $Kode; ?>" target="_self" alt="Delete Data" onclick="return confirm('Seguro que va ELIMINAR ESTE DEPARTAMENTO... ?')">Eliminar</a></td>
                    </tr>
                <?php } ?>
            </table></td>
    </tr>
    <tr class="selKecil">
        <td width="407"><b>Numero de Datos :</b> <?php echo $jumlah; ?> </td>
        <td width="384" align="right"><b>Pagina de :</b>
            <?php
            for ($h = 1; $h <= $maksData; $h++) {
                $list[$h] = $baris * $h - $baris;
                echo " <a href='?open=Prov-Data&hal=$list[$h]'>$h</a> ";
            }
            ?></td>
    </tr>
</table>

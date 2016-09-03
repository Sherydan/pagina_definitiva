<?php
/**
 * Created by PhpStorm.
 * User: herry.prasetyo
 * Date: 4/21/2015
 * Time: 11:50 AM
 */
require "library/inc.connection.php";

function barang_get(){
    $listbarang= "SELECT * FROM barang";
    $qryBarang =mysql_query($listbarang, $koneksidb);

}
?>



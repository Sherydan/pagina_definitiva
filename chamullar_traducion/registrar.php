<?php

/*
**date 		: 27/04/2016
**author 	: Herry Prasetyo Noor Wibowo
**time 		: 2:21pm 

*/
include_once "library/inc.connection.php";
include_once "library/inc.library.php";

//FUNCTION 
function randomcode($len="10"){
	global $pass;
	global $lchar;

$code= NULL;
for($i=0; $i<$len; $i++){
		$char=chr(rand(48,122));
		while (!preg_match("/[a-zA-Z0-9]/", $char)) {
			if($char == $lchar) {continue;}
			$char =chr(rand(48,90));
		}
		$pass .=$char;
		$lchar=$char;
	}
	return $pass;
}

//JIKA PENYIMPANAN SUKSES
i


//membuat validasi pada form hh
$error_tuh="";
if (isset($_POST['btnRegister'])) {
$pesanError = array();
    //MEMBERIKAN VARIABEL UNTUK SEMUA FORM
    $txtnombre		  = $_POST['txtnombre'];
    $txtnombre		   	= str_replace("'", "&acute;", $txtNamaLengkap);

    $txtapellido			= $_POST['txtapellido'];
    $txtapellido		  = str_replace("'", "&acute;", $txtlastName);

    $txtUsuario			 = $_POST['txtusuario'];
    $cmbgenero			  = $_POST['cmbgenero'];
    $txtAlamat 				= $_POST['txtdireccion'];	
    $txtcalular				= $_POST['txtcelular'];
    $pais				       = $_POST['pais'];
    $comuna            = isset($_POST['comuna'])? $_POST['propinsi'] : '';
    $ciudad     			 =$_POST	['ciudad'];
    $txttelefono			 =$_POST['txttelefonofijo'];
    $txtPassword 			 = $_POST['txtPassword'];
    $txtKodepos				 =$_POST['txtKodepos'];
	  $txtKodepos				 ="00051";
    $txtEmail				   =$_POST['txtEmail'];
    


   
//BACA VARIABEL form
    $txtNamaLengkap = htmlspecialchars(stripslashes(trim($_POST['txtNamaLengkap'])));
   if ($txtNamaLengkap == "") {
   	$error_tuh = "Porfavor, Complete el campo Nombre";
   }else {

   }
	

//VALIDASI USERNAME, Tidak boleh ada yang kembar
	$sql= "SELECT * FROM cliente WHERE username ='$txtusuario' AND email='$txtEmail'";
	$sqlQuery = mysql_query($sql,$coneciondb)or die("error".mysql_error());
	$adaCek	=mysql_num_rows($sqlQuery);
	if ($adaCek >=1) {
		$pesanError[]= "ERROR!!! Usuario <b>$txtUsername</b> Existente, intente con otro nombre";
	}


	if (count($pesanError)>=1 ){
		echo "<div class='mssgBox'>";
		echo "<img src='images/attention.png'> <br><hr>";
			echo "</div> <br>"; 

			} 
		
	else {
		$subjek ="Codigo de Activacion";
$kodeAktivasi= randomcode();
$Kepada = $_POST['txtUsuario'];
$link=
"http://radjabangunan.net84.net/?open=Aktivasi&code=$kodeAktivasi";
$pesan="Hola $_POST[txtUsuario],
Gracias por unirse a San fernando store . Disfrute de la experiencia de compras en línea con nosotros es seguro y conveniente, así de rápido.
Puede ponerse en contacto con nosotros si tiene alguna pregunta. Estamos dispuestos a ayudarle.
Por favor, haga clic en este enlace para activar su cuenta. 
$link


Saludos Cordiales, 

San fernando Store

";
$from="from : aiep@gmail.com";
		#script untuk menyimpan data kedalam database
		
		$cliente = buatkode("cliente","P");
		$fecha	=date('Y-m-d');

		$mySql ="INSERT INTO clientes (nombre,apellidos,genero,direccion,email,ciudad,provincia,pais,celular,telefono,usuario,email,clave) 
			VALUES('$nombre','$txtapellidop','$cmbgenero','$txtdireccion','$txtemail','$txtciudad','$txtprov','$pais','$celular','$telefono','$txtUsuario','$txtemail','$txtPassword')";
		$myQry = mysql_query($mySql,$coneciondb) or die("error registro".mysql_error());
		if ($myQry) {
			# code...
			echo "<meta http-equiv='refresh' content='0; url=?open=SuccessRegistration'>";
		}
		exit;
	}

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
	
	<script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
		<script type="text/javascript">
var htmlobjek;
$(document).ready(function(){

$("#registrar").click(function(){


var midireccion=$("#txtdireccion").val();
  var expr = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;

    var miemail = $("#txtEmail").val();
   $("#message").html("");

if ($("#jeniskelamin option:selected").val() == 0) {
      $("#message").html("<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Por favor seleccione su genero</div>");

  }else if (midireccion == "") {
      $("#message").html("<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Por favor seleccione algun direccion(domicilio)</div>");

  }else if ($("#comuna option:selected").val() == 0) {
      $("#message").html("<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Por favor seleccione alguna Ciudad</div>");

  }else if ($("#ciudad option:selected").val() == 0) {
      $("#message").html("<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Por favor seleccione alguna Comuna</div>");

  }else if ($("#pais option:selected").val() == 0) {
      $("#message").html("<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Por favor seleccione algun Pais</div>");

  }else if (miemail == "" || !expr.test(miemail)) {
      $("#message").html("<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button> Por favor ingrese email valido</div>");



  }
    else {
    
    
      
  //apabila terjadi event onchange terhadap object <select id=propinsi>
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
            var response = text.substr(text.length - 4);

          if(response == ""){
        
            $("#message").html(html);
            $('#registrar').hide();
            }
        else {
            $("#message").html(html);
            $('#registrar').show();
            } 

 return false;

  }


});
});

function justNumbers(e)
        {
        var keynum = window.event ? window.event.keyCode : e.which;
        if ((keynum == 8) || (keynum == 46))
        return true;
         
        return /\d/.test(String.fromCharCode(keynum));
        }

 function soloLetras(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
       especiales = "8-37-39-46";

       tecla_especial = false
       for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
    }

</script>

  </head>
<body>
	<div class="span9">
    <ul class="breadcrumb">
		<li><a href="index.php">Inicio</a> <span class="divider">/</span></li>
		<li class="active">Crear Cuenta: Nuevo Cliente</li>
    </ul>
	<h3> Registrar Nueva Cuenta </h3>
	<hr class="soft"/>
	<div class="well">
	<div class="alert alert-info">
		
		<strong>Bienvenidos</strong>  <font face="comic sans">En San fernando Store en línea, servicios de comercio electrónico.
Estamos dispuestos a servirle para conseguir una experiencia de compra agradable de productos electronicos y otras categorías.
Para simplificar el proceso de pedido, debe registrarse en el siguiente formulario.</font></div>
	 <div class="alert alert-block alert-error fade in">
		
		<strong>  Es importante recordar</strong> <font face="comic sans">Por favor, rellene los datos para el nombre, la dirección y el contacto puede contactarse forma más completa posible para que podamos procesar envíos.</font>
	 
	 </div>
	<form class="form-horizontal" name="form1" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" target="_self" >
		<h3>Datos Personales</h3>
		<div class="control-group">
		
			<label class="control-label" for="inputFname">Nombre <sup>*</sup></label>
			<div class="controls">
				<div style="color:red"><?php echo $error_tuh; ?></div>
			  <input type="text" id="txtNamaLengkap" maxlength="40"  name="txtNamaLengkap" onkeypress="return soloLetras(event)" value="<?php echo $dataNama; ?>"   placeholder="Nombre" class="form-control" required >
			
		 </div>
		 </div>
            
		 <div class="control-group">
            <label class="control-label" for="inputFnameLast">Apellidos<sup>*</sup></label>
             <div class="controls">
                 <input type="text" id="txtlastName" maxlength="40" name="txtlastName" onkeypress="return soloLetras(event)" value="<?php echo $dataLast; ?>" placeholder="Apellidos" required>
             </div>
        </div>
            
		 	
        <div class="control-group">
            <label class="control-label" for="dob">Género<sup>*</sup></label>
            <div class="controls">
                <select class="span2" id="jeniskelamin" name="cmbGender" required>
                    <option value="0">-Género-</option>
                  <?php
                  $pilihan  = array("Masculino","Femenino");
                  	foreach ($pilihan as $nilai) {
                  		if ($nilai==$dataKelamin) {
                  			$cek ="selected";
                  	}else { $cek = "";}
                  	echo "<option value='$nilai' $cek>$nilai</option>";
                  }
                  ?>
                </select>
                <?php echo isset($pesanError['cmbGender']) ? $pesanError['cmbGender'] : '';?>
            </div>
        </div>
		
		<div class="control-group">
			<label class="control-label" for="adress">Dirección<sup>*</sup></label>
			<div class="controls">
			  <input type="text" name="txtAlamat" maxlength="50"   id="txtAlamat"  value="<?php echo $dataAlamat; ?>" placeholder="Dirección" required> <span>Domicilio,Calle,barrio,Dirección de la empresa, etc</span>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="city" >Ciudad<sup>*</sup></label>
			<div class="controls">
				<select type="text" id="propinsi" name="prov" value="">
                            <option value="0">-Seleccione Ciudad-</option>
                        <?php
						//MENGAMBIL NAMA PROVINSI YANG DI DATABASE
						$propinsi =mysql_query("SELECT * FROM ciudad ORDER BY nom_ciudad");
						while ($dataProvinsi=mysql_fetch_array($propinsi)) {
							echo "<option value=\"$dataProvinsi[id_ciudad]\">$dataProvinsi[monbre]</option>\n";
						}
					?>
                        </select>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="state" >Ciudad / Provincia<sup>*</sup></label>
			<div class="controls">
			 <select type="text" id="kota" name="kota">
                        <option value="0">-Seleccione Region-</option>
                        <?php
                        //MENGAMBIL NAMA KOTA DI DATABASE
                        $region=@mysql_query("SELECT * FROM region ");
                        while ($dataregion=mysql_fetch_array($region)) {
                            if ($dataregion['id_region']==$id['id_region']) {
                                $cek ="selected";
                            }
                            else{
                                $cek ="";
                            }
                            echo "<option value='$dataKota[id_region]' $cek>$dataKota[mobre_region]</option>\n";
                        }
                        ?>
                    </select>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="country">Pais<sup>*</sup></label>
			<div class="controls">
			  <select type="text" id="kec" name="kec" >
				<option value="0">-Seleccionar Pais-</option>
				<option value="1">Chile </option>
			    <option value="1">Argentina </option>
			     <option value="1">Brasil </option>
			      <option value="1">Peru </option>
			       <option value="1">Bolivia</option>
			</select>
			</div>
		</div>
        <!--<div class="control-group">
            <label class="control-label" for="postcode">Codigo Postal<sup>*</sup></label>
            <div class="controls">
                <input type="text" name="txtKodepos" id="postcode"  placeholder="Codigo Postal" required>
            </div>
        </div>-->
	
		<div class="control-group">
			<label class="control-label" for="phone">Celular <sup>*</sup></label>
			<div class="controls">
			  <input type="text"  name="txtPhone" id="phone" placeholder="Celular" onkeypress="return justNumbers(event);" required> <span>Usted debe registrarse al menos un número de Teléfono o Celular</span>
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label" for="mobile">Telefono Fijo<sup>*</sup></label>
			<div class="controls">
			  <input type="text"  name="txtMobile"  id="mobile" onkeypress="return justNumbers(event);" placeholder="Telefono" required />
			</div>
		</div>

        <h3>Datos para Inicio de Sesión</h3>
        <div class="control-group">
        	<label class="control-label" for="inputUsername">Nombre de Usuario<sup>*</sup></label>
        	<div class="controls">
        		<input type="text" name="txtUsername" maxlength="20"  id="inputUsername" placeholder="Usuario" required>
        	</div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputEmail">Email <sup>*</sup></label>
            <div class="controls">
                <input type="text" name="txtEmail" id="txtEmail" maxlength="70" placeholder="Correo Electronico" >
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputPassword">Contraseña <sup>*</sup></label>
            <div class="controls">
                <input type="password" name="txtPassword" id="claves" maxlength="10" id="inputPassword" placeholder="Contraseña" required>
            </div>
        </div>
       <div >
            <label class="control-label" for="inputPassword">&nbsp; </label>
            <div class="controls">
                &nbsp;
            </div>
        </div>
         <div>
            <label class="control-label" for="inputPassword">&nbsp; </label>
            <div class="controls">
                &nbsp;
                           </div>
        </div>
         <div >
            <label class="control-label" for="inputPassword">&nbsp;</label>
            <div class="controls">
               
            </div>
        </div>
         <div >
            <label class="control-label" for="inputPassword">&nbsp;</label>
            <div class="controls">
                &nbsp;
            </div>
        </div>
        <p><sup>(*)</sup>Campos Obligatorios</p>
	
	<div class="control-group">
	<div id="message"></div>
			<div class="controls">
				<input type="hidden" name="email_create" value="1">
				<input type="hidden" name="is_new_customer" value="1">
				<input class="btn btn-large" type="submit" id="registrar" name="btnRegister" value="Registrarse" />
			</div>
		</div>		
	</form>
</div>

</div>
</div>

</div>
  </body>
</html>
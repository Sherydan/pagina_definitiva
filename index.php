<?php
session_start();
include_once "library/inc.connection.php";
include_once "library/inc.library.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
   <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <meta charset="utf-8">
    <title>San Fernando Store</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="San Fernando Store">
    <meta name="author" content="platea21">
	<!-- Less styles  
	<link rel="stylesheet/less" type="text/css" href="less/bootsshop.less">
	<script src="less.js" type="text/javascript"></script>
	 -->
<!-- Start WOWSlider.com HEAD section -->

<link rel="stylesheet" type="text/css" href="engine1/style.css" />
<script type="text/javascript" src="engine1/jquery.js"></script>
<!-- End WOWSlider.com HEAD section -->
    <!-- Le styles  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet"/>
    <link href="assets/css/bootstrap-responsive.css" rel="stylesheet"/>
	<link href="assets/css/docs.css" rel="stylesheet"/>
      
     

    <link href="style.css" type="text/css" rel="stylesheet"/>
	<link href="assets/js/google-code-prettify/prettify.css" rel="stylesheet"/>

	
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="assets/img/main_logo.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
  </head>
<body>
<!-- header -->
<div class="container"> 
<div class="header">
   <div class="headertop_desc">
     <div class="call">
     <p><span>Necesita ayuda?</span> LLamar <span class="number">+569-99675432</span></span></p>

<div class="container"> 

<div class="account_desc">
        <ul>
          <li><a href="signup.php">Registrarse</a></li>
          <li><a href="#">Entregas</a></li>
          <li><a href="#">Mi cuenta</a></li>
          <li><a href="login_out.php">Salir</a></li>
        </ul>
      </div>
</div>

     </div>

   </div>

 </div>

</div>



 



<!--fin header -->

  <!-- Navbar
    ================================================== -->
    <div class="container">
      <div class="navbar navbar-inverse" role="navigation">
              <div class="navbar-inner">
                <div class="container">
          <a id="logoM" href="index.php"></a>
                  <a data-target="#sidebar" data-toggle="collapse" class="btn btn-navbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </a>
                  <div class="nav-collapse">
                    <ul class="nav">
            <li class=""><a href="index.php">Inicio </a></li>
            <li class=""><a href="?open=Barang-Produk">Productos</a></li>
            <li class=""><a href="?open=About">Acerca</a></li>
            <li class=""><a href="?open=Contact-Us">Contactos</a></li>
            <li class=""><a href="#">Noticias</a></li>
          </ul>
          
        <div id="nombre">       
        
       <span> Usuario  </span> 
          
        </div> 
        <div id="nombre2">
         <?php include_once "inc.login_status.php"; ?>
        </div>
                  </div><!-- /.nav-collapse -->
                </div>
              </div><!-- /navbar-inner -->
            </div>



    </div>

<!-- ======================================================================================================================== -->	
<div id="mainBody" class="container">
<header id="header">
<div class="row">
<div class="span12">
<a id="logoM" href="index.php"><img id="hola" src="assets/img/main_logo.png"></a> 
<form id="formulario" action="?open=BarangPencarian" method="POST" name="form1" class="navbar-search pull-left">
<input name="txtKeyword" id="srchFld" type= "text" size="30" placeholder="Buscar......" class="w3-input"/> 
<button type="submit" class="btn btn-primary" name="btnCari" value="Buscar">Buscar</button>        
</form>  
  <!--INICIO MSJE BIENVENIDA -->
  <div class="container">
  <div class="msje_bienvenida"> 
  <h2 id="titulo" > Bienvenido a San Fernando Store </h2>

  </div>


   </div>

   <!--FIN MSJE BIENVENIDA -->
<div class="pull-right"> <br/>
<!--- ============ pojok kanan Atas
	<a href="product_summary.html"> <span class="btn btn-mini btn-warning"> <i class="icon-shopping-cart icon-white"></i> [ 3 ] </span> </a>
	<a href="product_summary.html"><span class="btn btn-mini active">$155.00</span></a> -->
<!-- ============== Hula-hula	
	<span class="btn btn-mini">&pound;</span>
	<span class="btn btn-mini">&euro;</span>======== --> 
</div>
</div>
</div>
<div class="clr"></div>
</header>
<!-- ==================================================Header End====================================================================== -->
<!-- ============================ SLIDE KONTEN ============================ -->
	
	<!-- ISI KONTEN -- >
		  <!-- ============================ SLIDE KONTEN END ============================ -->

	<!-- Sidebar ================================================== -->
	<div class="row">
	<?php include "sidebar.php"; ?>
	<?php include_once "login.php"; ?>
	</div>
 
<!-- Sidebar end=============================================== -->

<!--     ISI KONTEN ===================== ----------->
	<?php require "buka_file.php"; ?><br><br><br>
	<!----------------- konten end ================================ --->
<!-- Footer ------------------------------------------------------ -->
		<?php require "footer.php"; ?>
<!--<script type="text/javascript" data-cfasync="false">(function () { var done = false;var script = document.createElement('script');script.async = true;script.type = 'text/javascript';script.src = 'https://app.purechat.com/VisitorWidget/WidgetScript';document.getElementsByTagName('HEAD').item(0).appendChild(script);script.onreadystatechange = script.onload = function (e) {if (!done && (!this.readyState || this.readyState == 'loaded' || this.readyState == 'complete')) {var w = new PCWidget({ c: 'd172da01-7f06-4297-b8c5-8b92bf4966c2', f: true });done = true;}};})();</script>-->
<script type='text/javascript' data-cfasync='false'>window.purechatApi = { l: [], t: [], on: function () { this.l.push(arguments); } }; (function () { var done = false; var script = document.createElement('script'); script.async = true; script.type = 'text/javascript'; script.src = 'https://app.purechat.com/VisitorWidget/WidgetScript'; document.getElementsByTagName('HEAD').item(0).appendChild(script); script.onreadystatechange = script.onload = function (e) { if (!done && (!this.readyState || this.readyState == 'loaded' || this.readyState == 'complete')) { var w = new PCWidget({c: 'a8c9e38f-a5f5-46d6-9a1a-7a003d4be81d', f: true }); done = true; } }; })();</script>
  </body>
</html>
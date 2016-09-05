<?php

session_start();
if (isset($_SESSION["user"])) {
  header("location:index.php");
}

?>

<!DOCTYPE HTML>
<head>
<title>San Fernando Store</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/slider.css" rel="stylesheet" type="text/css" media="all"/>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script type="text/javascript" src="js/startstop-slider.js"></script>
<link href="css/bootstrap.css" rel="stylesheet" media="screen">
<link href="css/main.css" rel="stylesheet" media="screen">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
</head>
<body>
  <div class="wrap">
	<div class="header">
		<div class="headertop_desc">
			<div class="call">
    <p><span>Necesita ayuda?</span> LLamar <span class="number">+569-99675432</span></span></p>
			</div>
			<div class="account_desc">
				<ul>
				
					<li><a href="#">Ingresar</a></li>
					<li><a href="#">Entregas</a></li>
					<li><a href="#">Mi cuenta</a></li>
				</ul>
			</div>
			<div class="clear"></div>
		</div>
		<div class="header_top">
			<div class="logo">
				<a href="index.html"><img src="images/logo4.png" alt="" /></a>
			</div>
			  <div class="cart">
			  	   <p>Bienvenido a San Fernando Store! <span>Tarjeta:</span><div id="dd" class="wrapper-dropdown-2"> 0 item(s) - $0.00
			  	   	<ul class="dropdown">
							<li>no tienes item en tu tarjeta</li>
					</ul></div></p>
			  </div>
			  <script type="text/javascript">
			function DropDown(el) {
				this.dd = el;
				this.initEvents();
			}
			DropDown.prototype = {
				initEvents : function() {
					var obj = this;

					obj.dd.on('click', function(event){
						$(this).toggleClass('active');
						event.stopPropagation();
					});	
				}
			}

			$(function() {

				var dd = new DropDown( $('#dd') );

				$(document).click(function() {
					// all dropdowns
					$('.wrapper-dropdown-2').removeClass('active');
				});

			});

		     </script>
	 <div class="clear"></div>
  </div>
	<div class="header_bottom">
	     	<div class="menu">
	     		<ul>
			        <li class=><a href="index.html">Inicio</a></li>
			    	<li><a href="about.html">Acerca de Nosotros</a></li>
			    	<li><a href="delivery.html">Envio</a></li>
			    	<li><a href="news.html">Noticias</a></li>
			    	<li><a href="contact.html">Contacto</a></li>
			    	<div class="clear"></div>
     			</ul>
	     	</div>
	     	<div class="search_box">
	     		<form>
	     			<input type="text" value="Buscar" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}"><input type="submit" value="">
	     		</form>
	     	</div>
	     	<div class="clear"></div>
	     </div>	     

		

 <div class="container">

      <form class="form-signin" name="form1" method="post" action="checklogin.php">
        <h2 class="form-signin-heading">Iniciar Sesión</h2>
        <input name="myusername" id="myusername" type="text" class="form-control" placeholder="Usuario" autofocus>
        <input name="mypassword" id="mypassword" type="password" class="form-control" placeholder="Clave">
        <!-- The checkbox remember me is not implemented yet...
        <label class="checkbox">
          <input type="checkbox" value="remember-me"> Remember me
        </label>
        -->
        <button name="Submit" id="submit" class="btn btn-lg btn-primary btn-block" type="submit">Ingresar</button>

        <div id="message"></div>
      </form>

    </div> <!-- /container -->
   <div class="footer">
   	  <div class="wrap">	
	     <div class="section group">
				<div class="col_1_of_4 span_1_of_4">
						<h4>Informacion</h4>
						<ul>
						<li><a href="about.html">Acerca</a></li>
						<li><a href="contact.html">Servicio al Cliente</a></li>
						<li><a href="#">Busqueda Ananzada</a></li>
						<!--<li><a href="delivery.html">Orders and Returns</a></li>-->
						<li><a href="contact.html">Contacto</a></li>
						</ul>
					</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>Como Comprar con nosotros</h4>
						<ul>
						<li><a href="about.html">Acerca</a></li>
						<li><a href="contact.html">Servicios</a></li>
						<li><a href="#">Politica de Privacidad</a></li>
					<!--<li><a href="delivery.html">Orders and Returns</a></li>-->
						<li><a href="#">Buscar Terminos</a></li>
						</ul>
				</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>Mi Cuenta</h4>
						<ul>
							<li><a href="contact.html">Registrarse</a></li>
							<li><a href="index.html">Ver Tarjeta</a></li>
					        <li><a href="#">Ver mis ordenes</a></li>
							<li><a href="contact.html">Ayuda</a></li>
						</ul>
				</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>Contact0</h4>
						<ul>
							<li><span>+569-99675432</span></li>
							<li><span>+569-99675435</span></li>
						</ul>
						<div class="social-icons">
							<h4>Siguenos en:</h4>
					   		  <ul>
							      <li><a href="#" target="_blank"><img src="images/facebook.png" alt="" /></a></li>
							      <li><a href="#" target="_blank"><img src="images/twitter.png" alt="" /></a></li>
							      <li><a href="#" target="_blank"><img src="images/skype.png" alt="" /> </a></li>
							      <li><a href="#" target="_blank"> <img src="images/dribbble.png" alt="" /></a></li>
							      <li><a href="#" target="_blank"> <img src="images/linkedin.png" alt="" /></a></li>
							      <div class="clear"></div>
						     </ul>
   	 					</div>
				</div>
			</div>			
        </div>
        <div class="copy_right">
				<p>Compañia San fernando Store  © All rights Reseverd | Design by  <a href="#">Ingenieria Informatica AIEP 2016</a> </p>
		   </div>
    </div>
    <script type="text/javascript">
		$(document).ready(function() {			
			$().UItoTop({ easingType: 'easeOutQuart' });
			
		});
	</script>
    <a href="#" id="toTop"><span id="toTopHover"> </span></a>
</body>
</html>


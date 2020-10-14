<?
include("./cnx/swgc-mysql.php");
include("./pla/blg.php");
if(!$_GET['tCodSeccion'])
{
    print '<script>window.location="/es/inicio/";</script>';
}

$tBaseImagen = "http://app.modelosnancy.design/cla/";

$bChat = false;


$bPaypal = false;
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<title>Modelos NANCY [<?=ucwords(str_replace("-"," ",$_GET['tCodSeccion']));?>]</title>
	<!-- Meta tag Keywords -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8" />
	<meta name="keywords" content="Modelos, NANCY, modelos nancy, vestidos, xv, bodas" />
	<script>
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!-- //Meta tag Keywords -->

	<!-- Custom-Files -->
	<!--<link rel="stylesheet" href="/css/bootstrap.css">-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<!-- Bootstrap-Core-CSS -->
	<link rel="stylesheet" href="/css/style.css" type="text/css" media="all" />
	<!-- Style-CSS -->
	<link rel="stylesheet" href="/css/font-awesome.css">
	<!-- Font-Awesome-Icons-CSS -->
	<!-- //Custom-Files -->

	<!-- Web-Fonts -->
	<link href="//fonts.googleapis.com/css?family=Hind:300,400,500,600,700&amp;subset=devanagari,latin-ext" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=latin-ext"
	 rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Great+Vibes&amp;subset=latin-ext" rel="stylesheet">
	<!-- //Web-Fonts -->
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  
  <style>
#overlay {
  position: fixed;
  display: none;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0,0,0,0.7);
  z-index: 2;
  cursor: pointer;
}

#text{
  position: absolute;
  top: 50%;
  left: 50%;
  
  color: white;
  transform: translate(-50%,-50%);
  -ms-transform: translate(-50%,-50%);
}
</style>

</head>
<!-- main-banner-w3ls -->
<body style="background:#000 !important">

    <!--overlay-->
    <div id="overlay" >
      <div id="text">
          <video width="90%" controls>
  <source src="/promo.mp4" type="video/mp4">
  Tu navegador no soporta la reproducci&oacute;n de videos.
</video>
     <label><input type="checkbox" id="bVideo" value="1" onclick="ocultarVideo()"> No volver a mostrar</label>
          <button type="button" class="btn btn-default" onclick="off()">Cerrar</button>
      </div>
    </div>
    <!--/overlay-->
	<!-- banner -->
	<div class="<?=(($_GET['tCodSeccion']!="inicio") ? 'main-banner-w3l-2':'main-banner-w3ls');?>">
		<!-- header -->
		<header>
			<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
				<a class="navbar-brand" href="/es/inicio/">
					<img src="/images/logo.png" class="logo img-fluid" alt="">
				</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-toggle" aria-controls="navbarNavAltMarkup"
				 aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse navbar-toggle " id="navbarNavAltMarkup">
					<ul class="navbar-nav mx-lg-auto">
						<li>
							<a class="nav-link<?=($_GET['tCodSeccion']=="inicio" ? ' active' : '');?>" href="/es/inicio/">Inicio</a>
						</li>
						<li>
							<a class="nav-link<?=($_GET['tCodSeccion']=="nosotros" ? ' active' : '');?>" href="/es/nosotros/">Nosotros</a>
						</li>
						<li>
							<a class="nav-link<?=($_GET['tCodSeccion']=="modelos" ? ' active' : '');?>" href="/es/modelos/">Tienda en L&iacute;nea</a>
						</li>
                        <li>
							<a class="nav-link<?=($_GET['tCodSeccion']=="blog" ? ' active' : '');?>" href="/es/blog/">Blog</a>
						</li>
						<li>
							<a class="nav-link<?=($_GET['tCodSeccion']=="contacto" ? ' active' : '');?>" href="/es/contacto/">Contacto</a>
						</li>
					</ul>
					<div class="header-social-w3ls text-center mt-lg-0 mt-4">
						<ul class="list-unstyled">
							<li>
								<a href="#">
									<i class="fa fa-facebook" aria-hidden="true"></i>
								</a>
							</li>
							<li class="mx-1">
								<a href="#">
									<i class="fa fa-twitter" aria-hidden="true"></i>
								</a>
							</li>
							<li>
								<a href="#">
									<i class="fa fa-google-plus" aria-hidden="true"></i>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</nav>
		</header>
		<!-- //header -->
		<!-- banner text -->
		<div class="banner-agile-text"  style="display:none">
			<div class="container">
			    
			    <div class="banner-text-size-w3ls">
					<h3 class="text-banner-agile text-uppercase text-white font-weight-bold">
						latest & exclusive collections for women
					</h3>
					<p class="mt-3 mb-5 banner-para-wthree"><span class="text-white font-weight-bold ">2018</span> Trending Styles,
						Stylish Fashion.</p>
					<a href="about.html" class="btn button-style">Read More</a>
				</div>
				
			</div>
		</div>
		<!-- //banner text -->
		
	</div>
	<!-- //banner -->

	<?
            $fichero = "./cnt/".$_GET['tCodSeccion'].".php";
        if(file_exists($fichero))
        {
            include($fichero);
        }
        ?>

	<!-- footer -->
	<footer class="footer-emp-w3ls py-5">
		<div class="container py-xl-5 py-lg-3">
			<div class="row footer-top">
				<div class="col-lg-4 footer-grid-wthree">
					<h1 class="footer-title text-white mb-4">Contacto</h1>
					<div class="contact-info">
						<h4 class="text-light text-uppercase mb-2">Ubicaci&oacute;n :</h4>
						<p></p>
						
					</div>
				</div>
				
				<div class="col-lg-8 footer-grid-wthree mt-lg-0 mt-5">
					<div class="footer-title">
						<a class="navbar-brand" href="index.html">
							<img src="images/logo.png" class="logo img-fluid" alt="">
						</a>
					</div>
					<p class="copy-right text-center mt-4">&copy; 2020 Modelos Nancy. Todos los Derechos Reservados
					</p>
				</div>
			</div>
		</div>
	</footer>
	<!-- //footer -->

    <!-- Modal -->
  

	<!-- Js files -->
	<!-- JavaScript -->
	<script src="/js/jquery-2.2.3.min.js"></script>
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<!-- Default-JavaScript-File -->

	<!-- navigation -->
	<!-- dropdown smooth -->
	<script>
		$(document).ready(function () {
			$(".dropdown").hover(
				function () {
					$('.dropdown-menu', this).stop(true, true).slideDown("fast");
					$(this).toggleClass('open');
				},
				function () {
					$('.dropdown-menu', this).stop(true, true).slideUp("fast");
					$(this).toggleClass('open');
				}
			);
		});
	</script>
	<!-- //dropdown smooth -->
	<!-- fixed nav -->
	<script>
		$(window).scroll(function () {
			if ($(document).scrollTop() > 50) {
				$('nav').addClass('shrink');
			} else {
				$('nav').removeClass('shrink');
			}
		});
	</script>
	<!-- //fixed nav -->
	<!-- //navigation -->

	<!-- carousel -->
	<script src="/js/carousel.js"></script>
	<link rel="stylesheet" href="/css/carousel.css" type="text/css" media="all" />
	<!-- //carousel -->

	<!-- smooth scrolling -->
	<script src="/js/SmoothScroll.min.js"></script>
	<!-- move-top -->
	<script src="/js/move-top.js"></script>
	<!-- easing -->
	<script src="/js/easing.js"></script>
	<!--  necessary snippets for few javascript files -->
	<script src="/js/look.js"></script>

	<!--<script src="/js/bootstrap.js"></script>-->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<!-- Necessary-JavaScript-File-For-Bootstrap -->
	<!-- //Js files -->
	<script type="text/javascript" src="/js/jquery.serializejson.js"></script>
        <script>
            function agregarCarrito()
      {
          
          var obj = $('#Datos').serializeJSON();
          var jsonString = JSON.stringify(obj);
          
          $.ajax({
              type: "POST",
              url: "/apl/add/cart/",
              data: jsonString,
              contentType: "application/json; charset=utf-8",
              dataType: "json",
              success: function(data){
                  if(data.exito==1)
                      {
                          //setTimeout(function(){ window.location="/fet/detalle/v1/$_GET['v1']/";},100);
                          var eProductos = parseInt(data.productos);
                          if(eProductos && eProductos>0)
                              {
                                  alert("Producto agregado al carrito");
                                  document.location="/es/detalles/v1/<?=$_GET['v1'];?>/";
                                  //$('#addCart').modal('show');
                                  //setTimeout(function(){ 
                                  //$('#addCart').modal('hide'); 
                                  //}, 1500);
                                  
                                  
                                  //document.getElementById('enlace').innerHTML = "<img src=\"/img/carrito.png\" id=\"carrito\"></i> <span>"+eProductos+"</span>";
                                  //window.location="/fet/detalle/v1/GET[V1]/";
                              }
                          else
                              {
                                  document.getElementById('enlace').src="#";
                              }
                              
                      }
                      //window.location="/fet/detalle/v1/GET[V1]/";
                     
              },
              failure: function(errMsg) {
                  alert('Error al enviar los datos.');
              }
          });
          
          //setTimeout(function(){ window.location="/fet/detalle/v1/=$_GET['v1'];?>/";},500);
          
      }
    
    function accionesCarrito(codigo,url)
      {
          var eIndice = document.getElementById('eIndice');
          if(eIndice)
          {
          document.getElementById('eIndice').value=codigo;
          }
          
          var obj = $('#Datos').serializeJSON();
          var jsonString = JSON.stringify(obj);
          
          $.ajax({
              type: "POST",
              url: "/apl/"+url+"/cart/",
              data: jsonString,
              contentType: "application/json; charset=utf-8",
              dataType: "json",
              success: function(data){
                  if(data.exito==1)
                      {
                          if(data.productos>0)
                              {
                                   window.location="/es/carrito/";
                              }
                          else
                              {
                                  window.location="/es/productos/";
                              }
                             
                      }
                      // window.location="/es/carrito/";
              },
              failure: function(errMsg) {
                  alert('Error al enviar los datos.');
              }
          });
          
          //setTimeout(function(){ window.location="/es/carrito/";},500);
          
      }
        
    function agregarPedido()
      {
          var tCorreo = document.getElementById('tCorreo').value;
          var tNombres = document.getElementById('tNombres').value;
          var tApellidos = document.getElementById('tApellidos').value;
          var tTelefonoFijo = document.getElementById('tTelefonoFijo').value;
          var tTelefonoMovil = document.getElementById('tTelefonoMovil').value;
          var tCalle = document.getElementById('tCalle').value;
          var tEstado = document.getElementById('tEstado').value;
          var tMunicipio = document.getElementById('tMunicipio').value;
          var tCP = document.getElementById('tCP').value;
          
          var bTerminos = document.getElementById('bTerminos');
          
          var obj = $('#Datos').serializeJSON();
          var jsonString = JSON.stringify(obj);
          
          var bandera = false;
          var mensaje = "";
          
          if(!tCorreo.trim())
            { bandera=true; mensaje += "* Correo\n"; }
          if(!tNombres.trim())
            { bandera=true; mensaje += "* Nombre(s)\n"; }
          if(!tApellidos.trim())
            { bandera=true; mensaje += "* Apellido(s)\n"; }
          if(!tTelefonoFijo.trim())
            { bandera=true; mensaje += "* Tel. Fijo\n"; }
          if(!tTelefonoMovil.trim())
            { bandera=true; mensaje += "* Tel. Movil\n"; }
          if(!tCalle.trim())
            { bandera=true; mensaje += "* Calle\n"; }
          if(!tEstado.trim())
            { bandera=true; mensaje += "* Estado\n"; }
          if(!tMunicipio.trim())
            { bandera=true; mensaje += "* Municipio\n"; }
          if(!tCP.trim())
            { bandera=true; mensaje += "* C.P.\n"; }
            
          if(!bTerminos.checked)
            { bandera=true; mensaje += "* Debes aceptar los términos y condiciones\n"; }
          
          if(bandera)
              {
                  alert("* Falta Información *\n"+mensaje);
              }
          else
              {
          
          $.ajax({
              type: "POST",
              url: "/apl/add/transaccion/",
              data: jsonString,
              contentType: "application/json; charset=utf-8",
              dataType: "json",
              success: function(data){
                  if(data.exito==1)
                      {
                          alert("Pedido completado\n En breve recibirá un correo electrónico con todos los detalles. \nVerifique también su bandeja de SPAM");
                          if(data.metodo=="oxxo")
                              {
                                accionesCarrito('T','sup');
                              }
                          else
                              {
                                  if(data.metodo=="paypal")
                                    {
                                        //alert("Pedido generado...");
                                        window.location="/es/paypal/";
                                        setTimeout(function(){ window.location="/es/paypal/";},500);
                                    }
                                  if(data.metodo=="ml")
                                    {
                                        //alert("Pedido generado...");
                                        window.location=data.url;
                                        setTimeout(function(){ window.location=data.url;},1500);
                                    }
                                  
                              }
                      }
                   //setTimeout(function(){ window.location="/fet/carrito/";},500);
                     
              },
              failure: function(errMsg) {
                  alert('Error al enviar los datos.');
              }
          });
          
          //setTimeout(function(){ window.location="/fet/carrito/";},500);
              }
          
      }
        
      function buscarCliente()
      {
          
          var obj = $('#Datos').serializeJSON();
          var jsonString = JSON.stringify(obj);
          
          $.ajax({
              type: "POST",
              url: "/apl/src/cliente/",
              data: jsonString,
              contentType: "application/json; charset=utf-8",
              dataType: "json",
              success: function(data){
                  
                  Object.keys(data).forEach(key => {
                      document.getElementById(key).value=data[key];
                      document.getElementById(key).disabled=false;
                    });
              },
              failure: function(errMsg) {
                  alert('Error al enviar los datos.');
              }
          });
          
          //setTimeout(function(){ window.location="/fet/carrito/";},500);
          
      }
        
        function pagarPaypal()
        {
            var formulario = document.getElementById('paypal_form');
            if(formulario)
                {
                    formulario.submit();
                }
        }
        
        function cambiarPagina(tipo)
        {
            var ePagina = document.getElementById('ePagina'),
                eMax    = document.getElementById('eMaxPagina');
                
            if(tipo=='resta' && ePagina.value>1)
            {
                ePagina.value = parseInt(ePagina.value) - 1;
            }
            if(tipo=='suma' && ePagina.value<eMax.value)
            {
                ePagina.value = parseInt(ePagina.value) + 1;
            }
            
            consultarProductos();
        }
        
        function consultarProductos()
      {
          
          var obj = $('#Datos').serializeJSON();
          var jsonString = JSON.stringify(obj);
          
          $.ajax({
              type: "POST",
              url: "/apl/con/productos/",
              data: jsonString,
              contentType: "application/json; charset=utf-8",
              dataType: "json",
              success: function(data){
                  document.getElementById('divXHR').innerHTML = data.tHTML;
                  document.getElementById('eMaxPagina').value = data.eMaxPaginas;
              },
              failure: function(errMsg) {
                  alert('Error al enviar los datos.');
              }
          });
          
          //setTimeout(function(){ window.location="/fet/carrito/";},500);
          
      }
      
      function consultarInicio()
      {
          
          var obj = $('#Datos').serializeJSON();
          var jsonString = JSON.stringify(obj);
          
          $.ajax({
              type: "POST",
              url: "/apl/con/inicio/",
              data: jsonString,
              contentType: "application/json; charset=utf-8",
              dataType: "json",
              success: function(data){
                  document.getElementById('divXHR').innerHTML = data.tHTML;
              },
              failure: function(errMsg) {
                  alert('Error al enviar los datos.');
              }
          });
          
          //setTimeout(function(){ window.location="/fet/carrito/";},500);
          
      }
      
      function consultarDetalle()
      {
          
          var obj = $('#Datos').serializeJSON();
          var jsonString = JSON.stringify(obj);
          
          $.ajax({
              type: "POST",
              url: "/apl/det/producto/",
              data: jsonString,
              contentType: "application/json; charset=utf-8",
              dataType: "json",
              success: function(data){
                  document.getElementById('tPrecio').innerHTML = 'Precio: '+data.precio;
                  document.getElementById('tTitulo').innerHTML = data.titulo;
                  document.getElementById('tDescripcion').innerHTML = data.descripcion;
                  document.getElementById('tImagen').src = data.imagen;
              },
              failure: function(errMsg) {
                  alert('Error al enviar los datos.');
              }
          });
          
          //setTimeout(function(){ window.location="/fet/carrito/";},500);
          
      }
            
            function ocultarVideo()
            {
                localStorage.removeItem('mndVideo');
                if(document.getElementById('bVideo').checked)
                { localStorage.setItem('mndVideo', 'activo'); }
                else
                { localStorage.removeItem('mndVideo'); }
            }
            
            function validarVideo()
            {
                
                if(!localStorage.getItem('mndVideo'))
                    {
                        document.getElementById("overlay").style.display = "block";
                    }
            }
            
            function off() {
  document.getElementById("overlay").style.display = "none";
}
        
        $( document ).ready(function() {
            //pagarPaypal();
            
            validarVideo();
           
            <? if($_GET['tCodSeccion']=="detalles" && $_GET['v1']){ ?>
            consultarDetalle();
            <? } ?>
            if(document.getElementById('completado'))
                {
                    setTimeout(function(){
                            accionesCarrito(1,'emptyCart');
                        },2500);
                }
});
        </script>


</body>

</html>
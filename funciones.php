<?php 


//***************************************************
//	Archivo de funciones para Tutto Pelle
//***************************************************

include_once('conexion.php');

function get_head($page,$titulo){
 ?>
<!doctype html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title><?php echo $titulo; ?></title>

		<link rel="stylesheet" href="css/reset.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/jquery.fancybox.css?v=2.1.4" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/jquery-ui.css" type="text/css" media="screen" />
		<link rel="shortcut icon" href="images/favicon.ico" />
		<link rel="stylesheet" href="css/jquery-ui.css" type="text/css" media="screen" />

		<!--<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>-->
		<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.10.1.custom.js"></script>
		<script async type="text/javascript" src="js/jquery.fancybox.js?v=2.1.4"></script>
		<script async type="text/javascript" src="js/modernizr.js"></script>
		<script async type="text/javascript" src="js/jquery.jscrollpane.js"></script>
		<script async type="text/javascript" src="js/jquery.mousewheel.js"></script>
		<script async type="text/javascript" src="js/libs.js"></script>

		 <!--[if IE]>
			<script type="text/javascript">
		   document.createElement("nav");
		   document.createElement("header");
		   document.createElement("footer");
		   document.createElement("section");
		   document.createElement("article");
		   document.createElement("aside");
		   document.createElement("hgroup");

		   var e = ("abbr,article,aside,audio,canvas,datalist,details,figure,footer,header,hgroup,mark,menu,meter,nav,output,progress,section,time,video").split(',');
				for (var i = 0; i < e.length; i++) {
					document.createElement(e[i]);
					}
			</script>
		<![endif]-->

	</head>
	<body>
		<div id="wrap">
<?php
}

function get_header(){
?>
<header>
	<nav>
		<ul>
			<li id="coleccion">
				<h3>COLECCIÓN </h3>
				<ul style="text-transform: capitalize;">
				<?php
					$link = conectar();
					/** 
					Muestra el submenu categorias
					*/
					$query = "SELECT categoria FROM modelos WHERE mostrar = true GROUP BY categoria ORDER BY id_modelo ASC;";
					$categorias = mysql_query($query,$link);
					while($categoria = mysql_fetch_array($categorias)){
						echo '<li class="'.$categoria[categoria].'">';
							echo '<a class="coleccion fancybox.iframe" data-fancybox-type="iframe" href="coleccion.php?categoria='.$categoria[categoria].'">';
								echo '<h3>'.$categoria[categoria].'</h3>';
							echo '</a>';									
	 				} 
		 		?>
				</ul>
			</li>
			<li id="sucursales">
				<h3>SUCURSALES </h3>
				<ul>
					<?php 
					$query = "SELECT vcNCiudad, vcNEstado, vcTMenu FROM sucursales GROUP BY vcNEstado ORDER BY vcNCiudad ASC;";
					$ciudades = mysql_query($query,$link);
					while($ciudad = mysql_fetch_array($ciudades)){
						echo '<li>';
								echo '<h3>'.$ciudad[vcTMenu].'</h3>';
								echo "<ul>";
									$query = "SELECT vcNSucursal, vcPImg FROM sucursales WHERE vcNEstado = '".$ciudad[vcNEstado]."' GROUP BY vcNSucursal ORDER BY vcNSucursal ASC;";						
									$sucursales = mysql_query($query,$link);									
									while ($sucursal = mysql_fetch_array($sucursales)) {
										echo "<li>";
											echo '<a class="sucursal fancybox.iframe" id="'.$sucursal[vcPImg].'" data-fancybox-type="iframe" href="sucursal.php?nombre='.$sucursal[vcPImg].'" title="">'.$sucursal[vcNSucursal].'</a>';										
										echo "</li>";
									}
								echo "</ul>";
							echo "</li>";
					}
					?>
				</ul>
			</li>
			<li>
				<h3>QUIENES SOMOS </h3>
				<ul>
					<?php  
						$query = "SELECT seccion, imgFondo, cssInfo FROM quienesSomos ORDER BY id ASC;";
						$secciones = mysql_query($query,$link);
						while($seccion = mysql_fetch_array($secciones)){
							list($w, $h) = explode(",",$seccion[cssInfo]);
							echo '<li>';
								echo '<a id="'.$seccion[seccion].'" class="quienesSomos fancybox.iframe" data-fancybox-type="iframe" bg="'.$seccion[imgFondo].'" w="'.$w.'" h="'.$h.'" href="quienes-somos.php?seccion='.$seccion[seccion].'" title="">'.$seccion[seccion].'</a>';										
								// echo $seccion[seccion];
							echo '</li>';
						}
					?>
				</ul>
			</li>
			<!-- <li class="ui-state-disabled"><h3>SERVICIOS </h3></li> -->
			<li><a id="contacto" class="contacto fancybox.iframe" data-fancybox-type="iframe" href="contacto.php" title="">CONTACTO </a></li>			
			<li><h3><a id="especiales" href="data:image/jpg;base64,<?php echo base64_encode(file_get_contents("images/especiales/april.jpg")); ?>">ESPECIALES </a></h3></li>
		</ul>
	</nav>
	<a id="logo" href="index.php"><img id="logo-t" src="data:image/jpg;base64,<?php echo base64_encode(file_get_contents("images/logo.png")); ?>" alt="Tutto Pelle"></a>
</header>
<?php 
}

function get_footer(){
?>
			<footer>
				<a href="http://www.collinscom.com" target="collins" style="position: absolute;right: 20px;bottom: 10px;">collinscom.com</a>
				<div>
					<a href="https://www.facebook.com/TuttoPelleMx" target="facebook"><img src="images/fb.png" alt="facebook"></a>
					<a href="https://twitter.com/tuttopellemx" target="twitter"><img src="images/tw.png" alt="twitter"></a>
					<p>DERECHOS RESERVDOS 2013 Tutto Pelle / ESPECIALISTAS EN MUEBLES DE PIEL / AVISO DE PRIVACIDAD</p>
				</div>
			</footer>
		</div>

	</body>
</html>
<?php
}

function index(){
?>
	<div id="fondo1" class="bg"><img src="css/images/bg1.jpg" alt=""></div>
	<div id="fondo2" class="bg"><img src="css/images/bg1.jpg" alt=""></div>
	<div id="bg_sucursal" class="bg"></div>
	<div id="bg_quienesSomos" class="bg"></div>
<?php 
}

function coleccion(){
	$cat = $_GET[categoria];
	// $est = $_GET[estilo];
	$link = conectar();
	// $query = "SELECT estilo, categoria, modelo, composicion FROM modelos WHERE categoria = '".$cat."' AND mostrar = true GROUP BY estilo ORDER BY estilo ASC;";
	$query = "SELECT * FROM modelos WHERE categoria = '".$cat."' AND mostrar = true GROUP BY modelo ORDER BY id_modelo ASC;";
	$result = mysql_query($query,$link);
	echo '<div id="estilos" cat="'.$cat.'">';
		echo '<h1>'.$cat.'</h1>';
		echo '<div class="contenedor">';
		while ($estilo = mysql_fetch_array($result)) {		
			echo '<article est="'.$estilo[estilo].'">';
				if($estilo[composicion] == "modulares"){
					echo '<img src="images/colecciones/tmb/tmb_'.$estilo[composicion].$estilo[modelo].'.jpg" alt="'.$estilo[composicion].'">';
				}else{					
					echo '<img src="images/colecciones/tmb/tmb_'.$estilo[categoria].$estilo[modelo].'.jpg" alt="'.$estilo[categoria].'">';
				}
				echo '<h2>'.$estilo[modelo].'</h2>';
			echo '</article>';
		}
		echo "</div>";
	echo '</div>'; 
	/** 
	fin del div estilos
	*/
	echo '<div id="modelos" style="display:none;"></div>'; 
	/** 
	fin del div modelos
	*/
	echo "<script>	$('.contenedor').jScrollPane();	</script>";
}

function sucursal(){
	// echo "<style>body{background-color: black;background:url(../images/sucursales/sucDFAltavista.jpg) no-repeat 0% 0%;}</style>";

	$nom = $_GET[nombre];
	$link = conectar();
	$query = "SELECT vcNSucursal, vcDireccion, vcTels, vcNCiudad, vcPImg, vcMapa, vcNEstado FROM sucursales WHERE vcPImg = '".$nom."';";
	$sucursal = mysql_fetch_array(mysql_query($query,$link));	
	?>
<div id="sucursal" style="background: url(css/images/bg_transparencia_0.6.png);">
	<div>
		<h1><?php echo $sucursal[vcNSucursal]; ?></h1>
		<p>
			<span><?php echo $sucursal[vcDireccion]; ?></span>
			<span><?php echo $sucursal[vcNCiudad].", ".$sucursal[vcNEstado]; ?></span>
			<span>Teléfono(s): <?php echo $sucursal[vcTels]; ?></span>
		</p>
	</div>
	<img src="data:image/png;base64,<?php echo base64_encode(file_get_contents("images/sucursales/".$sucursal[vcMapa])); ?>" alt="">
</div>

<?php 
}

function quienesSomos(){
	$link = conectar();
	$query = "SELECT * FROM quienesSomos WHERE seccion = '".$_GET[seccion]."' ORDER BY id ASC;";
	$reslt = mysql_query($query,$link);
	$seccion = mysql_fetch_array($reslt);
	list($w, $h) = explode(",",$seccion[cssInfo]);

	echo '<div id="texto" bg="'.$seccion[imgFondo].'" style="width:'.($w-20).'px; height:'.($h-20).'px;" ><h1>'.$seccion[titulo].'</h1>'.$seccion[contenido].'</div>';

}
?>

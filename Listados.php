<!--Listados.php--> 
<!DOCTYPE html>
<html>

	<!-- ---------- HEAD ----------- -->
	<head>
		<?php CabeceraDeArranque(); ?>
	</head>
	<!-- -------FIN HEAD ----------- -->

	<body>
    
    <!-- ----- HEADER ------ -->
		<header>
			<?php Cabecera(); ?>
		</header>
		<!-- ---- FIN HEADER --- -->

		<?php 
    if (isset($_SESSION['Usuario'])&&($_SESSION['Usuario']!="")){
    ?> 
			<!---------------seccion de navegación lateral------------------>
			<?php NavegadorLateral(); ?>
			<!--------------------FIN Nav. Lateral-------------------------->
			<div class="col-8 text-center">
			<!-- -----TITULO ----- -->
			<h1><?php echo $datos['titulo']; ?></h1><hr/>
			<!-- ---FIN TITULO --- -->

            <section>
                <?php Listado(); ?>
            </section>
    
		<?php	}else{ ?>  <!-- Si el usuario NO esta LOGEADO -->
	
		<!-- Inicion ZONA Section NEGACION ACCESO -->
		<div class="col-12 text-center"> 

			<?php	NegaciónAcceso($datos, $valor); ?>

		<?php } ?>	<!-- FIN  SI el usuario esta LOGEADO ó NO -->
				
		</div><br>
		<!-- FIN Inicion ZONA Section -->
		
		<!-- ----- FOOTER ----- -->
		<footer class="page-footer font-small mdb-color pt-4">
			<?php Footer(); ?>
		</footer>
		<!-- --- FIN FOOTER --- -->
		
		<!-- funetes fin de footer -->
		<?php FuentesFooter();?>
		<!-- --FIN FUENFES FOOTER ---->
		
	</body>
</html>
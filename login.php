<!--Home.php--> 
<!doctype html>
<html lang="es">

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
    
    <!--------------- seccion cuerpo de trabajo---------------------------------------->
    <div class="text-center">
      <h1><?php echo $datos['titulo'];?></h1><hr/>

      <!-- ----- INICIO DE SECTION ------ -->
      <section id="homeSection">
        <?php SectionLogin($valor,  $datos) ?>
      </section>
      <!-- ------- FIN DE SECTION ------- -->
 
    </div><br>
    <!--------------- FIN seccion cuerpo de trabajo ----------------------------------->
    
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
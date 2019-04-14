<!--HomeUsuarios.php-->
<!DOCTYPE html>
<html>

	<!-- ---------- HEAD ----------- -->
	<?php CabeceraDeArranque(); ?>
	<!-- -------FIN HEAD ----------- -->

	<script>
		var xhr;
		function Peticion(){
			xhr = new XMLHttpRequest();
			xhr.open("POST",'http://<?=URLSERVIDOR?>/ManualUsuario.php',true);
			xhr.addEventListener("readystatechange",gestionarRespuesta,false);
			xhr.send();
		}
		function gestionarRespuesta(){
			if(xhr.readyState == 4 && xhr.status == 200)
				document.getElementById("txt").innerHTML = xhr.responseText;
		}
	</script>
	
	<body>
    
		<!-- ----- HEADER ------ -->
		<?php Cabecera(); ?>
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
				<p id="txt"></p>
					<form>
						<script type="text/javascript">
								Peticion();
						</script>
					</form>
      </section>

      	<?php
    }else{
			NegaciónAcceso($datos, $valor);
		?>
		<?php
    }
    ?>
		</div>
		</div>
		<!-- ----- FOOTER ----- -->
		<?php Footer(); ?>
		<!-- --- FIN FOOTER --- -->
	</body>
</html>
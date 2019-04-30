<!--Sorteo.php-->
<!DOCTYPE html>
<html>

	<!-- ---------- HEAD ----------- -->
	<head>

		<?php CabeceraDeArranque(); ?>
		
		<script src='http://<?=URLSERVIDOR?>/js/main.js'></script>

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
                <?php
                $mensaje='';
                $user_agent = $_SERVER['HTTP_USER_AGENT'];
                $navegador = getBrowser($user_agent);
            

                if($navegador=='Safari'){ ?>
                    <div class="alert alert-warning" role="alert">
                      <h4 class="alert-heading">¡Atención!</h4>
                        <p>El navegador <?=$navegador?> todavía no es compatible con esta función.</p><hr>
                        <p class="mb-0">El programa esta optimizado para navegadores <strong>Google Chrome</strong> y <strong>Firefox</strong></p>
                    </div>
                <?php }else{ ?>

                    <div>
                      <div class="alert alert-info" role="alert">
                        Si ha habido alguna confusión a la hora de
                            rellenar los datos, puede corregirlos, pulsando
                            el botón<strong > CORREGIR DATOS</strong> lo que probocará
                            la recarga de la página
                        <br>
                        <form action='?' method='GET'>
                            <input class="btn btn-info" id='impCorregir' type='submit' value='CORREGIR DATOS'>
                        </form>
                      </div>

                        <br>
                        <?php 
                        if (isset($_POST['Sorteo'])){
                            if ((empty($_POST['SorNom']))||(empty($_POST['SorFec']))){
                                echo "<h3>No se puede realizar el sorteo ya que faltan datos del SORTEO</h3>";
                            }else{
                                $mensaje=superSorteo();
                            }
                        }
                        ?>
                    </div>
                    <?php $SorteoId=NuevoSorteo();?>
                    <form id="formularioSorteo" method="POST" action="?">
                        <div id="DivSorteo">
                            <div id='divDatosSorteo'>  
                                <input id="SorteoId" type="hidden" name="SorId" value="<?php echo $SorteoId ?>">    
                                <label>Sorteo</label><input id="Sorteo" type="text" name="SorNom" placeholder="Nombre Sorteo">
                                <label>Fecha</label><input id="Fecha" type="date" name="SorFec" placeholder="Fecha sorteo dd/mm/aaaa">
                                <label>Presupuesto</label><input id="Presupuesto" type="text" name="SorPre" placeholder="75€">
                            </div>  
                            <?php 
                            //SoloSorteo(); 
                            Solousuarios(); 
                            ?>
                        </div>
                    </form>
                <?php
                }
                echo $mensaje;
                ?>
                
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
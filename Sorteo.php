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
											<div class="form-row"  id="DivSorteo">

												<div class="form-group col-md-7" id='divDatosSorteo'>											
													<label for="Sorteo">Sorteo</label>
													<input id="Sorteo" type="text" class="form-control" name="SorNom" placeholder="Nombre Sorteo">
												</div>
											
												<div class="form-group col-md-3">
													<label for="Fecha">Fecha</label>
													<input name="SorFec"  type="date" class="form-control" id="Fecha" placeholder="Fecha sorteo dd/mm/aaaa">
												</div>

												<div class="form-group col-md-2">
													<label for="Presupuesto">Presupuesto</label>
													<input name="SorPre" type="text" class="form-control" id="Presupuesto" placeholder="75€">
												</div>

											</div>

											<div class="row">
												<div class="form-group col-md-5">
													<?=Solousuarios();?>
												</div>

												<div class="form-group col-md-2">
													<input id="SorteoId" type="hidden" name="SorId" value="<?php echo $SorteoId ?>">
												</div>

												<div class="form-group col-md-5">
												<?=ListarParticipantesDelSorteo();?>
												</div>
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
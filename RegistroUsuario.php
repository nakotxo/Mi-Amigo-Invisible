<!--RegistroUsuario.php-->
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
		
		<!--  Si el usuario esta LOGEADO-->
		<?php if (isset($_SESSION['Usuario'])&&($_SESSION['Usuario']!="")){ ?>  

			<!---------------seccion de navegación lateral------------------>
			<?php NavegadorLateral(); ?>
			<!--------------------FIN Nav. Lateral-------------------------->

			<!-- Inicion ZONA Section -->
			<div class="col-8 text-center">

		<?php }else{ ?>	<!-- SI el usuario NO esta LOGEADO -->

			<!-- Inicion ZONA Section -->
			<div class="col-12 text-center">

		<?php } ?>	<!-- FIN  SI el usuario esta LOGEADO ó NO -->
		
			<!-- -----TITULO ----- -->
			<h1><?php echo $datos['titulo']; ?></h1><hr/>
			<!-- ---FIN TITULO --- -->   

			<!-- ----- SECTION ------ -->
			<section>
					<form method="POST" action="?">
							<div id="DivRegistro">
									<input id="usuarioId" type="hidden" name="UsuId" value=" <?php echo $UsuarioId ?>">    
									<label>Usuario</label><input id="usuario" type="text" name="UsuNom" placeholder="Nombre">
									<?php
											//si existe un usuario registrado, no puede conocer la contraseña
									if (isset($_SESSION['Usuario'])&&($_SESSION['Usuario']!="")){
											$password=crearPassword();
											?>
											<input id="contrasena" type="hidden" name="UsuPwd" placeholder="Contraseña" value=<?=$password?>>
											<?php
									}else{
											?>
											<label>Contraseña</label><input id="contrasena" type="password" name="UsuPwd" placeholder="Contraseña">
											<?php
									}
									?>
				<input id="rol" type="hidden" name="UsuRol" placeholder="Usuario" value="Usu" >
				<label>E-mail</label><input id="text" type="text" name="UsuEma" placeholder="Email@mail.com">
									<div id="log"><input id="login" type="submit" name="login" value="Registrar" ></div>
							</div>
					</form>
					<h3><?php echo $valor?></h3>
			</section>
			<!-- ----- FIN SECTION ----- -->
			
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
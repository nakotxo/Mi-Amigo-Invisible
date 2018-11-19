<!--RegistroUsuario.php-->
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Mi Amigo Invisible</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" media="screen" href='http://<?=URLSERVIDOR?>/main.css' />
    </head>
<body>
    <header>
        <div id="DivHeader">
            <div id="Logo"></div>
            <div id="TituloPagina">Mi Amigo Invisible</div>
            <?php 
            if (isset($_SESSION['Usuario'])&&($_SESSION['Usuario']!="")){
                ?>
                <div id="DivLogOut">
                    <label>Bienvenido Usuario<br/></label>
                    <label> <?php echo $_SESSION['Usuario'] ?> </label>
                    <form method="POST" action="?">
                        <input type="submit" name="logout" value="LogOut" >
                    </form>
                </div>
                <?php    
            }else{
                ?>
                <div id="DivLogeado">
                    <input type="button" value="LogIn" onclick="location.href='http://<?=URLSERVIDOR?>/index.php/login'">
                </div>
                <?php
            }
            ?>
            </div>
        </div>
    </header>

    <div id="DivNavSup">
        <nav id="menu_cabecera">
			<ul>
				<li><a href='http://<?=URLSERVIDOR?>/index.php/Home'>HOME</a></li>
				<li><a href="#">QUIENES SOMOS</a>
					<ul>
						<li><a href="#">EMPRESA</a></li>
						<li><a href="#">EVENTOS</a></li>
						<li><a href="#">NOVEDADES</a></li>
					</ul>
				</li>
			    <li><a href="https://es-es.facebook.com/">FACEBOOK</a></li>
			 </ul>
		</nav>
    </div>
    <?php 
        if (isset($_SESSION['Usuario'])&&($_SESSION['Usuario']!="")){
    ?>
    <!--seccion de navegación lateral-->
            <div id="capitulos">
                <form method="POST" action="?">
                  <nav>
                    <ul>
                        <li><a href='http://<?=URLSERVIDOR?>/index.php/Mis_Datos'>Mis Datos</a></li>
                        <li><a href='http://<?=URLSERVIDOR?>/index.php/Mis_Sorteos'>Mis Sorteos</a></li>
                        <li><a href='http://<?=URLSERVIDOR?>/index.php/Crear_Sorteo'>Crear Sorteo</a></li>
                        <li><a href='http://<?=URLSERVIDOR?>/index.php/Crear_Deseos'>Crear Deseo</a></li>
                        <li><a href='http://<?=URLSERVIDOR?>/index.php/Manual_Usuario'>Manual Usuario</a></li>
                        <?php
                        if ($_SESSION['Rol']=='Root'){
                            echo ('<li><a href=http://'.URLSERVIDOR.'/index.php/Listados>Listados</a></li>');
                        }
                        ?>
                    </ul>
                  </nav>	
                </form>
            </div>
         <?php
        }
    ?>  
	        <!-- ---------------------------- -->
        <h1><?php echo $datos['titulo']; ?></h1><hr/>
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
        <footer> 
            <p>Para cualquier consulta o error, no dude en contactar con el administrador.<br>
            Contacto: <a id="emailA" href="mailto:HidalgoJ.Ignacio@gmail.com">HidalgoJ.Ignacio@gmail.com</a><br>
            Creado por: Jose Ignacio Hidalgo</p>
        </footer>
</body>
</html>
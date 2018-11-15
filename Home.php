<!--Home.php-->
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Mi Amigo Invisible</title>
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
    </header>

    <div id="DivNavSup">
        <nav id="menu_cabecera">
			<ul>
            <li><a href='http://<?=URLSERVIDOR?>/index.php/Registro'>NUEVO USUARIO</a></li>
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
                        <li><a href='http://<?=URLSERVIDOR?>/index.php/adminusuarios'>Manual Usuario</a></li>
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
    <section id="homeSection">
        <h2>Bienvenidos a MI AMIGO INVISIBLE</h2>
        <p>Trata sobre una página donde podrás realizar tusorteo del amigo invisible<br>
            Solo hace falta registrarte, incluso puedes registrar tu a tus amigos si ellos no pudieran, 
            solo te hace falta su correo electrónico<br><br>
            El resto dejalo en nuestras manos:<br>
            Te haremos llegar todos los datos del sorteo.<br>
            Quien te ha tocado<br>
            El presupuesto para el regalo<br>
            Y cuales son los regalos preferidos para tu amigo invisible.
        </p>
    </section>
        
    <footer> 
        <p>Para cualquier consulta o error, no dude en contactar con el administrador.<br>
        Contacto: <a id="emailA" href="mailto:HidalgoJ.Ignacio@gmail.com">HidalgoJ.Ignacio@gmail.com</a><br>
        Creado por: Jose Ignacio Hidalgo</p>
    </footer>
</body>
</html>
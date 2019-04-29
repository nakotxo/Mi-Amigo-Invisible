<!--Mis_Datos.php--> 
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
        <div id="DivHeader" class="mycontainer">
            <div id="Logo">
                <img src='http://<?=URLSERVIDOR?>/multimedia/logo.jpg' class="headerImg">
            </div>
            <div id="TituloPagina">
                Mi Amigo Invisible
            </div>
            <?php 
            if (isset($_SESSION['Usuario'])&&($_SESSION['Usuario']!="")){
                ?>
                <div id="DivLogOut">
                    <div class='formLogin'>
                        <img src='http://<?=URLSERVIDOR?>/multimedia/mrx.jpg' id='imgLogin' class="headerImg">
                        <label id='lblLogin'>Bienvenido Usuario<br/><?php echo $_SESSION['Usuario'] ?></label>
                        <form method="POST" action="?">
                            <input id='inpLogin2' type="submit" name="logout" value="LogOut" >
                        </form>
                    </div>
                </div>
                <?php    
            }else{
                ?>
                <div id="DivLogeado">
                    <div class='formLogin'>
                        <img src='http://<?=URLSERVIDOR?>/multimedia/mrx.jpg' id='imgLogin' class="headerImg">
                        <div id='inpLogin'>
                            <input id='inpLogin2' type="button" value="LogIn" onclick="location.href='http://<?=URLSERVIDOR?>/index.php/login'">
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>

        <div id="DivNavSup">
            <nav id="menu_cabecera">
	    		<ul>
                <li id='primerLi'><a href='http://<?=URLSERVIDOR?>/index.php/Home'>HOME</a></li>
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
    </header>
    <?php 
        if (isset($_SESSION['Usuario'])&&($_SESSION['Usuario']!="")){
    ?>  
            <!--seccion de navegación lateral-->
            <div id="capitulos" class="mycontainer">
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
<!----------------------------------- FIN CABECERAS Y SECCIONES DE NAVEGACION ---------------------------- -->
            <h1><?php echo $datos['titulo']; ?></h1><hr/>
            <section>
                <?php 
                    Mis_datos();
                ?>
                </section>
            <?php
            }else{
                ?>
                <h1><?php echo $datos['titulo']; ?></h1><hr/>
                <h2>Identificación de usuario necesaria</h2>
                <h3>Para acceder a esta página, introduzca Nombre Usuario y Contrseña</h3>
                <section id="homeSection">
                    <?php
                    formularioLogin();
                    ?>
                    <h3><?php echo $valor?></h3>
                </section>
                <?php
            }
            ?>  
        
        <footer> 
            <p>Para cualquier consulta o error, no dude en contactar con el administrador.<br>
            Contacto: <a id="emailA" href="mailto:HidalgoJ.Ignacio@gmail.com">HidalgoJ.Ignacio@gmail.com</a><br>
            Creado por: Jose Ignacio Hidalgo</p>
        </footer>
</body>
</html>
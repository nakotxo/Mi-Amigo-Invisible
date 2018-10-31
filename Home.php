<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Mi Amigo Invisible</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" media="screen" href="http://www.bnkysukq.lucusvirtual.es/main.css" />
        <script src="main.js"></script>
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
                    <input type="button" value="LogIn" onclick="location.href='http://www.bnkysukq.lucusvirtual.es/index.php/login'">
                </div>
                <?php
            }
            ?>

        </div>
    </header>

    <div id="DivNavSup">
        <nav id="menu_cabecera">
			<ul>
            <!--<li><a href="http://www.bnkysukq.lucusvirtual.es/index.php/Home">HOME</a></li>-->
            <li><a href="http://www.bnkysukq.lucusvirtual.es/index.php/Registro">NUEVO USUARIO</a></li>
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
                        <li><a href="http://www.bnkysukq.lucusvirtual.es/index.php/Mis_Datos">Mis Datos</a></li>
                        <li><a href="http://www.bnkysukq.lucusvirtual.es/index.php/Mis_Sorteos">Mis Sorteos</a></li>
                        <li><a href="http://www.bnkysukq.lucusvirtual.es/index.php/Crear_Sorteo">Crear Sorteo</a></li>
                        <li><a href="http://www.bnkysukq.lucusvirtual.es/index.php/Crear_Deseos">Crear Deseo</a></li>
                        <?php
                            if ($_SESSION['Rol']=='Root'){
                                echo ('<li><a href="http://www.bnkysukq.lucusvirtual.es/index.php/Crear_Sorteo">Listados</a></li>');
                            }
                        ?>
                    </ul>
                  </nav>	
                </form>
            </div>
	        <!-- ---------------------------- -->
            <h1><?php echo $datos['titulo']; ?></h1><hr/>  
            <section>
                <?php
                    if (isset($_POST['Listado'])){
                        Listado();
                    }
                ?>
            </section><?php
        }
    ?>
    <footer></footer>
</body>
</html>
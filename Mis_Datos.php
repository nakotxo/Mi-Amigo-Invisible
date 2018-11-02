<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Mi Amigo Invisible</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" media="screen" href="http://localhost/proyecto/main.css" />
        <script src="http://localhost/proyecto/jquery3.3.1.js"></script>
    </head>
<body>
    <header>
        <div id="DivHeader">
            <div id="Logo"></div>

            <div id="TituloPagina">Mi Amigo Invisible</div>
            
            <div id="DivLogOut">
                <label>Bienvenido Usuario<br/></label>
                <label> <?php echo $_SESSION['Usuario'] ?> </label>
                <form method="POST" action="?">
                    <input type="submit" name="logout" value="LogOut" >
                </form>
            </div>
        
        </div>
    </header>

    <div id="DivNavSup">
        <nav id="menu_cabecera">
			<ul>
				<li><a href="http://localhost/proyecto/index.php/Home">HOME</a></li>
                <li><a href="http://localhost/proyecto/index.php/Registro">NUEVO USUARIO</a></li>
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
    <!--seccion de navegación lateral-->
	<div id="capitulos">
        <form method="POST" action="?">
		<nav>
			<ul>
                <li><a href="http://localhost/proyecto/index.php/Mis_Datos">Mis Datos</a></li>
                <li><a href="http://localhost/proyecto/index.php/Mis_Sorteos">Mis Sorteos</a></li>
                <li><a href="http://localhost/proyecto/index.php/Crear_Sorteo">Crear Sorteo</a></li>
                <li><a href="http://localhost/proyecto/index.php/Crear_Deseos">Crear Deseo</a></li>
                <?php
                    if ($_SESSION['Rol']=='Root'){
                        echo ('<li><a href="http://localhost/proyecto/index.php/Listados">Listados</a></li>');
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
                Mis_datos();
            ?>
        </section>
        
    <footer></footer>
</body>
</html>
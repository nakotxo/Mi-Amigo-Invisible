<?php
	/**
	* Subtarea 1: Creación del controlador frontal
	*
	*	index.php será la página que hará las veces de controlador.
	*
	*    Inclulle al principio del documento modelo.php
	*    Inclulle al principio del documento controlador.php.
	* 	 Fijándonos en el controlador frontal de la unidad 5 desarrolla las condiciones necesarias para enrutar:
	* 	/index.php para controlador_index()
	* 	/Controlador.php/registro para controlador_registro()
	* 	/Controlador.php/login para controlador_login()
	* 	/admin_usuarios.php/admin_usuarios para controlador_admin_usuarios()
	* 	/admin_libros.php/admin_libros para controlador_admin_libros()
	*
	* @file index.php
	* @author Jose Ignacio Hidalgo Perez
	* 
	*/
session_start();
	
	
	require_once "modelo.php";
	require_once "controlador.php";

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Mi Amigo Invisible</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
        <script src="main.js"></script>
    </head>
<body>
    <header>
        <div id="DivHeader">
            <div id="Logo"></div>
            <div id="TituloPagina"></div>
            <?php 
                $usuario="";
                if($usuario==""){
            ?>
            <div id="DivLogeado">
                <label>Usuario</label><input type="text">
                <label>Contraseña</label><input type="password">
                <div id="logeado" align="center"><input type="button" value="LogIn"></div>
            </div>
            <?php }else{ ?>
            <div id="DivLogeado">
                <label>Bienvenido Usuario</label>
                <div id="logeado"><input type="button" value="LogOut" ></div>
            </div>
            <?php } ?>
        </div>
    </header>

    <div id="DivNavSup">
        <nav id="menu_cabecera">
			<ul>
				<li><a href="https://www.planetadelibros.com/editorial/editorial-planeta/8">HOME</a></li>
				<li><a href="#">CATEGORIAS</a>
					<ul>
						<li><a href="#">AUTORES</a></li>
						<li><a href="https://www.planetadelibros.com/editorial/editorial-planeta/autores/a/8">TITULOS</a></li>
						<li><a href="http://novalibros.com/novedad-editorial/">NOVEDADES</a></li>
					</ul>
				</li>
			    <li><a href="https://es-es.facebook.com/">AMIGOS</a></li>
			 </ul>
		</nav>
    </div>
    <!--seccion de navegación lateral-->
	<div id="capitulos">
		<nav>
			<ul>
				<li><a href="NoAmigable.html">TITULO LIBRO</a></li>
				<li><a href="Capitulo1.html">Capitulo 1</a></li>
				<li><a href="Capitulo2.html">Capitulo 2</a></li>
				<li><a href="Capitulo3.html">Capitulo 3</a></li>
				<li><a href="Capitulo4.html">Capitulo 4</a></li>
			</ul>
		</nav>	
	</div>
	<!-- ---------------------------- -->
    <section>
        <div id="DivLogin">
            <label>Usuario</label><input type="text">
            <label>Contraseña</label><input type="password">
            <div id="login"><input type="button" value="Login" ></div>
        </div>
    </section>

    <footer></footer>
</body>
</html>
<?php
/**
* Subtarea 4: Vistas home.php contendrá la página principal:
*
*   Contiene un título que asignará por medio de la variable $datos['titulo']
*   Contiene un botón que ingresa a la página de registro. (Sólo se mostrará si no existe la cookie 'login')
*   Contiene un botón que ingresa a la página de login. (Sólo se mostrará si no existe la cookie 'login')
*   Contiene un botón logout que destruye la cookie login. (Sólo se mostrará si existe la cookie 'login')
*   Contiene un botón que ingresa a la página de administración de usuarios. (Sólo se muestra si existe sesión y el Rol es admin).
*   Contiene un botón que ingresa a la página de administración de libros. (Sólo se muestra si existe sesión y el Rol es admin).
*   Contiene una tabla con la información de los libros que se generará por medio de un foreach con la variable $datos['libros'].
*
* @file home.php
* @author Jose Ignacio Hidalgo Perez
* @title Subtarea 4: Vistas home.php contendrá la página principal
*/


if(isset($_POST['logout'])){
	setcookie('login','',time()-100);
	$_SESSION['Rol']="";
	echo "<script>window.location.href='http://localhost/dwes/tareaG/index.php/home'</script>";
}

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
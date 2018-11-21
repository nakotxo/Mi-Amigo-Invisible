<!--login.php--> 
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
            <div id="Logo">
                <img src='http://<?=URLSERVIDOR?>/multimedia/logo.jpg' class="headerImg">
            </div>
            <div id="TituloPagina">
                Mi Amigo Invisible
            </div>
            <div id="DivLogeado">
                <img src='http://<?=URLSERVIDOR?>/multimedia/mrx.jpg' id='imgLogin' class="headerImg">
            </div>
        </div>
    </header>

    <div id="DivNavSup">
        <nav id="menu_cabecera">
			<ul>
				<li><a href='http://<?=URLSERVIDOR?>/index.php/Home'>HOME</a></li>
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
        <h1><?php echo $datos['titulo'];?></h1><hr/>
        <section id="homeSection">
            <form method="POST" action="?">
                <div id="DivLogin">
                    <!--<img src='http:// <?php //URLSERVIDOR  ?>/multimedia/login.png'>-->
                    <label>Usuario</label><input id="usuario" type="text" name="usuario" placeholder="Nombre">
                    <label>Contraseña</label><input id="contrasena" type="password" name="contrasena" placeholder="Contraseña">
                    <div id="log"><input id="login" type="submit" name="Login" value="Login" ></div>
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

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Mi Amigo Invisible</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" media="screen" href="http://localhost/proyecto/main.css" />
        <script src="main.js"></script>
    </head>
<body>
    <header>
        <div id="DivHeader">
            <div id="Logo"></div>
            <div id="TituloPagina">Mi Amigo Invisible</div>
            <div id="DivLogeado">
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
        <h1><?php echo $datos['titulo']; $valor=''; ?></h1><hr/>
        <section>
            <form method="POST" action="?">
                <div id="DivLogin">
                    <label>Usuario</label><input id="usuario" type="text" name="usuario" placeholder="Nombre">
                    <label>Contraseña</label><input id="contrasena" type="password" name="contrasena" placeholder="Contraseña">
                    <div id="log"><input id="login" type="submit" name="Login" value="Login" ></div>
                </div>
            </form>
            <h1><?php echo $valor?></h1>
        </section>
        
    <footer></footer>
</body>
</html>
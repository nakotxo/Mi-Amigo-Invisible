

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
            <div id="TituloPagina"></div>
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
                    <input type="button" value="LogIn" onclick="location.href='http://localhost/proyecto/index.php/login'">
                </div>
                <?php
            }
            ?>

        </div>
    </header>

    <div id="DivNavSup">
        <nav id="menu_cabecera">
			<ul>
				<li><a href="location.href='http://localhost/proyecto/index.php/login'">HOME</a></li>
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
    <footer></footer>
</body>
</html>
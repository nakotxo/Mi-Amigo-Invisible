<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Mi Amigo Invisible</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" media="screen" href="http://localhost/proyecto/main.css" />
        <script src="http://localhost/proyecto/jquery3.3.1.js"></script>
        <script>
//            $(document).ready(function(){
//	            $("#login").click(function(){
//                    var deseoId=document.getElementById('deseoId').value;
//                    var deseo=document.getElementById('deseo').value;
//                    var caracteristicas=document.getElementById('caracteristicas').value;
//                    var accion = document.getElementById('login').value;
//                    if (accion=='Registrar'){
//                        /*int(deseoId)=deseoId;
//                        deseoId=deseoId+1;*/
//                        document.getElementById('deseoId').value=deseoId+1;
//                        document.getElementById('deseo').value=deseo
//                        document.getElementById('caracteristicas').value=caracteristicas;
//                        document.getElementById('login').value='Confirmar';
//                    }
//                    alert("has hecho click botón Corregir, "+deseoId+deseo+caracteristicas);
//                });
//            });
        </script>
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
            <?Php
            formularioDeseos();
        
            ?>
        </section>
        
    <footer></footer>
</body>
</html>
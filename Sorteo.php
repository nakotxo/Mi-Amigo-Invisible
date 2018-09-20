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
            $(document).ready(function(){
	            $("li").dblclick(function(){
                var Valor= $(this).attr("value");
                var NumHijos=
    /*-----Creamos un nodo nuevo con su atributo para agregar a la lista definitiva de partiticipantes*/    
                var nodo = document.createElement("li");
		        var textoNodo = document.createTextNode($(this).attr("title"));
		        var hijo= $(this).attr("value");
                nodo.appendChild(textoNodo);
		
		        var ul = document.getElementById("LstUsuFin");
		
		        ul.insertBefore(nodo,ul.children[0]);
    /* ------------------------------fin de la inserción---------------------------------------------- */
    /*------Eliminación del mismo dato para no crear duplicados en las listas--------- */
                var ulUsu = document.getElementById("LstUsu");
                alert("has hecho doble click en el párrafo con id="+hijo);
                ulUsu.removeChild(ulUsu.children[hijo]);
    /*-------------------------------fin de eliminacion------------------------------- */
                //alert("has hecho doble click en el párrafo con id="+Valor);
                });
            });


        </script>
        





    </head>
<body>
    <header>
        <div id="DivHeader">
            <div id="Logo"></div>

            <div id="TituloPagina"></div>
            
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
				<li><input type=submit name="MisDatos" value="Mis Datos"></li>
				<li><a href="Capitulo1.html">Capitulo 1</a></li>
				<li><a href="Capitulo2.html">Capitulo 2</a></li>
                <li><a href="http://localhost/proyecto/index.php/Crear_Sorteo">CrearSorteo</a></li>
				<li><input type=submit name="CreSor" value="Crear Sorteo"></li>
                <li><input type=submit name="LisUsu" value="Mis Sorteos"></li>
                <li><input type=submit name="Listado" value="Listado"></li>
			</ul>
        </nav>	
        </form>
	</div>
	<!-- ---------------------------- -->
        <h1><?php echo $datos['titulo']; ?></h1><hr/>
        <section>
            <?php 
            SoloSorteo(); 
            SoloUsuarios();
            ?>
            <p id="parrafo">Texto de párrafo <span> Texto dentro de un span</span>.</p>
        </section>
        
    <footer></footer>
</body>
</html>
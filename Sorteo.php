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
            var Participantes="";
            var arrayParticipantes= new Array() ; //array con el valor de los UsuId
            var arraySorteo= new Array();  //array con el resultado del random en indices
            var NumHijos;
            var NumHijosUlFinal;
            $(document).ready(function(){
	            $("li").dblclick(function(){
                    //Declaración de variables
                    var ulUsu = document.getElementById("LstUsu"); // nodo Lista de Usuarios
                    var ulFinal = document.getElementById("LstUsuFin"); // nodo lista de participantes
                    NumHijos= ulUsu.children.length; //numero de hijos que tiene la lista
                    var NumDelHijo=$(this).index(); // numero del indice del hijo
                    var Valor= $(this).attr("value"); //valor del attr value del li
                    var Title = $(this).attr("title"); //valor de attr title del li
                   
    /*-----Creamos un nodo nuevo con su atributo para agregar a la lista definitiva de partiticipantes*/    
                    var nodo = document.createElement("li");
		            var textoNodo = document.createTextNode(Title+" - "+Valor);
                    nodo.appendChild(textoNodo);
                    $(nodo).attr("title",Title);
                    $(nodo).attr("value",Valor);
                    
		            ulFinal.insertBefore(nodo,ulFinal.children[0]);
                    arrayParticipantes.unshift(Valor);
                    NumHijosUlFinal=ulFinal.children.length;
    /* ------------------------------fin de la inserción---------------------------------------------- */
    /*------Eliminación del mismo dato para no crear duplicados en las listas--------- */
                
                    alert("has hecho doble click en ul con numero hijos "+ NumHijos+", en el li hijo: "+NumDelHijo);
                    ulUsu.removeChild(ulUsu.children[NumDelHijo]);
    /*-------------------------------fin de eliminacion------------------------------- */
                    
                    //for (Cont=0,Cont<ul.children.length,Cont++)
                });
            });
            function realizarSorteo(){
                var NumRandom;
                var coincideUltimo=0;
                arraySorteo=[];
              if (NumHijosUlFinal>2){
                for (i=0;i!=NumHijosUlFinal;i++){
                    NumRandom= Math.random()*(NumHijosUlFinal-0)+0; // un número aleatorio entre min (incluido) y max (excluido) funcion = Math.random() * (max - min) + min;
                    NumRandom=parseInt(NumRandom);

                    for (j=0;j<=i;j++){
                        while ((NumRandom==arraySorteo[j])){
                            NumRandom= Math.random()*(NumHijosUlFinal-0)+0; // un número aleatorio entre min (incluido) y max (excluido) funcion = Math.random() * (max - min) + min;
                            NumRandom=parseInt(NumRandom);
                            j=-1;
                        }
                        if (j==NumHijosUlFinal-1){
                            if (NumRandom==j){
                                i=-1;
                                coincideUltimo=1;
                                break;
                            }
                        }
                        if ((i==0)&&(NumRandom==0)){
                            i=-1;
                            coincideUltimo=1;
                            break;
                        }
                    }
                    if (coincideUltimo==0){
                        arraySorteo[i]=NumRandom;
                    }
                    coincideUltimo==0;
                }
              }else{
                  alert("Para realizar el sorteo deben ser más de tres participantes.");
              }
            }


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
                <li><a href="http://localhost/proyecto/index.php/Crear_Sorteo">CrearSorteo</a></li>
                <li><input type=submit name="LisUsu" value="Mis Sorteos"></li>
                <li><input type=submit name="Listado" value="Listado"></li>
                <li><a name="LisUsu" value="MisSorteos" href="http://localhost/proyecto/index.php/adminusuarios">Mis Sorteos</a></li>
			</ul>
        </nav>	
        </form>
	</div>
	<!-- ---------------------------- -->
        <h1><?php echo $datos['titulo']; ?></h1><hr/>
        <section>
            <?php $SorteoId=NuevoSorteo();?>
            <form method="GET" action="?">
                <div id="DivSorteo">
                    <input id="SorteoId" type="hidden" name="SorId" value=" <?php echo $SorteoId ?>">    
                    <label>Sorteo</label><input id="Sorteo" type="text" name="SorNom" placeholder="Nombre Sorteo">
                    <label>Fecha</label><input id="Fecha" type="text" name="Sorfec" placeholder="Fecha sorteo dd/mm/aaaa">
					<?php SoloSorteo(); 
                          SoloUsuarios(); 
                          ?>

                    <button type="button" id="Sorteo" onclick="realizarSorteo()">Sorteo</button>
                </div>
            </form>
            <?php 


            














            if (isset($_POST['Listado'])){
                Listado();
            }elseif (isset($_POST['LisUsu'])){
                MisSorteos();
            }
            
            ?>
            
        </section>
        
    <footer></footer>
</body>
</html>
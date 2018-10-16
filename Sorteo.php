















































































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
            var botonCreado=0;
            var contInput=0;
            $(document).ready(function(){
	            $("li").dblclick(function(){
                    //Declaración de variables
                    var ulUsu = document.getElementById("LstUsu"); // nodo Lista de Usuarios
                    var ulFinal = document.getElementById("LstUsuFin"); // nodo lista de participantes
                    var formularioSorteo = document.getElementById("formularioSorteo");
                    NumHijos= ulUsu.children.length; //numero de hijos que tiene la lista
                    var NumDelHijo=$(this).index(); // numero del indice del hijo
                    var valor= $(this).attr("value"); //valor del attr value del li
                    var Title = $(this).attr("title"); //valor de attr title del li
                   
    /*-----Creamos un nodo nuevo con su atributo para agregar a la lista definitiva de partiticipantes*/    
                    
                    var nodo = document.createElement("li");
		            var textoNodo = document.createTextNode(Title+" - "+valor);
                    nodo.appendChild(textoNodo);
                    $(nodo).attr("title",Title);
                    $(nodo).attr("value",valor);
                    
		            ulFinal.insertBefore(nodo,ulFinal.children[0]);
                    arrayParticipantes.unshift(valor);
                    NumHijosUlFinal=ulFinal.children.length;

    /*------ Creamos input para realizar un envio de los datos y enviar por Post -----*/
                    var nodoInput= document.createElement("input");
                    $(nodoInput).attr("value",valor);
                    $(nodoInput).attr("type","text");
                    $(nodoInput).attr("name","input"+contInput);
                    
                    formularioSorteo.appendChild(nodoInput);
    /* ------------------------------------------------------------------------------ */
                    if (contInput==0){
                       var nodoTotalInput=document.createElement("input");
                       $(nodoTotalInput).attr("value",contInput+1);
                       $(nodoTotalInput).attr("id","hijos");
                       $(nodoTotalInput).attr("name","hijos");
                       formularioSorteo.insertBefore(nodoTotalInput,formularioSorteo.children[0]);
                    }else{
                        document.getElementById("hijos").value=contInput+1;
                    }
                    contInput++;
                    if ((NumHijosUlFinal>=3)&&(botonCreado==0)){
                        var nodoBoton= document.createElement("input");
                        $(nodoBoton).attr("value","SuperSorteo");
                        $(nodoBoton).attr("type","submit");
                        formularioSorteo.appendChild(nodoBoton);
                        
                        

                        botonCreado=1;
                    }

    /* ------------------------------fin de la inserción---------------------------------------------- */
    /*------Eliminación del mismo dato para no crear duplicados en las listas--------- */
                
                    //alert("has hecho doble click en ul con numero hijos "+ NumHijos+", en el li hijo: "+NumDelHijo);
                    ulUsu.removeChild(ulUsu.children[NumDelHijo]);
    /*-------------------------------fin de eliminacion------------------------------- */
                });
            });
    /*      function realizarSorteo(){
                var NumRandom =0;
                var coincideUltimo=0;
                var LstSorteo = document.getElementById("LstSorteo"); // nodo Lista de Usuarios
                var nodo;
                var textoNodo;
                var hijos= LstSorteo.children.length;
                var i=0;
                var j=0;
                /* borrar LstSorteo para pruebas
                for (a=0;a<hijos;a++){
                    LstSorteo.removeChild(LstSorteo.children[0]);
                }
                arraySorteo=[];
                
              if (NumHijosUlFinal>2){  //si no hay mas de tres participantes no hacemos el sorteo
 
                while (NumRandom==0){
                    NumRandom= Math.random()*(NumHijosUlFinal-0)+0; // un número aleatorio entre min (incluido) y max (excluido) funcion = Math.random() * (max - min) + min;
                    NumRandom=parseInt(NumRandom);
                    var primeraVez=true;
                }
                
                while (arraySorteo.length<NumHijosUlFinal){
                    if (!primeraVez){
                        /* Creación de un número aleatorio 
                        NumRandom= Math.random()*(NumHijosUlFinal-0)+0; // un número aleatorio entre min (incluido) y max (excluido) funcion = Math.random() * (max - min) + min;
                        NumRandom=parseInt(NumRandom);
                        /* Fin Número aleatorio 
                    }
                    primeraVez=false;
                    var existe=false;
                    for (i=0;i<arraySorteo.length;i++){
                        if (arraySorteo[i]==NumRandom){
                            existe=true;
                            break;
                        }
                        if (arraySorteo.length==NumRandom){
                            if (arraySorteo.length==(NumHijosUlFinal-1)){
                                existe=true;
                                i=0;
                                NumRandom=0;
                                while (NumRandom==0){
                                    NumRandom= Math.random()*(NumHijosUlFinal-0)+0; // un número aleatorio entre min (incluido) y max (excluido) funcion = Math.random() * (max - min) + min;
                                    NumRandom=parseInt(NumRandom);
                                    primeraVez=true;
                                }
                                arraySorteo=[];
                                break;
                            }
                            existe=true;
                            break;
                        }
                    }
                    if (!existe){
                        arraySorteo[arraySorteo.length]=NumRandom;
                    }
                }

              }else{
                  alert("Para realizar el sorteo deben ser más de tres participantes.");
              }
              /* Comprobación de funcionamiento de atgoritmo 
              hijos= LstSorteo.children.length;
              for(i=0;i<arraySorteo.length;i++){
                textoNodo = document.createTextNode(arraySorteo[i]);
                nodo = document.createElement("li");
                nodo.appendChild(textoNodo);
                LstSorteo.appendChild(nodo,LstSorteo.children[i]);
              }
    */
            
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
            <form id="formularioSorteo" method="POST" action="?">
                <div id="DivSorteo">
                    <input id="SorteoId" type="hidden" name="SorId" value="<?php echo $SorteoId ?>">    
                    <label>Sorteo</label><input id="Sorteo" type="text" name="SorNom" placeholder="Nombre Sorteo">
                    <label>Fecha</label><input id="Fecha" type="text" name="Sorfec" placeholder="Fecha sorteo dd/mm/aaaa">
                    
                    <?php 
                        //SoloSorteo(); 
                          SoloUsuarios(); 
                    ?>
                    
                   
                    
                </div>
            </form>
            
            <?php 


            


            if (isset($_POST['Listado'])){
                Listado();
            }elseif (isset($_POST['LisUsu'])){
                MisSorteos();
            }
            
            ?>
            <?php
if (isset($_POST['Sorteo'])){


    $hijos=$_POST['hijos'];
    $numMax=$hijos-1;
    $NumRandom =0;

    $arraySorteo=[];
    
    
        while ($NumRandom==0){
            $NumRandom= rand ( 0 , $numMax);//Math.random()*(NumHijosUlFinal-0)+0; // un número aleatorio entre min (incluido) y max (excluido) funcion = Math.random() * (max - min) + min;
            //$NumRandom=parseInt($NumRandom);
            $primeraVez=true;
        }
    
        while (sizeof($arraySorteo)<$hijos){
            if (!$primeraVez){
                /* Creación de un número aleatorio */
                $NumRandom= rand ( 0 , $numMax);
                /* Fin Número aleatorio */
            }
            $primeraVez=false;
            $existe=false;
            for ($i=0;$i<sizeof($arraySorteo);$i++){
                if ($arraySorteo[$i]==$NumRandom){
                    $existe=true;
                    break;
                }
                if (sizeof($arraySorteo)==$NumRandom){
                    if (sizeof($arraySorteo)==($hijos-1)){
                        $existe=true;
                        $i=0;
                        $NumRandom=0;
                        while ($NumRandom==0){
                            $NumRandom= rand ( 0 , $numMax);
                            $primeraVez=true;
                        }
                        $arraySorteo=[];
                        break;
                    }
                    $existe=true;
                    break;
                }
            }
            if (!$existe){
                $arraySorteo[sizeof($arraySorteo)]=$NumRandom;
            }
        }

    
    /* Comprobación de funcionamiento de atgoritmo */
    
    print_r($arraySorteo);
    //S0(A3-0,1,2,3,4)S12(A2-3,6,12,56,105).
    
    for ($i=0;$i<$hijos;$i++){
        $inputAmigo=$_POST['input'.$arraySorteo[$i]];
        $usuarioSorteo=$_POST['input'.$i];
        $string="S".$_POST['SorId']."(A".$inputAmigo."-,,,,)";
        $SQL= "update `usuarios` SET `UsuSorId`=".$string.", WHERE `UsuId`=".$usuarioSorteo;
        echo "<br>".$SQL;
    }
}


?>













        </section>
        
    <footer></footer>
</body>
</html>
<!--Sorteo.php-->
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Mi Amigo Invisible</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" media="screen" href='http://<?=URLSERVIDOR?>/main.css' />
        <script src='http://<?=URLSERVIDOR?>/jquery3.3.1.js'></script>
        <script>
            var arrayParticipantes= new Array() ; //array con el valor de los UsuId
            var NumHijos;
            var NumHijosUlFinal;
            var botonCreado=0;
            var contInput=0;
            $(document).ready(function(){
	            $("li").dblclick(function(){
                    //Declaración de variables
                    var ulUsu = document.getElementById("LstUsu"); // nodo Lista de usuarios
                    var ulFinal = document.getElementById("LstUsuFin"); // nodo lista de participantes
                    var formularioSorteo = document.getElementById("formularioSorteo");
                    NumHijos= ulUsu.children.length; //numero de hijos que tiene la lista
                    var NumDelHijo=$(this).index(); // numero del indice del hijo
                    var valor= $(this).attr("value"); //valor del attr value del li
                    var Title = $(this).attr("title"); //valor de attr title del li
                   
    /*-----Creamos un nodo nuevo con su atributo para agregar a la lista definitiva de partiticipantes*/    
                    
                    var nodo = document.createElement("li");
		            var textoNodo = document.createTextNode(valor+" - "+Title);
                    nodo.appendChild(textoNodo);
                    $(nodo).attr("title",Title);
                    $(nodo).attr("value",valor);
                    
		            ulFinal.insertBefore(nodo,ulFinal.children[0]);
                    arrayParticipantes.unshift(valor);
                    NumHijosUlFinal=ulFinal.children.length;

    /*------ Creamos input para realizar un envio de los datos y enviar por Post -----*/
                    var nodoInput= document.createElement("input");
                    $(nodoInput).attr("value",valor);
                    $(nodoInput).attr("type","hidden");
                    $(nodoInput).attr("name","input"+contInput);
                    
                    formularioSorteo.appendChild(nodoInput);
    /* ------------------------------------------------------------------------------ */
                    if (contInput==0){
                       var nodoTotalInput=document.createElement("input");
                       $(nodoTotalInput).attr("value",contInput+1);
                       $(nodoTotalInput).attr("id","hijos");
                       $(nodoTotalInput).attr("name","hijos");
                       $(nodoTotalInput).attr("type","hidden");
                       formularioSorteo.insertBefore(nodoTotalInput,formularioSorteo.children[0]);
                    }else{
                        document.getElementById("hijos").value=contInput+1;
                    }
                    contInput++;
                    if ((NumHijosUlFinal>=3)&&(botonCreado==0)){
                        var nodoBoton= document.createElement("input");
                        $(nodoBoton).attr("value","SuperSorteo");
                        $(nodoBoton).attr("name","Sorteo");
                        $(nodoBoton).attr("type","submit");
                        $(nodoBoton).attr("id","botoSor");
                        $(nodoBoton).attr("margin-right","30px");
                        formularioSorteo.appendChild(nodoBoton);
                        botonCreado=1;
                    }

    /* ------------------------------fin de la inserción---------------------------------------------- */
    /*------Eliminación del mismo dato para no crear duplicados en las listas--------- */
                
                    //alert("has hecho doble click en ul con numero hijos "+ NumHijos+", en el li hijo: "+NumDelHijo);
                    ulUsu.removeChild(ulUsu.children[NumDelHijo]);
    /*-------------------------------fin de eliminacion------------------------------- */

                });
                $("#LstUsuFin").dblclick(function(){
                    //alert("has hecho doble click en ul con numero hijos "+ NumHijos+", en el li hijo: ");
                    alert("Esta función todavía no está en funcionamiento\nPulse CORREGIR DATOS para reiniciar.");
                });
                /*$("#Corregir").click(function(){
                    alert("has hecho doble click botón Corregir");
                   // header('Location: Crear_Sorteo');
                    //window.location.href=http://'.URLSERVIDOR.'/index.php/Home
                    //location.reload;
                    alert("has hecho doble click botón Corregir");
                });*/
            });
            
            
        </script>
    </head>
<body>

<header>
        <div id="DivHeader" class="mycontainer">
            <div id="Logo">
                <img src='http://<?=URLSERVIDOR?>/multimedia/logo.jpg' class="headerImg">
            </div>
            <div id="TituloPagina">
                Mi Amigo Invisible
            </div>
            <?php 
            if (isset($_SESSION['Usuario'])&&($_SESSION['Usuario']!="")){
                ?>
                <div id="DivLogOut">
                    <div class='formLogin'>
                        <img src='http://<?=URLSERVIDOR?>/multimedia/mrx.jpg' id='imgLogin' class="headerImg">
                        <label id='lblLogin'>Bienvenido Usuario<br/><?php echo $_SESSION['Usuario'] ?></label>
                        <form method="POST" action="?">
                            <input id='inpLogin2' type="submit" name="logout" value="LogOut" >
                        </form>
                    </div>
                </div>
                <?php    
            }else{
                ?>
                <div id="DivLogeado">
                    <div class='formLogin'>
                        <img src='http://<?=URLSERVIDOR?>/multimedia/mrx.jpg' id='imgLogin' class="headerImg">
                        <div id='inpLogin'>
                            <input id='inpLogin2' type="button" value="LogIn" onclick="location.href='http://<?=URLSERVIDOR?>/index.php/login'">
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>

        <div id="DivNavSup">
            <nav id="menu_cabecera">
	    		<ul>
                <li id='primerLi'><a href='http://<?=URLSERVIDOR?>/index.php/Home'>HOME</a></li>
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
    </header>
    <?php 
        if (isset($_SESSION['Usuario'])&&($_SESSION['Usuario']!="")){
        ?>  
            <!--seccion de navegación lateral-->
            <div id="capitulos" class="mycontainer">
                <form method="POST" action="?">
                  <nav>
                    <ul>
                        <li><a href='http://<?=URLSERVIDOR?>/index.php/Mis_Datos'>Mis Datos</a></li>
                        <li><a href='http://<?=URLSERVIDOR?>/index.php/Mis_Sorteos'>Mis Sorteos</a></li>
                        <li><a href='http://<?=URLSERVIDOR?>/index.php/Crear_Sorteo'>Crear Sorteo</a></li>
                        <li><a href='http://<?=URLSERVIDOR?>/index.php/Crear_Deseos'>Crear Deseo</a></li>
                        <li><a href='http://<?=URLSERVIDOR?>/index.php/Manual_Usuario'>Manual Usuario</a></li>
                        <?php
                            if ($_SESSION['Rol']=='Root'){
                                echo ('<li><a href=http://'.URLSERVIDOR.'/index.php/Listados>Listados</a></li>');
                            }
                        ?>
                    </ul>
                  </nav>	
                </form>
            </div>
<!----------------------------------- FIN CABECERAS Y SECCIONES DE NAVEGACION ---------------------------- -->
            <h1><?php echo $datos['titulo']; ?></h1><hr/>
            <section>
                <?php
                $mensaje='';
                $user_agent = $_SERVER['HTTP_USER_AGENT'];
                $navegador = getBrowser($user_agent);
            

                if($navegador=='Safari'){
                    echo "<h1>El navegador ".$navegador." todavía no es compatible con esta función.</h1>";
                    echo '<h2>El programa esta optimizado para navegadores <span>Google Chrome</span> y <span>Firefox</span></h2>';
                }else{
                    ?>
                    <div>
                        <p>Si ha habido alguna confusión a la hora de
                            rellenar los datos, puede corregirlos, pulsando
                            el botón<span> CORREGIR DATOS</span> lo que probocará
                            la recarga de la página</p>
                        <form action='?' method='GET'>
                            <input id='impCorregir' type='submit' value='CORREGIR DATOS'>
                        </form>
                        <br>
                        <?php 
                        if (isset($_POST['Sorteo'])){
                            if ((empty($_POST['SorNom']))||(empty($_POST['SorFec']))){
                                echo "<h3>No se puede realizar el sorteo ya que faltan datos del SORTEO</h3>";
                            }else{
                                $mensaje=superSorteo();
                            }
                        }
                        ?>
                    </div>
                    <?php $SorteoId=NuevoSorteo();?>
                    <form id="formularioSorteo" method="POST" action="?">
                        <div id="DivSorteo">
                            <div id='divDatosSorteo'>  
                                <input id="SorteoId" type="hidden" name="SorId" value="<?php echo $SorteoId ?>">    
                                <label>Sorteo</label><input id="Sorteo" type="text" name="SorNom" placeholder="Nombre Sorteo">
                                <label>Fecha</label><input id="Fecha" type="date" name="SorFec" placeholder="Fecha sorteo dd/mm/aaaa">
                                <label>Presupuesto</label><input id="Presupuesto" type="text" name="SorPre" placeholder="75€">
                            </div>  
                            <?php 
                            //SoloSorteo(); 
                            Solousuarios(); 
                            ?>
                        </div>
                    </form>
                <?php
                }
                echo $mensaje;
                ?>
                
            </section>
        <?php
            
            }else{
                ?>
                <h1><?php echo $datos['titulo']; ?></h1><hr/>
                <h2>Identificación de usuario necesaria</h2>
                <h3>Para acceder a esta página, introduzca Nombre Usuario y Contrseña</h3>
                <section id="homeSection">
                    <?php
                    formularioLogin();
                    ?>
                    <h3><?php echo $valor?></h3>
                </section>
                <?php
            }
        ?>
        
        <footer> 
            <p>Para cualquier consulta o error, no dude en contactar con el administrador.<br>
            Contacto: <a id="emailA" href="mailto:HidalgoJ.Ignacio@gmail.com">HidalgoJ.Ignacio@gmail.com</a><br>
            Creado por: Jose Ignacio Hidalgo</p>
        </footer>
</body>
</html>
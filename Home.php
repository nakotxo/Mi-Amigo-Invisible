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
<html>
	<head>
		<meta charset="UTF-8"/>
		<style> 
			body{
				margin:0px center;
				background:#848484;
			}
			table td{
				width:200px;
				}
			legend{
				background:#F2F2F2;
			}
			#herramientas{
				color:black;
				font-size:18px;
				margin:22px auto; 
				padding: 10px; 
				width: 25%;
				max-width: 250px;
				background:#F2F2F2;
				text-align:center;
			}
			#herramientas2{
				color:black;
				font-size:18px;
				margin:10px auto; 
				padding: 10px; 
				width: 500px;
				background:#F2F2F2;
				text-align:center;
			}
			fieldset{
				color:black;
				font-size:18px;
				margin:22px auto; /* margenes */
				padding: 50px; /* cambiado a 50 px */
				width: 100%;
				max-width: 500px;
				background:#F2F2F2;
				text-align:center;
			}
			form{
				margin:0px center;
			}
			h1,h2{
				text-align: center;
				color:white;
			}
			
			
			
		</style>
		<script type="text/javascript">
		/**
		* Función procesarlibro(cadena) 
		*
		* Recibe los datos introducidos en el span sugerencias
		* Hace la llamada ajax que realiza la seleccion de resultados con la cadena
		* 
		* @file home.php
		* @author Jose Ignacio Hidalgo Perez
		* @title Subtarea 5: Sugerencias, para titulo libro, procesarlibro
		* @param Variable cadena
		*/
		function procesarlibro(cadena){
			//si la cadena esta vacia, limpiamos el campo
			if(cadena.length==0){
				document.getElementById("sugerencias2").innerHTML="";
				return;
			}else{	//hacemos la peticion
				var asyncRequest = new XMLHttpRequest();
				//asignamos a la propiedad la función que se llamará cuando el estado de la petición cambie				
				asyncRequest.open("GET","http://localhost/dwes/tareaG/sugerenciasJIH.php?Libro=" + cadena, true);
				asyncRequest.onreadystatechange = CambiosEnInput; 					
				asyncRequest.send(null);
			}
		
			/**
			* Función CambiosEnInput()
			* 
			* Si la peticion ha sido concluida
			* Decodigfica JSON y llama a la funcion encargada de visualizar el dato
			*			
			* @file home.php
			* @author Jose Ignacio Hidalgo Perez
			* @title Subtarea 5: Sugerencias, para titulo libro, CambiosEnInput
			*/		
			function CambiosEnInput(){
				if(asyncRequest.readyState == 4 && asyncRequest.status == 200){
					//limpiamos por si había algo antes
					document.getElementById("sugerencias2").innerHTML = "";

					//puesto que hemos mandado la petición en formato JSON, la convertimos a un array
					var resultado = window.JSON.parse(asyncRequest.responseText);

					//para cada elemento del array, llamamos a mostrarResultado,
					//el forEach automaticamente pasa el elemento como parámetro
					resultado.forEach(mostrarResultado);

				}
			}
			/**
			* Función mostrarResultado(contenido)
			*
			* Recibimos una cadena y lo añade al campo sugerencias con un salto de línea
			*			
			* @file home.php
			* @author Jose Ignacio Hidalgo Perez
			* @title Subtarea 5: Sugerencias, para titulo libro, mostrarResultado
			* @param Variable contacto
			*/
			function mostrarResultado(contacto){
				document.getElementById("sugerencias2").innerHTML += contacto.titulo + " | " + contacto.fecha_public + "<br />";
			}
		}
		
		/**
		* Función procesar(cadena) 
		*
		* Recibe los datos introducidos en el span sugerencias
		* Hace la llamada ajax que realiza la seleccion de resultados con la cadena
		* 
		* @file home.php
		* @author Jose Ignacio Hidalgo Perez
		* @title Subtarea 5: Sugerencias, para autor, procesar
		* @param Variable cadena
		*/
		function procesar(cadena){
			//si la cadena esta vacia, limpiamos el campo
			if(cadena.length==0){
				document.getElementById("sugerencias").innerHTML="";
				return;
			}else{	//hacemos la peticion
				var asyncRequest = new XMLHttpRequest();
				//asignamos a la propiedad la función que se llamará cuando el estado de la petición cambie				
				asyncRequest.open("GET","http://localhost/dwes/tareaG/sugerenciasJIH.php?Autor=" + cadena, true);
				asyncRequest.onreadystatechange = CambiosEnInput; 					
				asyncRequest.send(null);
			}
		
			/**
			* Función CambiosEnInput()
			* 
			* Si la peticion ha sido concluida
			* Decodigfica JSON y llama a la funcion encargada de visualizar el dato
			*			
			* @file home.php
			* @author Jose Ignacio Hidalgo Perez
			* @title Subtarea 5: Sugerencias, para autor, CambiosEnInput
			*/	
			function CambiosEnInput(){
				if(asyncRequest.readyState == 4 && asyncRequest.status == 200){
					//limpiamos por si había algo antes
					document.getElementById("sugerencias").innerHTML = "";

					//puesto que hemos mandado la petición en formato JSON, la convertimos a un array
					var resultado = window.JSON.parse(asyncRequest.responseText);

					//para cada elemento del array, llamamos a mostrarResultado,
					//el forEach automaticamente pasa el elemento como parámetro
					resultado.forEach(mostrarResultado);

				}
			}
			/**
			* Función mostrarResultado(contenido)
			*
			* Recibimos una cadena y lo añade al campo sugerencias con un salto de línea
			*			
			* @file home.php
			* @author Jose Ignacio Hidalgo Perez
			* @title Subtarea 5: Sugerencias, para autor, mostrarResultado
			* @param Variable contacto
			*/
			function mostrarResultado(contacto){
				document.getElementById("sugerencias").innerHTML += contacto.nombre + " | " + contacto.apellidos + "<br />";
			}
		}
		</script>
		
		<title>Home</title>
	</head>
	<body>
		<!--Contiene un título que asignará por medio de la variable $datos['titulo']-->
		<h1><?php echo $datos['titulo']; ?></h1><hr/>
		<!--Contiene una tabla con la información de los libros que se generará por medio de un foreach con la variable $datos['libros'].-->
			<fieldset>
				<legend>Listado Libros & autores</legend>
				<table align="center">
					<tr>
						<td>Título</td>
						<td>Fecha Publicación</td>
						<td>Autor y Apellidos</td>
					</tr>
				
					<?php 

					foreach($datos['libros'] as $valor){
						echo "<tr>";
						echo "<td>$valor[titulo]</td>";
						echo "<td>$valor[fecha_public]</td>";
						echo "<td>$valor[nombre] $valor[apellidos]</td>";
						echo "</tr>";
					}
					?>
				</table>
			</fieldset>
		<div id="formulario">
			<fieldset>
				<legend>Sugerencias Titulo/Autor</legend>
				<form id="formulariodatos">
					<label for="Nombre">Realiza la busqueda del autor o del libro</label><br /><br/>
					<!--input controlador evento onkeyup-->
					<input type="text" id="Nombre" name="libro" placeholder="Titulo Libro" onkeyup="procesarlibro(this.value)">
					&nbsp;&nbsp;&nbsp;
					<input type="text" id="Nombre" name="autor" placeholder="Autor" onkeyup="procesar(this.value)">
					<br />
				</form>
				<span id="sugerencias2" Style="color:#0055FF;"></span><br>
				<span id="sugerencias" Style="color:#0055FF;"></span>
			</fieldset>
		</div>
		<form method="POST">
		
			<?php
			/*Contiene un botón que ingresa a la página de registro. (Sólo se mostrará si no existe la cookie 'login')
			Contiene un botón que ingresa a la página de login. (Sólo se mostrará si no existe la cookie 'login')*/
			if (!isset($_COOKIE['login'])){
				
				?>
				<fieldset id="herramientas">
					<legend>Controles Usuario</legend>
					<input type="button" value="Página de registro" onClick="window.location.href='index.php/registro'"/>
					<input type="button" value="Página Login" onClick="window.location.href='login'"/>
				</fieldset>
				<?php
				
			/*Contiene un botón que ingresa a la página de administración de usuarios. 
			Contiene un botón que ingresa a la página de administración de libros. 
			(Sólo se muestra si existe sesión y el Rol es admin).*/
			}else if (isset($_SESSION['Rol'])){

				if ($_SESSION['Rol']=="admin"){
					?>
					<fieldset id="herramientas2">
						<legend>Controles Administrador</legend>
						<input type="button" value="Página Administración de usuarios" onClick="window.location.href='index.php/admin_usuarios'"/>
						<input type="button" value="Página Administración de Libros" onClick="window.location.href='index.php/controlador_admin_libros'"/>
						<input type="submit" value="Logout" name="logout"/>
					</fieldset>
					<?php
				}else{
					?>
					<fieldset id="herramientas">
						<legend>Controles Usuario</legend>
						<input type="submit" value="Logout" name="logout"/>
					</fieldset>
					<?php
				}
			}
			?>
		</form>
		<footer><hr/><h2>Created by Ñako, Jose Ignacio Hidalgo Perez, 22748787Q<h2></footer>
	</body>
</html>
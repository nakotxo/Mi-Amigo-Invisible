<?php
/**
* Subtarea 2: 
*
* Creación del controlador
* controlador.php 
* definirá las funciones del controlador frontal, es decir, definirá el comportamiento de nuestra aplicación:
* @file controlador.php
* @author Jose Ignacio Hidalgo Perez
* @title Subtarea 2 Creacion del Controlador
*/

/** 
* Función controlador_index()
*
* Define una variable array y llámada datos
* $datos['titulo'] asígnada un título (Ej: Todo libros)
* $datos['libros'] asígnada el retorno de la función get_libros_autores() del modelo (Las funciones del modelo las definiremos en el próximo punto)
* como último paso incluye home.php
* @file controlador.php
* @author Jose Ignacio Hidalgo Perez
* @title Subtarea 2 Creacion del Controlador, controlador_index
*/
function controlador_index(){	
	$datos[]=array();
	$datos['titulo']="Mi Amigo Invisible";
	require_once 'home.php';
}

/**
* Funcion controlador_login()
*
* Define una variable array y se le llama datos.
* $datos['titulo'] = 'Página de login'.
* Si la página de login.php ha enviado una petición POST la procesamos:
* Comprobamos que el usuario insertado existe con la función existe_usuario($usuario) del modelo.
* Comprobamos que la contraseña insertada coincide con la del usuario de la base de datos con la función comprueba_usuario($usuario, $contrasena) del modelo.
* Si la función anterior retorna true:
* Crear una Cookie cuyo nombre = login y valor = true y tenga caducidad = 1 día.
* Crear una sesión.
* Añadir a la sesión una [clave, valor] clave=Usuario y valor=[valor del usuario del formulario]
* Añadir a la sesión una [clave,valor] clave=Rol y valor=[valor del rol del usuario del formulario]
* Para saber el rol ejecutamos la función get_rol($usuario) del modelo.
* Como último paso incluye login.php
* @file controlador.php
* @author Jose Ignacio Hidalgo Perez
* @title Subtarea 2 Creacion del Controlador, controlador_login
*/
function controlador_login(){
	
	$datos[]=array();
	$datos['titulo']="Página de Logeo";

	if(isset($_POST['login'])){
		
		
		$usuario = $_POST['usuario'];
		$contrasenaCifrada = md5($_POST['contrasena']);
		$contrasena=($_POST['contrasena']);
		
		if (existe_usuario($usuario)){
					
			if (comprueba_usuario($usuario, $contrasena, $contrasenaCifrada)){
				
				setcookie('login','true',time()+ 3600*24);
				$_SESSION['Usuario']=$usuario;
				$_SESSION['Rol']=get_rol($usuario);
				echo "usuario y contraseña correcto he hecho login";
				echo "<script>window.location.href='http://localhost/dwes/tareaG/index.php/home'</script>";
			}
		
		}else{
			
			echo "Error en usuario y contraseña";
		
		}
	}else{
			
	}
	
	require 'login.php';
	
}

/**
* Función get_Conexion()
* 
* Establece conexión con la base de datos
* 
* @file controlador.php
* @author Jose Ignacio Hidalgo Perez
* @title Subtarea 2 Creacion del Controlador, get_Conexion
* @return variable $conexion
*/

function get_Conexion(){
	$servidor= "localhost";
	$usuario= "id3972968_joseignaciohidalgo";
	$psw= "AmigoInvisible";
	$bd= "id3972968_amigoinvisible";
	
	$conexion= new mysqli($servidor,$usuario,$psw,$bd);
	
	if ($conexion->connect_error ){
		die("Connection failed: " . $conexion->connect_error);
	}else{
		$conexion->set_charset ("utf8");
		return $conexion;
	}
}
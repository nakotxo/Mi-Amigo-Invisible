<?php
	/**
	* Subtarea 1: Creación del controlador frontal
	*
	*	index.php será la página que hará las veces de controlador.
	*
	*    Inclulle al principio del documento modelo.php
	*    Inclulle al principio del documento controlador.php.
	* 	 Fijándonos en el controlador frontal de la unidad 5 desarrolla las condiciones necesarias para enrutar:
	* 	/index.php para controlador_index()
	* 	/Controlador.php/registro para controlador_registro()
	* 	/Controlador.php/login para controlador_login()
	* 	/admin_usuarios.php/admin_usuarios para controlador_admin_usuarios()
	* 	/admin_libros.php/admin_libros para controlador_admin_libros()
	*
	* @file index.php
	* @author Jose Ignacio Hidalgo Perez
	* 
	*/
session_start();
	
	
	require_once "modelo.php";
	require_once "controlador.php";

	$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	$segments = explode('/', $path);
	$URL = $segments[count($segments)-1];

	if ($URL == 'home'){
		controlador_index();
	}elseif ($URL == 'registro'){
		controlador_registro(); 
	}elseif ($URL == 'login'){
		controlador_login();
	}elseif ($URL == 'admin_usuarios'){
		controlador_admin_usuarios(); 
	}elseif ($URL == 'controlador_admin_libros'){
		controlador_admin_libros(); 
	}else{ //Podemos gestionar errores de URL de esta forma
		header('Status: 404 Not Found');
		echo "Error, página inexistente";
	}
?>

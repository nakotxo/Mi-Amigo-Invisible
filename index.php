<?php
	/**
	*
	*	index.php será la página que hará las veces de controlador.
	*
	*    Inclulle al principio del documento modelo.php
	*    Inclulle al principio del documento controlador.php.
	* 	/index.php para controlador_index()
	*
	* @file index.php
	* @author Jose Ignacio Hidalgo Perez
	* 
	*/
session_start();
	
	require_once "Modelo.php";
	require_once "Controlador.php";

	$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	$segments = explode('/', $path);
	$URL = $segments[count($segments)-1];

	if ($URL == 'Home'){
		controlador_index();
	}elseif ($URL == ''){
	    controlador_index(); 
	}elseif ($URL == 'index.php'){
	    controlador_index();
	}elseif ($URL == 'Registro'){
		controlador_registro(); 
	}elseif ($URL == 'Manual_Usuario'){
		controlador_admin_usuarios(); 
	}elseif ($URL == 'Mis_Datos'){
		controlador_Mis_Datos(); 
	}elseif ($URL == 'login'){
		controlador_login();
	}elseif ($URL == 'Crear_Sorteo'){
		Controlador_Sorteo();
	}elseif ($URL == 'Mis_Sorteos'){
		Controlador_Mis_Sorteos();
	}elseif ($URL == 'Listados'){
		Controlador_Listados();
	}elseif ($URL == 'Crear_Deseos'){
		Controlador_Crear_Deseos();
	}else{ //Podemos gestionar errores de URL de esta forma
		header('Status: 404 Not Found');
		echo "Error, página inexistente";
	}
?>

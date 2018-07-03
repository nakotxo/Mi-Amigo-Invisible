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
* Función controlador_registro()
*
* Definine una variable array y se le llama datos
* $datos['titulo] asígnada el título 'Página de registro'
* Si la página de registro.php ha enviado una petición POST la procesamos: (como en la tarea de la unidad 6)
* Comprobamos que el usuario insertado no existe con la función existe_usuario($usuario) del modelo.
* Ingresamos los datos del nuevo usuario con la función registrar_usuario($datos_usuario) donde:
* $datos_usuario contiene la información de todos los campos del formulario
* la contraseña debe incluirse encriptada en el array $datos_usuario.
* deben incluirse los valores Rol=usuario Ban=false
* como último paso incluye registro.php
* @file controlador.php
* @author Jose Ignacio Hidalgo Perez
* @title Subtarea 2 Creacion del Controlador, controlador_registro
*/
function controlador_registro(){
	$datos[]=array();
	$datos['titulo']="Página de registro";
	if (isset($_POST['registrar'])){
		$usuario=$_POST['usuario'];
		if (existe_usuario($usuario)==false){
			// $datos_usuario contiene la información de todos los campos del formulario
			$datos_usuario=array(
							'usuario' => $_POST['usuario'], 
							'nombre' => $_POST['nombre'],
							'apellidos' => $_POST['apellidos'],
							'email' => $_POST['email'],
							'contrasena' => md5($_POST['contrasena']),
							'rol' => 'usuario',
							'ban' => 'false');
		//Ingresamos los datos del nuevo usuario con la función registrar_usuario($datos_usuario)
		registrar_usuario($datos_usuario);
		}else{
			echo "El usuario ya existe, prueba con otros datos";
		}
	}
	require 'registro.php';
}
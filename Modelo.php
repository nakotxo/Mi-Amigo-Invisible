<?php




function existe_usuario($usuario){

	if ($mysqli = get_Conexion()){		//Realizacion de conexion a base de datos
		
		$registroOK=false;
		$sql="SELECT UsuNom FROM usuarios WHERE UsuNom='$usuario'";		//Select para ejecutar, donde, seleccionará todos los registros de la BD

		if ($resultado=$mysqli->query($sql)){
			
			while ($fila=$resultado->fetch_assoc()){	//mientras no sea eof(fin de tabla) seguimos al siguiente registro			
				if ($fila['UsuNom']==$usuario){
					$registroOK=true; //true=1
				}else{
					$registroOK=false;  //false=0
				}
			}
			return $registroOK;
		}else{
			
			echo "Error en la consulta Existe Usuario";
		
		}
	}else{
		
		echo "<h3>Error conexión con la base de datos</h3>";
	
	}
}
	
/**
* Función comprueba_usuario($usuario, $contrasena, $contrasenaCifrada)
*
* Función que retorne true si coincide la contraseña 
* del parámetro con la contraseña del usuario especificado, 
* false en caso contrario.
*
* @file controlador.php
* @author Jose Ignacio Hidalgo Perez
* @title Subtarea 3: Creación del modelo.php, comprueba_usuario
* @return Variable $registroOK
* @param Variable $usuario $contrasena $contrasenaCifrada 
*/
function comprueba_usuario($usuario, $contrasena, $contrasenaCifrada){
	
	if ($mysqli = get_Conexion()){		//Realizacion de conexion a base de datos
		$registroOK=false;
		$sql="SELECT UsuNom, UsuPwd FROM usuarios WHERE UsuNom='$usuario'";		//Select para ejecutar, donde, seleccionará todos los registros de la BD
		
		if ($resultado=$mysqli->query($sql)){
			
			while ($fila=$resultado->fetch_assoc()){	//mientras no sea eof(fin de tabla) seguimos al siguiente registro			
				if (($fila['UsuNom']==$usuario)&&(($fila['UsuPwd']==$contrasena)||($fila['UsuPwd']==$contrasenaCifrada))){
					$registroOK=true; 
				}else{
					$registroOK=false;  
				}
			}
			return $registroOK;
		}else{
			
			echo "Error en la consulta usuario y contraseña";
		}
	}else{
		
		echo "<h3>Error conexión con la base de datos</h3>";
	
	}
}

/**
* Función get_rol($usuario) 
*
* Función que devuelve el rol del usuario especificado como cadena.
*
* @file controlador.php
* @author Jose Ignacio Hidalgo Perez
* @title Subtarea 3: Creación del modelo.php, get_rol
* @return Variable $rol
* @param Variable $usuario
*/
function get_rol($usuario){
	if ($mysqli = get_Conexion()){		//Realizacion de conexion a base de datos
		
		$sql="select UsuNom,UsuRol from usuarios WHERE UsuNom='$usuario'";		//Select para ejecutar, donde, seleccionará todos los registros de la BD
		
		if ($resultado=$mysqli->query($sql)){
			
			while ($fila=$resultado->fetch_assoc()){	//mientras no sea eof(fin de tabla) seguimos al siguiente registro			
				$rol=$fila['UsuRol'];
			}
			return $rol;
		}else{
			
			echo "Error en la consulta Rol";
		
		}
	}else{
		
		echo "<h3>Error conexión con la base de datos</h3>";
	
	}
}

/**
* Función get_ban(true/false) 
*
* Función quw devuelve un array de usuarios cuyo Ban sea el parámetro booleano. 
* Si true, entonces devuelve los usuarios con Ban=true, análogamente con false.
*
* @file controlador.php
* @author Jose Ignacio Hidalgo Perez
* @title Subtarea 3: Creación del modelo.php, get_ban
* @return Array $datos
* @param Variable $valor
*/
function get_ban($valor){
	if ($mysqli = get_Conexion()){		//Realizacion de conexion a base de datos
		
		$sql="SELECT * FROM usuarios WHERE Ban='".$valor."'";		//Select para ejecutar, donde, seleccionará todos los registros de la BD

		$datos[]=array();
		$arrayAyuda[]=array();
		
		if ($resultado=$mysqli->query($sql)){
			
			while ($fila=$resultado->fetch_assoc()){	//mientras no sea eof(fin de tabla) seguimos al siguiente registro			
				
				array_push($datos,$arrayAyuda=array(
				'usuario'=>$fila['Usuario'],
				'nombre'=>$fila['Nombre'],
				'apellidos'=>$fila['Apellidos'],
				'email'=>$fila['Email'],
				'rol'=>$fila['Rol'],
				'ban'=>$fila['Ban']
				));
				
			}
			unset($datos[0]);

			return $datos;
		}else{
			
			echo "Error en la consulta Baneado";
		
		}
	}else{
		
		echo "<h3>Error conexión con la base de datos</h3>";
	
	}
}
/**
* Función set_ban($usuario, true/false) 
* 
* Funcion que asigna el parámetro booleano a la columna Ban del usuario pasado. 
* Si set_ban('pepe', true) entonces pepe está baneado.
*
* @file controlador.php
* @author Jose Ignacio Hidalgo Perez
* @title Subtarea 3: Creación del modelo.php, set_ban
* @param Variable $usuario $OK-> Baneo 
*/
function set_ban($Usuario, $Ban){
	if ($mysqli = get_Conexion()){		//Realizacion de conexion a base de datos
		
		
		$sql="UPDATE Usuarios SET Ban ='$Ban' WHERE Usuario='$Usuario'";	//update
		
		if ($resultado=$mysqli->query($sql)){
			
			echo "UPDATE Realizada";

		}else{
			
			echo "Error en la UPDATE";
		
		}
	}else{
		
		echo "<h3>Error conexión con la base de datos</h3>";
	
	}
}


/**
* Función set_libro($datos_libro)
*
* Función que incluye una nueva entrada en la tabla Libro.
*
* @file controlador.php
* @author Jose Ignacio Hidalgo Perez
* @title Subtarea 3: Creación del modelo.php, set_libro
* @param Array $datos_lib
*/
function set_libro($datos_lib){
	
	if ($mysqli = get_Conexion()){		//Realizacion de conexion a base de datos

		//Insertar datos iniciales
		$sql = "INSERT INTO libro (id, titulo, fecha_public, id_autor) 
				VALUES ('$datos_lib[id]','$datos_lib[titulo]','$datos_lib[fecha_public]','$datos_lib[id_autor]')";
		
		if ($mysqli->query($sql)){
			
			echo "Inserción en tabla Libro realizada con éxito<br>";
		
		}else{
			
			echo "Error insertando datos<br>".$mysqli->error."<br>";
			$error=$mysqli->error;

		}
	}else{
		
		echo "<h3>Error conexión con la base de datos</h3>";
		
	}
}


/**
* Función set_autor($datos_autor) 
* Función que incluye una nueva entrada en la tabla Autor.
*
* @file controlador.php
* @author Jose Ignacio Hidalgo Perez
* @title Subtarea 3: Creación del modelo.php, set_autor
* @param Array $datos_autor
*/
function set_autor($datos_autor){

	if ($mysqli = get_Conexion()){		//Realizacion de conexion a base de datos
		
		//Insertar datos iniciales
		$sql = "INSERT INTO autor (id, nombre, apellidos, fecha_nac) 
				VALUES ('$datos_autor[id]','$datos_autor[nombre]','$datos_autor[apellidos]','$datos_autor[fecha_nac]')";
			
		if ($mysqli->query($sql)){
			
			echo "Inserción en tabla Autor realizada con éxito<br>";
		
		}else{
			
			echo "Error insertando datos<br>".$mysqli->error."<br>";
			$error=$mysqli->error;
		
		}
	}else{
		
		echo "<h3>Error conexión con la base de datos</h3>";
		
	}
}

/**
* Función registrar_usuario
*
* Función que incluye una nueva entrada a la tabla usuarios
*
* @file controlador.php
* @author Jose Ignacio Hidalgo Perez
* @title Subtarea 3: Creación del modelo.php, registrar_usuario
* @param Array $datos_usuario
*/
function registrar_usuario($datos_usuario){
	if ($mysqli = get_Conexion()){		//Realizacion de conexion a base de datos

		//Insertar datos 
		$sql = "INSERT INTO usuarios (Usuario, Nombre, Apellidos, Email, Contrasena, Rol, Ban) 
				VALUES ('$datos_usuario[usuario]','$datos_usuario[nombre]','$datos_usuario[apellidos]','$datos_usuario[email]','$datos_usuario[contrasena]','Usuario','False')";
		if ($mysqli-> query($sql)){
			echo "Inserción en tabla usuarios realizada con éxito<br>";
		}else{
			echo "error insert registro";
		}
	}else{
		echo "Error conexion";
	}
}

?>

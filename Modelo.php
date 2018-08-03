<?php

if(isset($_POST['logout'])){
	setcookie('login','',time()-100);
    $_SESSION['Rol']="";
    $_SESSION['Usuario']="";
	echo "<script>window.location.href='http://localhost/proyecto/index.php/Home'</script>";
}

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



function NuevoUsuario($UsuarioId){
	if ($mysqli = get_Conexion()){		//Realizacion de conexion a base de datos
		$sql="SELECT UsuId FROM usuarios";		//Select para ejecutar, donde, seleccionará los Id delos usuario de la BD
		
		if ($resultado=$mysqli->query($sql)){
			$UsuarioId=0;
			while ($fila=$resultado->fetch_assoc()){	//mientras no sea eof(fin de tabla) seguimos al siguiente registro			

				if ($fila['UsuId']>=$UsuarioId){
					$UsuarioId++;	//incremento la variable para obtener el primer Id vacio
				}  
			}
			return $UsuarioId;
		}else{
			
			echo "Error en la consulta de Id de Usuario";
		}
	}else{
		
		echo "<h3>Error conexión con la base de datos</h3>";
	
	}
}


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





function registrar_usuario($datos_usuario, $mensaje){
	if ($mysqli = get_Conexion()){		//Realizacion de conexion a base de datos

		//Insertar datos 
		$sql = "INSERT INTO usuarios (UsuId, UsuNom, UsuPwd, UsuRol, UsuEma) 
				VALUES ('$datos_usuario[id]','$datos_usuario[usuario]','$datos_usuario[contrasena]','Usu','$datos_usuario[email]')";
		if ($mysqli-> query($sql)){
			$mensaje= "Inserción en tabla usuarios realizada con éxito<br>";
		}else{
			$mensaje= "Error insert registro";
		}
	}else{
		$mensaje= "Error conexion registro";
	}
	return $mensaje;
}


?>
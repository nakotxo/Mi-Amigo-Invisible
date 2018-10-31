<?php

/** 
* Función get_Conexion()
* Funcion para funcionamiento en Local
*/
 
/*
function get_Conexion(){
	$servidor= "localhost";
	$usuario= "root";   //"id3972968_joseignaciohidalgo";
	$psw= "";   //"AmigoInvisible";
	$bd= "AmigoInvisible";    //"id3972968_amigoinvisible";

    $conexion= new mysqli($servidor,$usuario,$psw,$bd);
	if ($conexion->connect_error ){
        echo "error conexion";
		die("Connection failed: " . $conexion->connect_error);
	}else{
        $conexion->set_charset ("utf8");
        return $conexion;
	}
}
// NOTA: importante sustituir todos los: http://www.bnkysukq.lucusvirtual.es  por : http://www.bnkysukq.lucusvirtual.es 

*/



 //funcionamiento en servidor
function get_Conexion(){
	$servidor= "localhost";
	$usuario=  "hmpnxgvg_JoseIgnacio"; //"root";   //"id3972968_joseignaciohidalgo";
	$psw= "AmigoInvisible";//"";   //"AmigoInvisible";
	$bd= "hmpnxgvg_amigoinvisible";//"AmigoInvisible";    //"id3972968_amigoinvisible";

    $conexion= new mysqli($servidor,$usuario,$psw,$bd);
	if ($conexion->connect_error ){
		echo "error conexion";
		echo $conexion->connect_error;
		die("Connection failed: " . $conexion->connect_error);
	}else{
        $conexion->set_charset ("utf8");
        return $conexion;
	}

}
// NOTA: importante sustituir todos los: http://www.bnkysukq.lucusvirtual.es   por : http://www.bnkysukq.lucusvirtual.es 










function controlador_index(){	
	$datos[]=array();
	$datos['titulo']="Mi Amigo Invisible";
	require_once 'Home.php';
}

/**
* Funcion controlador_login()
*/
function controlador_login(){
	
	$datos[]=array();
	$datos['titulo']="Página de Logeo";
	//$valor="";
	if(isset($_POST['Login'])){
		$usuario = $_POST['usuario'];
		$contrasenaCifrada = md5($_POST['contrasena']);
		$contrasena=($_POST['contrasena']);
		$Pwd=$_POST['contrasena'];
		$clave=encriptar($Pwd);
		if (existe_usuario($usuario)){
			if (comprueba_usuario($usuario, $contrasena, $contrasenaCifrada,$clave)){
				setcookie('login','true',time()+ 3600*24);
				$_SESSION['Usuario']=$usuario;
				$_SESSION['Rol']=get_rol($usuario);
				//echo $_SESSION['Usuario'];
				$direccion= "<script>window.location.href='http://www.bnkysukq.lucusvirtual.es/index.php/adminusuarios'</script>";
				echo $direccion;
				
			}else{
				echo "Contraseña No RECONOCIDA intentelo otra vez";
			}
			
		
		}else{
			
			$valor= "Error en usuario y contraseña";
		
		}
			
	}
	
	require 'login.php';
	
}
/**
* Funcion controlador_Registro()
*/
function controlador_Registro(){
	$valor="";
	$datos['titulo']="Página de Registro";
						//inicio una variable
	$UsuarioId=NuevoUsuario(); //llamo a la funcion encargada de buscar la primera Id libre
	if (isset($_POST['UsuId'])){
		$usuario=$_POST['UsuNom'];
		if(existe_usuario($usuario)){
			$valor="Lo sentimos pero el usuario ya existe.";
		}else{

			//llamar función encriptado
			$pwd=$_POST['UsuPwd'];
			$clave=encriptar($pwd);
			$datos_usuario=array(
				'id'=>$UsuarioId,
				'usuario' => $_POST['UsuNom'], 
				'email' => $_POST['UsuEma'],
				'contrasena' => $clave,
				'rol' => $_POST['UsuRol']);
			
			$valor=registrar_usuario($datos_usuario, $valor);
		}
	}

	require 'RegistroUsuario.php';		//imprimo RegistroUsuario.php

}

function controlador_admin_usuarios(){
	
	$datos[]=array();
	$datos['titulo']="Home Usuario";
	$valor="";
	require 'Homeusuarios.php';
	
}



function Controlador_Sorteo(){
	$datos[]=array();
	$datos['titulo']="Creacion Sorteo";
	require 'Sorteo.php';
}

function Controlador_Mis_Sorteos(){
	$datos[]=array();
	$datos['titulo']="Mis Sorteos";
	require 'Mis_Sorteos.php';
}

function Controlador_Listados(){
	$datos[]=array();
	$datos['titulo']="Listados";
	require 'Listados.php';
}

function Controlador_Mis_Datos(){
	$datos[]=array();
	$datos['titulo']="Mis Datos";
	require 'Mis_Datos.php';
}

function Controlador_Crear_Deseos(){
	$datos[]=array();
	$datos['titulo']="Crear Deseos";
	require 'Registro_Deseos.php';
}






?>
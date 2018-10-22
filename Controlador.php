<?php

function controlador_index(){	
	$datos[]=array();
	$datos['titulo']="Mi Amigo Invisible";
	require_once 'home.php';
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
		if (existe_usuario($usuario)){
			if (comprueba_usuario($usuario, $contrasena, $contrasenaCifrada)){
				setcookie('login','true',time()+ 3600*24);
				$_SESSION['Usuario']=$usuario;
				$_SESSION['Rol']=get_rol($usuario);
				//echo $_SESSION['Usuario'];
				$direccion= "<script>window.location.href='http://localhost/Proyecto/index.php/adminusuarios'</script>";
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
			$datos_usuario=array(
				'id'=>$UsuarioId,
				'usuario' => $_POST['UsuNom'], 
				'email' => $_POST['UsuEma'],
				'contrasena' => md5($_POST['UsuPwd']),
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
	require 'HomeUsuarios.php';
	
}


/**
* Función get_Conexion()
*/
/* ...............................probar si funciona en otro lugar
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

*/

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

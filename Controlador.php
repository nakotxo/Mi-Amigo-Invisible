<?php

if (isset($_GET['idAmod'])){
	updateDeseo();
}



/** 
* Función get_Conexion()
* Funcion para funcionamiento en Local
*/
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
// NOTA: importante sustituir todos los: http://bnkysukq.lucusvirtual.es  por : http://localhost/proyecto 

 //funcionamiento en servidor
//function get_Conexion(){
//	$servidor= "localhost";
//	$usuario=  "hmpnxgvg_JoseIgnacio"; //"root";   //"id3972968_joseignaciohidalgo";
//	$psw= "AmigoInvisible";//"";   //"AmigoInvisible";
//	$bd= "hmpnxgvg_amigoinvisible";//"AmigoInvisible";    //"id3972968_amigoinvisible";
//
//    $conexion= new mysqli($servidor,$usuario,$psw,$bd);
//	if ($conexion->connect_error ){
//		echo "error conexion";
//		echo $conexion->connect_error;
//		die("Connection failed: " . $conexion->connect_error);
//	}else{
//        $conexion->set_charset ("utf8");
//        return $conexion;
//	}
//}
// NOTA: importante sustituir todos los: http://localhost/proyecto   por : http://bnkysukq.lucusvirtual.es


/* Constantes para la ruta en localhost y para el servidor externo */
	/*---------------------LOCALHOST------------------------*/
		define('URLSERVIDOR', 'localhost/proyecto');

	/*--------------------servidor externo------------------*/
		//define('URLSERVIDOR', 'bnkysukq.lucusvirtual.es');
/*-----------------------------------------------------------------*/
//Nota: a cambiar





function controlador_index(){	
	$datos[]=array();
	$datos['titulo']="Mi Amigo Invisible";
	require_once 'Home.php';
}

/**
* Funcion controlador_login()
*/
function controlador_login(){
	$valor='';
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
				$direccion= "<script>window.location.href='http://".URLSERVIDOR."/index.php/Manual_Usuario'</script>";
				echo $direccion;
				
			}else{
				$valor="Contraseña No RECONOCIDA intentelo otra vez";
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
		$pwd=$_POST['UsuPwd'];
		$email=$_POST['UsuEma'];
		$estado=validarDatos($usuario,$pwd,$email);
		if($estado=='false'){
			$valor ="Todos los campos son obligatorios.";
		}else{
			if(existe_usuario($usuario)){
				$valor="Lo sentimos pero el usuario ya existe.";
			}else{
			//llamar función encriptado
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
	}

	require 'RegistroUsuario.php';		//imprimo RegistroUsuario.php

}

function controlador_admin_usuarios(){
	$datos[]=array();
	$datos['titulo']="Home Usuario";
	$valor="";

	if(isset($_POST['Login'])){
		$valor=postLogin();
	}

	require 'HomeUsuarios.php';
}



function Controlador_Sorteo(){
	$datos[]=array();
	$datos['titulo']="Creacion Sorteo";
	$valor='';
	if (isset($_GET['e-mail'])){
		EnvioEmail();
	}

	if(isset($_POST['Login'])){
		$valor=postLogin();
	}

	require 'Sorteo.php';
}

function Controlador_Mis_Sorteos(){
	$valor='';
	$datos[]=array();
	$datos['titulo']="Mis Sorteos";
	if(isset($_POST['avisar'])){
		enviarInfoRegalador();
	}

	if(isset($_POST['Login'])){
		$valor=postLogin();
	}

	require 'Mis_Sorteos.php';
}

function Controlador_Listados(){
	$datos[]=array();
	$datos['titulo']="Listados";
	$valor='';

	if(isset($_POST['Login'])){
		$valor=postLogin();
	}

	require 'Listados.php';
}

function Controlador_Mis_Datos(){
	$valor='';
	$datos[]=array();
	$datos['titulo']="Mis Datos";

	if(isset($_POST['Login'])){
		$valor=postLogin();
	}
	
	if(isset($_POST['Login'])){
		$valor=postLogin();
	}

	require 'Mis_Datos.php';

}

function Controlador_Crear_Deseos(){
	$datos[]=array();
	$datos['titulo']="Crear Deseos";
	$valor='';
	
	if(isset($_POST['Login'])){
		$valor=postLogin();
	}

	require 'Registro_Deseos.php';
}

?>
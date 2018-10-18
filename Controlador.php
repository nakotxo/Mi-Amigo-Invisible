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

function Controlador_Sorteo(){
	$datos[]=array();
	$datos['titulo']="Creacion Sorteo";
	/* si el usuario pulsa el boton de realizar Sorteo */
	if (isset($_POST['Sorteo'])){
   	 	$hijos=$_POST['hijos'];
   	 	$numMax=$hijos-1;
   	 	$NumRandom =0;
   	 	$arraySorteo=[];
       	while ($NumRandom==0){
           	 $NumRandom= rand ( 0 , $numMax);
           	 $primeraVez=true;
       	}
       	while (sizeof($arraySorteo)<$hijos){
        	if (!$primeraVez){
            	/* Creación de un número aleatorio */
            	$NumRandom= rand ( 0 , $numMax);
            	/* Fin Número aleatorio */
           	}
           	$primeraVez=false;
           	$existe=false;
           	for ($i=0;$i<sizeof($arraySorteo);$i++){
               	if ($arraySorteo[$i]==$NumRandom){
                   	$existe=true;
                   	break;
               	}
               	if (sizeof($arraySorteo)==$NumRandom){
                   	if (sizeof($arraySorteo)==($hijos-1)){
                       	$existe=true;
                       	$i=0;
                       	$NumRandom=0;
                       	while ($NumRandom==0){
                          	$NumRandom= rand ( 0 , $numMax);
                          	$primeraVez=true;
                       	}
                       	$arraySorteo=[];
                       	break;
                   	}
                   	$existe=true;
                   	break;
               	}
           	}
           	if (!$existe){
               	$arraySorteo[sizeof($arraySorteo)]=$NumRandom;
           	}
       	}
   	 	print_r($arraySorteo);
   	
		/** TEST atgoritmo 
		 * Test Funcionamiento de atgoritmo
		 * de realizar el sorteo sin repeticiones
		 * simulando una UPDATE con su sentencia
		*/
		
		

   		for ($i=0;$i<$hijos;$i++){
       		$inputAmigo=$_POST['input'.$arraySorteo[$i]];
       		$usuarioSorteo=$_POST['input'.$i];
       		$string="S".$_POST['SorId']."(A".$inputAmigo."-,,,,)";
			
			$SQL= "UPDATE usuarios SET UsuSorId='".$string."' WHERE UsuId=".$usuarioSorteo;
			$valorDeseos=valorDeseos($usuarioSorteo);
			$deseos=$valorDeseos['UsuDesId'];
			
			


			echo "<br>".$SQL;
			echo "<br>".$deseos."<br>";
			if ($deseos==""){
				//echo "Realizar la Update";
				$conexion=get_Conexion();
				if ($mysqli=get_Conexion()){
					if ($mysqli-> query($SQL)){
						//echo "<br>realizado<br><br>";
					}else{
						echo "Se ha producido un error";
					}
				}
			}else{
				echo "no vacio";
			}
   	 	}
		/* --------fin del test -------------------- */
		$MisSorteos=BuscaSorteo($deseos,$usuarioSorteo);
			/**TEST Impresion $MisSorteos */
			print_r ($MisSorteos);
	}
	require 'Sorteo.php';
}




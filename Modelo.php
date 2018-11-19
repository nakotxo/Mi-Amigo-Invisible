<?php
//no funciona el logout linea 18
$x;
/** ISSET
 * Controladores de envio de datos por URL
 */


/**
 * $_POST['logout']
 * salida de usuario
 */
/* si el usuario realiza un logout, cerramos sesion y visualizamos el HOME */
if(isset($_POST['logout'])){
	setcookie('login','',time()-100);
    $_SESSION['Rol']="";
	$_SESSION['Usuario']="";
	header('Location: Home');
	//echo ('<script>window.location.href=http://'.URLSERVIDOR.'/index.php/Home</script>');
}
/* ---- fin $_POST['logout'] ----*/



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

*/



function superSorteo(){
	$hijos=$_POST['hijos']; //recepción de variable de número de participantes
	$numMax=$hijos-1;	//se resta la unidad para contarcon el 0 como los arrays
	$NumRandom =0;
	$stringParticipantes;
	$sorPar="";
	$input='input';

	for ($i=0;$i<$hijos;$i++){
		if ($i==0){
			$stringParticipantes=$_POST[$input.$i];
		}else{
			$stringParticipantes=$stringParticipantes.",".$_POST[$input.$i];
		}
	}

	$sorteoInsert=array(
		'SorId'=>$_POST['SorId'],
		'SorNom'=>$_POST['SorNom'],
		'SorFec'=>$_POST['SorFec'],
		'SorPar'=>$stringParticipantes,
		'SorPre'=>$_POST['SorPre']
	);
	
	$arraySorteo=[];	//inicializacion de array
   	while ($NumRandom==0){
		/* Creación de un número aleatorio */
		$NumRandom= rand ( 0 , $numMax);	//formula de obtención de número entre el maximo y el mínimo
		$primeraVez=true;
		/* Fin Número aleatorio */
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
						/* Creación de un número aleatorio */
						$NumRandom= rand ( 0 , $numMax);
						/* Fin Número aleatorio */
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
	/** TEST 
	 * comprobación de carga correcta de array
	*/
	//print_r($arraySorteo);
	/* --- Fin Test ---*/
	sorteoInsert($sorteoInsert);
	
   	for ($i=0;$i<$hijos;$i++){
	  	$inputAmigo=$_POST['input'.$arraySorteo[$i]];	//variable idAmigo
	  	$usuarioSorteo=$_POST['input'.$i];				//variable idUsuario
		  
		/* Insert para tabla relación PadreUsuSor */
		$idUsu=$usuarioSorteo;
		$idSor=$_POST['SorId'];
		$idAmi=$inputAmigo;
		$idDes1=0;
		$idDes2=0;
		$idDes3=0;
		$idDes4=0;
		$idDes5=0;
		$insertPadreUsuSor='INSERT INTO padreususor (IdSor, IdUsu, IdAmi, IdDes1, IdDes2, IdDes3, IdDes4, IdDes5, IdAdmin) VALUES
		('.$idSor.','.$idUsu.','.$idAmi.','.$idDes1.','.$idDes2.','.$idDes3.','.$idDes4.','.$idDes5.','.$idUsu.')';
		InsertPadreUsuSor($insertPadreUsuSor);
		/*-----------------FIN--------------------*/
		envioEmailSinDeseos($idUsu,$idAmi,$idSor);
	}
  
}


function envioEmailSinDeseos($idUsu,$idAmi,$idSor){
	$datoUsu=UsuValorCualquiera($idUsu); 	//todos los datos del usuario (array)
	$datoAmi=UsuValorCualquiera($idAmi);	// todos los datos del amigo  (array)
	$datoSor=DatosSorteo($idSor);			// todos los datos del Sorteo (array)

	$usuNom=$datoUsu['UsuNom'];
	$usuEmail=$datoUsu['UsuEma'];
	$amiNom=$datoAmi['UsuNom'];
	$sorNom=$datoSor['SorNom'];
	$sorFec=$datoSor['SorFec'];
	$sorPre=$datoSor['SorPre'];

	$to=$usuEmail; //Destinatario/s del correo.
	$subject="Tu amigo Invisible";	//Título del correo electrónico a enviar.
	$message="Hola ".$usuNom." amigo invisible te escribe para decirte que se ha realizado un sorteo
				en el que participas y estos son los datos:\n
				El Sorteo: ".$sorNom."\n
				para el proximo día: ".$sorFec."\n
				con presupuesto de: ".$sorPre."\n\n
				-----TU AMIGO INVISIBLE-----\n
				---------".$amiNom."---------\n
				----------------------------";

	/**
	 * TEST Relleno de datos de prueba
	 */
	//$to='hidalgoj.ignacio@gmail.com'; //Destinatario/s del correo.
	//$subject="Tu amigo Invisible";	//Título del correo electrónico a enviar.
	//$message="tu amigo invisible te escribe";
	/*----------------------fin del test-----------------------------*/

	//mail ($to , $subject , $message);
	echo ("hacemos envio email<br>");
/* 
to
Destinatario/s del correo.

El formato de este string debe cumplir con la » RFC 2822. Algunos ejemplos son:

usuario@example.com
usuario@example.com, otrousuario@example.com
Usuario <usuario@example.com>
Usuario <usuario@example.com>, Otro usuario <otrousuario@example.com>
subject
Título del correo electrónico a enviar.

Precaución
El título debe cumplir con la » RFC 2047.

message
Mensaje a enviar.

Cada línea debería separarse con un CRLF (\r\n). Las líneas no deberían ocupar más de 70 caracteres.

Precaución
(Sólo en Windows) Cuando PHP se comunica directamente con un servidor SMTP, si encuentra un punto al principio de la línea, éste se elimina. Para evitar esto es necesario reemplazar estas apariciones con un doble punto.

<?php
$texto = str_replace("\n.", "\n..", $texto);
?>
additional_headers (opcional)
String a insertar al final de la cabecera del correo.
*/

}
function enviarInfoRegalador(){
	$nomRegalador=strtoupper($_POST['nomRegalador']);
	$emailRegalador=$_POST['emailRegalador'];
	$sorNom=strtoupper($_POST['nomSor']);
	$usuNom=strtoupper($_POST['nomUsu']);
	$sorpre=$_POST['sorPre'];

	for ($i=0;$i<5;$i++){
		$IdDeseo=$_POST['des'.$i];
		$datos=DatosDeseos($IdDeseo);
		$nomDeseos[$i]=$datos['DesNom'];
		$carDeseos[$i]=$datos['DesCar'];
	}

	$to=$emailRegalador; //Destinatario/s del correo.
	$subject="Tu amigo Invisible";	//Título del correo electrónico a enviar.
	$message="Muy buenas $nomRegalador.\n
				Es un placer informarte, que tu amigo invisible $usuNom,\n
				ha modificado su lista de regalos para el sorteo $sorNom, el cual te recuerdo tiene un presupuesto de $sorpre €:\n
				&nbsp&nbsp&nbsp- $nomDeseos[0], $carDeseos[0].\n
				&nbsp&nbsp&nbsp- $nomDeseos[1], $carDeseos[1].\n
				&nbsp&nbsp&nbsp- $nomDeseos[2], $carDeseos[2].\n
				&nbsp&nbsp&nbsp- $nomDeseos[3], $carDeseos[3].\n
				&nbsp&nbsp&nbsp- $nomDeseos[4], $carDeseos[4].\n\n
				Espero te ayude a decidir que regalarle.\n\n
				ANIMO Y BUENA SUERTE!!!!";
	//echo $message;
	//mail ($to , $subject , $message);
	echo ("hacemos envio email<br>");

}

function enviarPassword($datos_usuario){
	$password=desencriptar($datos_usuario['contrasena']);
	$to=$datos_usuario['email']; //Destinatario/s del correo.
	$subject="Tu amigo Invisible";	//Título del correo electrónico a enviar.
	$message="Hola ".$datos_usuario['usuario'].".<br>
			Te escribimos desde MI AMIGO INVISIBLE, para comunicarte que has 
			sido registrado como usuario de esta página. ya puedes acceder a nuestra página, 
			<a href=http://'.URLSERVIDOR.'/index.php/Home>http://".URLSERVIDOR."/index.php/Home</a>
			, con:
			Nombre usuario:".$datos_usuario['usuario']."<br>
			Contraseña:".$password."<br><br>

			Puede modificar sus datos una vez dentro y se identifique en nuestra página.<br>
			<a href=http://".URLSERVIDOR."/index.php/Mis_Datos'>http://".URLSERVIDOR."/index.php/Mis_Datos</a>";
	echo $message;
	//mail ($to , $subject , $message);
}

function InsertPadreUsuSor($insertPadreUsuSor){
	$conexion=get_Conexion();
	if ($mysqli=get_Conexion()){
		if ($mysqli-> query($insertPadreUsuSor)){
		}else{
			echo "Error en la Insert InsertPadresUsuSor.";
		}
	}else{
		echo "Error en conexion BBDD";
	}
}

function sorteoInsert($sorteoInsert){
	$sqlInsert = "INSERT INTO sorteos (SorId, SorNom, SorFec, SorPre)  VALUES ("
		.$sorteoInsert['SorId'].","
		."'".$sorteoInsert['SorNom']."',"
		."'".$sorteoInsert['SorFec']."',"
		."'".$sorteoInsert['SorPre']."')";
	
	$conexion=get_Conexion();
	if ($mysqli=get_Conexion()){
		if ($mysqli-> query($sqlInsert)){
		}else{
			echo "Error en SorteoInsert.";
			echo $sqlInsert;
		}
	}else{
		echo "Error en conexión con la base de datos.";
	}
}



/*------ recepcion de datos de usuario buscando por Id o por Nombre ---- */
function UsuValorCualquiera($UsuId){	//por ID
	$conexion=get_Conexion();
	if ($mysqli=get_Conexion()){
		/* ------------ Inicio busqueda Participantes -------------- */
		$sqlUsuario="SELECT * FROM usuarios WHERE UsuId='".$UsuId."'";
		/**TEST visualización deseos
		 * comprobacion de la carga de los deseos */	
		//echo $sqlDeseos;
		/* OK
		*/
		if ($resultado=$mysqli->query($sqlUsuario)){
			$fila=$resultado->fetch_assoc();
		}else{
			$fila= "No hay resultados";
		}
		/* -----------------------FIN------------------------- */
	}
	
	$UsuValorCualquiera=$fila;
	return $UsuValorCualquiera;
}

function DatosUsuario($UsuNom){	//datos usuario por nombre
	$conexion=get_Conexion();
	if ($mysqli=get_Conexion()){
		/* ------------ Inicio busqueda sorteos -------------- */
		$sql="SELECT *  FROM usuarios WHERE UsuNom='".$UsuNom."'";
		
		if ($resultado=$mysqli->query($sql)){
			$fila=$resultado->fetch_assoc();
			return($fila);
		}
		/* -----------------------FIN------------------------- */
	}

}
/*-----------------FIN BUSQUEDA DATOS USUARIO ----------------------------*/

function existe_usuario($usuario){
	if ($mysqli = get_Conexion()){		//Realizacion de conexion a base de datos
		$registroOK=false;
		$sql="SELECT UsuNom FROM usuarios WHERE UsuNom='$usuario'";		//Select para ejecutar, donde, seleccionará todos los registros de la BD
		if ($resultado=$mysqli->query($sql)){
			while ($fila=$resultado->fetch_assoc()){	//mientras no sea eof(fin de tabla) seguimos al siguiente registro			
				if ( strtoupper($fila['UsuNom'])==strtoupper($usuario)){
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

function comprueba_usuario($usuario, $contrasena, $contrasenaCifrada,$Pwd){
	
	if ($mysqli = get_Conexion()){		//Realizacion de conexion a base de datos
		$registroOK=false;
		$sql="SELECT UsuNom, UsuPwd FROM usuarios WHERE UsuNom='$usuario'";		//Select para ejecutar, donde, seleccionará todos los registros de la BD
		
		
		if ($resultado=$mysqli->query($sql)){
			while ($fila=$resultado->fetch_assoc()){	//mientras no sea eof(fin de tabla) seguimos al siguiente registro			
		
		
				if ((strtoupper($fila['UsuNom'])==strtoupper($usuario))&&(($fila['UsuPwd']==$contrasena)||($fila['UsuPwd']==$contrasenaCifrada)||($fila['UsuPwd']==$Pwd))){
					$registroOK=true; 
				}else{
					$registroOK=false;  
					/** TEST 
					 * Comprobación de datos introducidos
					 * en el logueo
					 */
					 // echo("estoy en comprueba y fila['UsuPwd']vale: ".$fila['UsuPwd']." y Pwd: ".$Pwd);
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
		$sql="select UsuNom,UsuRol,UsuId from usuarios WHERE UsuNom='$usuario'";		//Select para ejecutar, donde, seleccionará todos los registros de la BD
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

function NuevoUsuario(){
	if ($mysqli = get_Conexion()){		//Realizacion de conexion a base de datos
		$sql="SELECT UsuId FROM usuarios";		//Select para ejecutar, donde, seleccionará los Id delos usuario de la BD
		if ($resultado=$mysqli->query($sql)){
			$UsuarioId=0;
			while ($fila=$resultado->fetch_assoc()){	//mientras no sea eof(fin de tabla) seguimos al siguiente registro			
				if ($fila['UsuId']==$UsuarioId){
					$UsuarioId++;	//incremento la variable para obtener el primer Id vacio
				} else{
					break;
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

function NuevoSorteo(){
	if ($mysqli = get_Conexion()){		//Realizacion de conexion a base de datos
		$sql="SELECT SorId FROM sorteos";		//Select para ejecutar, donde, seleccionará los Id de los SORTEOS de la BD
		if ($resultado=$mysqli->query($sql)){
			$SorteoId=0;
			while ($fila=$resultado->fetch_assoc()){	//mientras no sea eof(fin de tabla) seguimos al siguiente registro			
				if ($fila['SorId']==$SorteoId){
					$SorteoId++;	//incremento la variable para obtener el primer Id vacio
				} else{
					break;
				}
			}
			return $SorteoId;
		}else{
			echo "Error en la consulta de Id de Sorteo";
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


			enviarPassword($datos_usuario);

			$mensaje= "Inserción en tabla usuarios realizada con éxito<br>
						Se ha enviado un e-mail a ".$datos_usuario['usuario']." con los datos, revise el correo SPAN<br>";
		}else{
			$mensaje= "Error insert registro";
		}
	}else{
		$mensaje= "Error conexion registro";
	}
	return $mensaje;
}

function Listado(){
	$conexion=get_Conexion();
	
		if ($mysqli=get_Conexion()){
			$sqlUsuarios="SELECT * FROM usuarios";
			if ($resultado=$mysqli->query($sqlUsuarios)){
				$datosUsuarios['titulo']="Listado Usuarios";
				while ($fila=$resultado->fetch_assoc()){
					$datosUsuarios[]=$fila;
				}
				ListarUsuarios($datosUsuarios);
			//print_r($datos);
			}

			$sqlDeseos="SELECT * FROM deseos";
			if ($resultado=$mysqli->query($sqlDeseos)){
				$datosDeseos['titulo']="Listado DESEOS";
				while ($fila=$resultado->fetch_assoc()){
					$datosDeseos[]=$fila;
				}
				ListarDeseos($datosDeseos);
			//print_r($datosDeseos);
			}

			$sqlSorteos="SELECT * FROM sorteos";
			if ($resultado=$mysqli->query($sqlSorteos)){
				$datosSorteos['titulo']="Listado SORTEOS";
				while ($fila=$resultado->fetch_assoc()){
					$datosSorteos[]=$fila;
				}
				ListarSorteos($datosSorteos);
			//print_r($datosSorteos);
			}
		
	}
}

function ListarUsuarios($datosUsuarios){
	echo "<h1>".$datosUsuarios['titulo']."</h1>";
	?>	
		<table align ='center'>
			<tr>
				<td COLSPAN='5'>Usuarios Baneados</td>
			</tr>
			<tr>
				<td>ID</td>
				<td>Nombre</td>
				<td>Pasword</td>
				<td>Rol</td>
				<td>E-mail</td>
			</tr>
			
				<?php
					for ($i=0;$i<count($datosUsuarios)-1;$i++){
						echo "<tr>";
						echo "<td>".$datosUsuarios[$i]['UsuId']."</td>";
						echo "<td>".$datosUsuarios[$i]['UsuNom']."</td>";
						$pwd=$datosUsuarios[$i]['UsuPwd'];
						$pwd=desencriptar($pwd);
						echo "<td>".$pwd."</td>";
						echo "<td>".$datosUsuarios[$i]['UsuRol']."</td>";
						echo "<td>".$datosUsuarios[$i]['UsuEma']."</td>";
						echo "</tr>";
					} 
				?>
		</table>
	<?php
}

function SoloUsuarios(){
	$conexion=get_Conexion();
		if ($mysqli=get_Conexion()){
			$sqlUsuarios="SELECT * FROM usuarios";
			if ($resultado=$mysqli->query($sqlUsuarios)){
				$datosUsuarios['titulo']="Listado Usuarios";
				while ($fila=$resultado->fetch_assoc()){
					$datosUsuarios[]=$fila;
				}
				ListarUsuariosEnSelect($datosUsuarios);
			//print_r($datos);
			}
		}
}

function ListarUsuariosEnSelect($datosUsuarios){
	?>
	<!--Lista de usuarios para participar-->
	<div id='divTotal'>
	<div id='divUlUsu'>
	<ul id="LstUsu">
		<?php 
		for ($i=0;$i<count($datosUsuarios)-1;$i++){
			echo "<li value= '".$datosUsuarios[$i]['UsuId']."'title='".$datosUsuarios[$i]['UsuNom']."'>".$datosUsuarios[$i]['UsuId']." - ".$datosUsuarios[$i]['UsuNom']."</li>";
		} ?>
	</ul>
	</div>
	<!--Lista definitiva de usuarios a participar-->
	<div id='divUlUsuFin'>
		<ul id="LstUsuFin" name="ListaUsuariosFinal">
	</ul>
	</div>
	</div>
	<?php
}

function ListarDeseos($datosDeseos){
	echo "<h1>".$datosDeseos['titulo']."</h1>";
	?>	
		<table border-style='solid 1px' align='center'>
			<tr>
				<td COLSPAN='3'>Listado de deseos</td>
			</tr>
			<tr>
				<td>ID</td>
				<td>Deseo</td>
				<td>Caracteristicas</td>
			</tr>
				
				<?php
					for ($i=0;$i<count($datosDeseos)-1;$i++){
						echo "<tr>";
						echo "<td>".$datosDeseos[$i]['DesId']."</td>";
						echo "<td>".$datosDeseos[$i]['DesNom']."</td>";
						echo "<td>".$datosDeseos[$i]['DesCar']."</td>";
						echo "</tr>";
					} 
				?>
		</table>
	<?php
}

function ListarSorteos($datosSorteos){
	echo "<h1>".$datosSorteos['titulo']."</h1>";
	?>	
		<table border-style='solid 1px' align='center'>
			<tr>
				<td COLSPAN='4'>Listado de Sorteos</td>
			</tr>
			<tr>
				<td>ID</td>
				<td>Nombre Sorteo</td>
				<td>Presupuesto</td>
				<td>Fecha sorteo</td>
			</tr>
				<?php
					for ($i=0;$i<count($datosSorteos)-1;$i++){
						echo "<tr>";
						echo "<td>".$datosSorteos[$i]['SorId']."</td>";
						echo "<td>".$datosSorteos[$i]['SorNom']."</td>";
						echo "<td>".$datosSorteos[$i]['SorPre']." €</td>";
						echo "<td>".$datosSorteos[$i]['SorFec']."</td>";
						echo "</tr>";
					} 
				?>
		</table>
	<?php
}

function SoloSorteo(){
	$conexion=get_Conexion();
		if ($mysqli=get_Conexion()){
			$sqlSorteos="SELECT * FROM sorteos";
			if ($resultado=$mysqli->query($sqlSorteos)){
				$datosSorteos['titulo']="Listado SORTEOS";
				while ($fila=$resultado->fetch_assoc()){
					$datosSorteos[]=$fila;
				}
				ListarSorteosEnSelect($datosSorteos);
			}
		}
}

function ListarSorteosEnSelect($datosSorteos){
	?>
	<select id="LstSor" name="Sorteo">
		<?php 
		for ($i=0;$i<count($datosSorteos)-1;$i++){
			if ($datosSorteos[$i]['SorPar']==""){
				echo "<option value='".$i."'>".$datosSorteos[$i]['SorId']." - ".$datosSorteos[$i]['SorNom']."</option>";
			}
		} ?>
	</select>
	<?php
}


function MisSorteos(){
	//MisDatos --> Creacion de array con todos los datos del Usuario
	$UsuNom=$_SESSION['Usuario'];
	$MisDatos=DatosUsuario($UsuNom);

	//Asignacion de datos de Usuario a Variable	
	$UsuId=$MisDatos['UsuId'];

	//TEST carga de datos en array $MisDatos ok
	//print_r ($MisDatos);
	//echo "<br>".$UsuId.	$UsuRol.$UsuNom.$UsuPwd.$UsuEma.$UsuSorId.$UsuDesId.$UsuAdminSorId;

	//MisSorteos --> Creacion de array con todos los sorteos del Usuario
	$MisSorteos=BuscaSorteo($UsuId);
	
	//función tratamiento de datos adquiridos
	if ($MisSorteos){
		TratarDatosSorteos($MisDatos,$MisSorteos);
	}else{
		echo "<h3>Todavia no pertenece a ningún Sorteo.</h3>";
	}
}

/* función encargada de buscar los sorteos e introducir todos sus datos en un array
para acceder rapidamente a la información.
N-º de sorteos, cuales son, amigos invisibles, los deseos de su amigo invisible y los deseos para ese sorteo*/

function BuscaSorteo($usuId){
	$conexion=get_Conexion();
	if ($mysqli=get_Conexion()){
		$LosSorteos=array(); 	// declaracion de array
		$sqlString='SELECT * FROM padreususor WHERE IdUsu='.$usuId;
		$LosSorteos[0]="No tiene sorteos asociados";
		$i=0;
		if($resultado=$mysqli->query($sqlString)){
			while ($fila=$resultado->fetch_assoc()){
				$LosSorteos[$i]=$fila['IdSor'];
				$i++;
			}
			
		}else{
		echo 'error en conexion';
		}
	}

		return $LosSorteos; //devuelve el array o de variable
	
}

function TratarDatosSorteos($MisDatos,$MisSorteos){
	
	/**TEST
	 * visualización de array,
	 * para posterior tratamiento
	 */
	//print_r ($MisSorteos);
	/*--- fin TEST */
	$miId=$MisDatos['UsuId'];
	$usuNom=$MisDatos['UsuNom'];
	$control=$MisSorteos[0];
	if($control=="No tiene sorteos asociados"){
		echo "<h1><p>".$control."</p></h1>";
	}else{
	
		$NumSor=count($MisSorteos); //numero de sorteos

		?>
		<table align='center'>
			<tr>
				<td>SORTEO</td>
				<td>FECHA SORTEO</td>
				<td>TU AMIGO INVISIBLE</td>
				<td>SUS DESEOS</td>
				<td>TUS DESEOS</td>
				<td>PARTICIPANTES</td>
			</tr>
			<?php 
			for ($i=0;$i<$NumSor;$i++){
				//optenemos los nombres a traves de los id's en las siguientes funciones
				$datSor=DatosSorteo($MisSorteos[$i]);
				$sorId=$datSor['SorId'];	//id del sorteo
				$sorNom=$datSor['SorNom'];	//nombre de Sorteo
				$sorFec=$datSor['SorFec'];	//Fecha del Sorteo
				$sorPre=$datSor['SorPre'];	//Presupuesto Sorteo

				// busqueda de todos los deseos del amigo invisible
				//primero buscamos el amigo invisible
				$amigo=buscaAmigo($MisSorteos[$i],$MisDatos['UsuId']);
				$losDeseos=buscaDeseos($MisSorteos[$i],$amigo);

				$datAmi=UsuValorCualquiera($amigo);
				$amiNom=$datAmi['UsuNom'];	//nombre del amigo Invisible
				$amiEma=$datAmi['UsuEma'];	//email del Amigo invisible

				//busqueda de participantes del sorteo
				$datosParticipantes=DatosParticipante($MisSorteos[$i]);
				
				

				// busqueda de todos mis deseos del para este sorteo
				//primero buscamos el amigo invisible
				$misDeseos=buscaDeseos($MisSorteos[$i],$MisDatos['UsuId']);
				
				// busqueda del e-mail de mi regalador
				$idRegalador=buscaRegalador($sorId,$miId); // 1-Buscamos su Id
				$datosRegalador=UsuValorCualquiera($idRegalador);
				$emailRegalador=$datosRegalador['UsuEma'];
				$nomRegalador=$datosRegalador['UsuNom'];

				/** TEST 
				 * Comprobacion de datos obtenidos
				 * por las diversas funciones
				 * Se imprimen los datos ID
				 */
				//print_r ($datosParticipantes);
				//echo $amigo;
				//print_r ($losDeseos);
				//print_r ($misDeseos);
				//echo $sorId.$miId;
				//echo $idRegalador;
				//echo ($nomRegalador." - ".$emailRegalador. "<br>");
				/* ---- fin de Test ---- */


				for($j=0;$j<5;$j++){	
					$datDeseos=DatosDeseos($losDeseos[$j]);
					$amiDesNom[$j]=$datDeseos['DesNom'];//array con lo 5 deseos del amigo
					$amiDesCar[$j]=$datDeseos['DesCar'];//array con lo 5 caracteristicas del amigo
				}

				for($j=0;$j<5;$j++){
					$datMisDeseos=DatosDeseos($misDeseos[$j]);
					$misDesId[$j]=$datMisDeseos['DesId'];
					$misDesNom[$j]=$datMisDeseos['DesNom']; //array con mis 5 deseos
					$misDesCar[$j]=$datMisDeseos['DesCar']; //array con mis 5 caracteristicas deseos
				}

				for($j=0;$j<count($datosParticipantes);$j++){
					$datParticipantes=UsuValorCualquiera($datosParticipantes[$j]);
					$partiNom[$j]=$datParticipantes['UsuNom']; //nombre de los participantes
					$partiEma[$j]=$datParticipantes['UsuEma'];	// email de los participantes
				}
				/** TEST 
				 * Comprobacion de datos obtenidos
				 * por las diversas funciones
				 * Se imprimen los datos en texto
				 */
				//echo ($sorNom);
				//echo ($sorFec);
				//echo ($sorPre);
				//echo ($amiNom);
				//echo ($amiEma);
				//print_r($amiDesNom);
				//print_r($amiDesCar);
				//print_r($misDesNom);
				//print_r($misDesCar);
				//print_r($partiNom);
				//print_r($partiEma);
				/* --- fin Test --- */
				
				?>
			<tr>
			<td><?php echo $sorNom.'<br><br>Presupuesto:'.$sorPre.'€'?></td>
				<td><?php echo $sorFec?></td>
				<td><?php echo $amiNom.'<br><br>'.$amiEma?></td>
				<td><?php //listados de los deseos de mi amigo invisible
						for($j=0;$j<5;$j++){
							echo $amiDesNom[$j].'<br>';
							echo $amiDesCar[$j].'<br><br>';
						}
					?></td>
				<td><?php //listado de mis deseos
						for($j=0;$j<5;$j++){
							if(isset($_GET['DesPos'.$j.$i])){
								$listaDeseos=ListarDeseosEnLst();	
								$DesNomAmod=$_GET['Des'.$j];
								$DatAmod=idDeseo($DesNomAmod);
								$idAmod=$DatAmod;
								?>
								<form method='GET' action='?'>
									<select id="LstDes" name="deseos[]">
										<?php 
										for ($p=0;$p<count($listaDeseos)-1;$p++){
											echo "<option name='ModificarElId' value='".$listaDeseos[$p]['DesId']."'>".$listaDeseos[$p]['DesId']." - ".$listaDeseos[$p]['DesNom']."</option>";
										} ?>
									</select>
									<input type='hidden' name='idAmod' title='idDesViejo' value=<?=$DatAmod?>>
									<input type='hidden' name='idSor' title='miSor' value=<?=$sorId?>>
									<input type='hidden' name='miId' title='miId' value=<?=$miId?>>
									<?php $numeroDeseoAmod=$j+1;?> 
									<input type='hidden' name='idDesSorAmod' title='idDeseSorAmod' value=<?=$numeroDeseoAmod?>>
									<input type='image'src='http://localhost/proyecto/multimedia/save1.png'>
								</form>
							
								<?php
							}else{
							?>
								<form method='GET' action='?'>
									<?php $valor=utf8_encode($misDesNom[$j]); ?>
									<label><?php echo $valor ?></label>
									<a href='Mis_Sorteos?DesPos<?=$j.$i?>="<?=utf8_encode($misDesNom[$j])?>"&Des<?=$j?>="<?=utf8_encode($misDesNom[$j])?>"'><img src='http://localhost/proyecto/multimedia/editar2.png'/></a>
								</form>
								
								<?php	
							}
							//echo $misDesCar[$j].'<br><br>';
							
						}
						?>
						<!-- Preparación de botón para enviar por el POST todos los 
						datos con los deseos para enviar EMAIL al REGALADOR ----------------->
						<form action='?'method='POST'>
							<input type='hidden' name='nomRegalador' value='<?=$nomRegalador?>'>
							<input type='hidden' name='emailRegalador' value='<?=$emailRegalador?>'>
							<input type='hidden' name='nomSor' value='<?=$sorNom?>'>
							<input type='hidden' name='nomUsu' value='<?=$usuNom?>'>
							<input type='hidden' name='sorPre' value='<?=$sorPre?>'>
							<?php 
							for ($pi=0;$pi<5;$pi++){
								echo '<input type="hidden" name="des'.$pi.'" value="'.$misDeseos[$pi].'">';
							}
							?>
							<input type='submit' name='avisar' value='Enviar mis deseos a mi amigo'>
						</form>
						<!-----------------------------------fin------------------------------------>
				</td>
				<td><?php for($j=0;$j<count($partiNom);$j++){
							echo $partiNom[$j].'<br>'; //nombre de los participantes
							echo $partiEma[$j].'<br><br>';	// email de los participantes
						}
				?></td>
			</tr>
			<?php
			}?>
		</table>
		
		<?php
	}
	
}


function idDeseo($desNom){

	
	if ($conexion=get_Conexion()){
		
		/* ------------ Inicio busqueda deseo -------------- */
		$sql="SELECT *  FROM deseos WHERE DesNom=$desNom";
			/** TEST
			 * visualización de variable,
			 * para comprobación sintaxys
			 */
			//echo $sql;
			/*--- Fin TEST ---*/
		if ($resultado=$conexion->query($sql)){
			$fila=$resultado->fetch_assoc();
			$idDes=$fila['DesId'];
			return($idDes);
		}
		/* -----------------------FIN------------------------- */
	}
}

function ListarDeseosEnLst(){
	$conexion=get_Conexion();
	if ($mysqli=get_Conexion()){
		$sqlDeseos="SELECT * FROM deseos";
		if ($resultado=$mysqli->query($sqlDeseos)){
			while ($fila=$resultado->fetch_assoc()){
				$datosDeseos[]=$fila;
			}
		}else{
		 echo "No hay datos de deseos";
		}
		return($datosDeseos);
	/*	?>
		<select id="LstDes" name="deseos">
			<?php 
			for ($i=0;$i<count($datosDeseos)-1;$i++){
				echo "<option value='".$i."'>".$datosDeseos[$i]['DesId']." - ".$datosDeseos[$i]['DesNom']."</option>";
			} ?>
		</select>
		<?php*/
	}else{
		echo "Error en conexion con la base de datos";
	}
}


//función para sacar toda la información del sorteo 
function DatosSorteo($IdSorteo){
	$conexion=get_Conexion();
	if ($mysqli=get_Conexion()){
		/* ------------ Inicio busqueda sorteos -------------- */
		$sqlSorteo="SELECT *  FROM sorteos WHERE SorId='".$IdSorteo."'";
			/** TEST
			 * visualización de variable,
			 * para comprobación sintaxys
			 */
			//echo $sqlSorteo;
			/*--- Fin TEST ---*/
		if ($resultado=$mysqli->query($sqlSorteo)){
			$fila=$resultado->fetch_assoc();
			return($fila);
		}
		/* -----------------------FIN------------------------- */
	}
}

//función para sacar toda la información del Participante
function DatosParticipante($sorId){
	$conexion=get_Conexion();
	if ($mysqli=get_Conexion()){
		$losParticipantes=array(); 	// declaracion de array
		$sqlString='SELECT * FROM padreususor WHERE IdSor='.$sorId;
		$losParticipantes[0]="";
		$i=0;
		if($resultado=$mysqli->query($sqlString)){
			while ($fila=$resultado->fetch_assoc()){
				$losParticipantes[$i]=$fila['IdUsu'];
				$i++;
			}
			
		}else{
		echo 'error en sql';
		}
	}
		return $losParticipantes; //devuelve el array o de variable
	
}

function buscaAmigo($sorId,$usuId){
	$conexion=get_Conexion();
	if ($mysqli=get_Conexion()){
		/* ------------ Inicio busqueda Amigo -------------- */
		$sqlSorteo='SELECT *  FROM padreususor WHERE IdSor='.$sorId.' AND IdUsu='.$usuId;
			/** TEST
			 * visualización de variable,
			 * para comprobación sintaxys
			 */
			//echo $sqlSorteo;
			/*--- Fin TEST ---*/
		if ($resultado=$mysqli->query($sqlSorteo)){
			$fila=$resultado->fetch_assoc();
			$amigo=$fila['IdAmi'];
			return($amigo);
		}
		/* -----------------------FIN------------------------- */
	}
}
function buscaRegalador($sorId,$usuId){ //es igual que el buscaAmigo, lo que pasa es que esta vez busca el regalador no el amigo, a quien le he tocado
	$conexion=get_Conexion();
	if ($mysqli=get_Conexion()){
		/* ------------ Inicio busqueda regalador -------------- */
		$sqlSorteo="SELECT *  FROM padreususor WHERE IdSor=$sorId AND IdAmi=$usuId";
			/** TEST
			 * visualización de variable,
			 * para comprobación sintaxys
			 */
			//echo $sqlSorteo;
			/*--- Fin TEST ---*/
		if ($resultado=$mysqli->query($sqlSorteo)){
			$fila=$resultado->fetch_assoc();
			$amigo=$fila['IdUsu'];
			return($amigo);
		}
		/* -----------------------FIN------------------------- */
	}
}

//función para sacar toda la información del Participante
function DatosDeseos($IdDeseos){	//busca deseo por id
	$conexion=get_Conexion();
	if ($mysqli=get_Conexion()){
		/* ------------ Inicio busqueda deseos -------------- */
		$sqlDeseos="SELECT *  FROM deseos WHERE DesId='".$IdDeseos."'";
		/**TEST visualización deseos
		 * comprobacion de la carga de los deseos 	
		 * echo $sqlDeseos;
		 * OK
		*/
		if ($resultado=$mysqli->query($sqlDeseos)){
			$fila=$resultado->fetch_assoc();
			return($fila);
		}
		/* -----------------------FIN------------------------- */
	}
}
function buscaDeseos($sorId,$usuId){
	$conexion=get_Conexion();
	if ($mysqli=get_Conexion()){
		$losDeseos=array(); 	// declaracion de array
		$sqlString='SELECT * FROM padreususor WHERE IdSor='.$sorId.' AND IdUsu='.$usuId;
		$losDeseos[0]="";
		$i=0;
		if($resultado=$mysqli->query($sqlString)){
			$fila=$resultado->fetch_assoc();
			for ($i=1;$i<=5;$i++){
				$losDeseos[$i-1]=$fila['IdDes'.$i];
			}
			
		}else{
			echo 'No Existentes';
		}
	}
		return $losDeseos; //devuelve el array o de variable
}

function updateDeseo(){
	/**
	 * TEST
	 * Comprobación de encontrarnos dentro de la función
	 */
	//echo "estoy dentro <br>";
	/* --------Fin TEST --------------*/
	$conexion = get_Conexion();
	/**
	 *  vamos a realizar la update en padreususor 
	 * para ello necesitamos:
	 * id del usuario	$idUsu
	 * id del sorteo	$idSor
	 * id de la posicion del deseo a modificar	$idDes
	 * id del deseo viejo	$idVieja
	 * id del deseo nuevo	$idNueva
	 * */

	/*--------variables del POST -------------*/
	$idUsu= $_GET['miId'];	// variable con mi id
	$idSor = $_GET['idSor'];	//variable con id del sorteo al que nos refirimos
	$idDes= $_GET['idDesSorAmod']; // variable con la posicion del deso a cambiar
	$idVieja = $_GET['idAmod'];//variable con id a modificar (vieja)
	$idNueva = $_GET['deseos'][0];//array con id para modificar en posición[0](nueva)
	/**
	 * TEST imprimir variables de modificación 
	*/
	//echo "(".$idVieja.", ".$idNueva.")";
	//fin del test


	if ($idNueva==$idVieja){
		$mensaje="No hay cambios";
		echo $mensaje;
		return $mensaje;
	}else{
		if ($conexion = get_Conexion()){
			$sql="UPDATE padreususor SET IdDes".$idDes."=$idNueva WHERE IdSor=$idSor And IdUsu=$idUsu";	//update
			/**
			 * TEST
			 * Comprobacion de la sql para ejecutar
			 */
			//echo $sql;	
			/* --------fin TEST--------*/
			if ($resultado=$conexion->query($sql)){
				}else{
					echo "Error en la Udate del Deseo";
				}
		}
	}

}

function Mis_datos(){
	$MisDatos=DatosUsuario($_SESSION['Usuario']);
	$desClave=desencriptar($MisDatos['UsuPwd']);
	?>
	<div id='divMisDatos'>
		<table id='tablaMisDatos'>
			<tr>
				<th colspan=3>Mis Datos</th>
			</tr>
			<tr>
				<?php
				if (isset($_POST['Nombre'])){
					//hacer update
					updateEmail($_POST['Nombre'],$_POST['caso']);
					$MisDatos=DatosUsuario($_SESSION['Usuario']);
				}
				if (isset($_GET['Nombre'])){?>
					<td class='tdDescrip'>Nombre:</td>
					<form method='POST' action='?'>
						<td class='tdMisDatos'><input class='inpDato'type='text' name='Nombre'value='<?=$MisDatos['UsuNom']?>'></td>
						<input type='hidden' name='caso'value='Nombre'>
						<td><input type='image'src='http://localhost/proyecto/multimedia/save1.png'></td>
					</form>
				<?php
				}else{
				?>
					<td class='tdDescrip'>Nombre:</td>
					<td class='tdMisDatos'><?=$MisDatos['UsuNom']?></td>
					<td><a href='Mis_Datos?Nombre="<?=utf8_encode($MisDatos['UsuNom'])?>"'><img src='http://localhost/proyecto/multimedia/editar2.png'/></a></td>
				<?php
				}
				?>
			</tr>
			<tr>
				<?php
				if (isset($_POST['Pwd'])){
					//hacer update
					updateEmail($_POST['Pwd'],$_POST['caso']);
					$MisDatos=DatosUsuario($_SESSION['Usuario']);
					$desClave=desencriptar($MisDatos['UsuPwd']);
				}
				if (isset($_GET['Pwd'])){?>
					<td class='tdDescrip'>Contraseña:</td>
					<form method='POST' action='?'>
						<td class='tdMisDatos'><input class='inpDato'type='text' name='Pwd'value='<?=$desClave?>'></td>
						<input type='hidden' name='caso'value='Pwd'>
						<td><input type='image'src='http://localhost/proyecto/multimedia/save1.png'></td>
					</form>
				<?php 
				}else{
				?>
					<td class='tdDescrip'>Contraseña:</td>
					<td class='tdMisDatos'><?=$desClave?></td>
					<td><a href='Mis_Datos?Pwd="<?=utf8_encode($MisDatos['UsuPwd'])?>"'><img src='http://localhost/proyecto/multimedia/editar2.png'/></a></td>
				<?php
				}
				?>
			</tr>
			<tr>
				<?php
				if (isset($_POST['Email'])){
					//hacer update
					updateEmail($_POST['Email'],$_POST['caso']);
					$MisDatos=DatosUsuario($_SESSION['Usuario']);
				}
				if (isset($_GET['Email'])){?>
					<td class='tdDescrip'>E-mail:</td>
					<form method='POST' action='?'>
						<td class='tdMisDatos'><input class='inpDato'type='text' name='Email'value='<?=$MisDatos['UsuEma']?>'></td>
						<input type='hidden' name='caso'value='Email'>
						<td><input type='image'src='http://localhost/proyecto/multimedia/save1.png'></td>
					</form>
				<?php 
				}else{
				?>
					<td class='tdDescrip'>E-mail:</td>
					<td class='tdMisDatos'><?=$MisDatos['UsuEma']?></td>
					<td><a href='Mis_Datos?Email="<?=utf8_encode($MisDatos['UsuEma'])?>"'><img src='http://localhost/proyecto/multimedia/editar2.png'/></a></td>
				<?php
				}

				?>
			</tr>		
		</table>
	</div>
	<?php
}

function updateEmail($dato,$caso){
	$usuario=$_SESSION['Usuario'];
	/**TEST
	 * Comprobación de los valores optenidos en la función
	 */
	//echo $caso;
	/*--- fin Test ---*/
	if ($conexion = get_Conexion()){		//Realizacion de conexion a base de datos
		switch ($caso) {
			case 'Email':
				$sql="UPDATE usuarios SET UsuEma ='$dato' WHERE UsuNom='$usuario'";	//update
				if ($resultado=$conexion->query($sql)){
					/** TEST 
					 * Comprobacion de realizacion de test
					*/
					//echo "UPDATE Realizada";
					/*-- fin del Test --*/
				}else{
					echo "Error en la UPDATE";
				}
				break;
			case 'Pwd':
				$clave=encriptar($dato);
				$sql="UPDATE usuarios SET UsuPwd ='$clave' WHERE UsuNom='$usuario'";	//update
				if ($resultado=$conexion->query($sql)){
					/** TEST 
					 * Comprobacion de realizacion de test
					*/
					//echo "UPDATE Realizada";
					/*-- fin del Test --*/
				}else{
					echo "Error en la UPDATE";
				}
				break;
			case 'Nombre':
				$sql="UPDATE usuarios SET UsuNom ='$dato' WHERE UsuNom='$usuario'";	//update
				$_SESSION['Usuario']=$dato;
				if ($resultado=$conexion->query($sql)){
					/** TEST 
					 * Comprobacion de realizacion de test
					*/
					//echo "UPDATE Realizada";
					/*-- fin del Test --*/
				}else{
					echo "Error en la UPDATE";
				}
				break;
		}
	}else{
		echo "<h3>Error conexión con la base de datos</h3>";
	}
}

function formularioDeseos(){
	$id=calculoIdDeseo();//solicitamos el último id utilizado
	$valor='';
	if (isset($_GET['registrarDeseos'])){
		$dato=registrarDeseo($_GET['DesId'],$_GET['DesNom'],$_GET['DesCar']);
		$id=calculoIdDeseo();
		?>
		<form method="GET" action="?">
	        <div id="divForDes">
	            <input id="deseoId" type="hidden" name="DesId" value=" <?php echo $id ?>">    
	            <label>Deseo</label><input id="deseo" type="text" name="DesNom" placeholder="Nombre Deseo">
				<label>Caracteristicas</label><input id="caracteristicas" type="text" name="DesCar" placeholder="Talla, color, enlace web...">
				<div id="log"><input id="login" type="submit" name="registrarDeseos" value="Registrar" ></div>
	        </div>
	    </form>
		<h1><?php echo $dato?></h1>
		<?php
	}else{
		?>
		<form method="GET" action="?">
	        <div id="divForDes">
	            <input id="deseoId" type="hidden" name="DesId" value=" <?php echo $id ?>">    
	            <label>Deseo</label><input id="deseo" type="text" name="DesNom" placeholder="Nombre Deseo">
				<label>Caracteristicas</label><input id="caracteristicas" type="text" name="DesCar" placeholder="Talla, color, enlace web...">
				<div id="log"><input id="login" type="submit" name="registrarDeseos" value="Registrar" ></div>
	        </div>
	    </form>
		<h1><?php echo "<p>".$valor."</p>"?></h1>
		<?php
	}
}

function calculoIdDeseo(){
	if ($mysqli = get_Conexion()){		//Realizacion de conexion a base de datos
		$sql="SELECT DesId FROM deseos";		//Select para ejecutar, donde, seleccionará los Id delos usuario de la BD
		if ($resultado=$mysqli->query($sql)){
			$deseoId=0;
			while ($fila=$resultado->fetch_assoc()){	//mientras no sea eof(fin de tabla) seguimos al siguiente registro			
				if ($fila['DesId']==$deseoId){
					$deseoId++;	//incremento la variable para obtener el primer Id vacio
				} else{
					break;
				}
			}
			return $deseoId;
		}else{
			echo "Error en la consulta de Id de Usuario";
		}
	}else{
		echo "<h3>Error conexión con la base de datos</h3>";
	}
}

function registrarDeseo($desId,$desNom,$desCar){
	if ($mysqli = get_Conexion()){		//Realizacion de conexion a base de datos
		//Insertar datos 
		$sql = "INSERT INTO deseos (DesId, DesNom, DesCar) 
				VALUES ($desId,'$desNom','$desCar')";
		if ($mysqli-> query($sql)){
			$mensaje= "Inserción del DESEO realizada con éxito";
		}else{
			$mensaje= "Error insert registro";
		}
	}else{
		$mensaje= "Error conexion registro";
	}
	return ($mensaje);
}


Function validarDatos($usuario,$pasword,$email){
	if (($usuario=='')||($pasword=='')||($email=='')){
		$valor='false';
		return $valor;
	}
}

function crearPassword(){
	// del 0 al 10 Números 11-36 minusculas, del 37-62 mayusculas
	$strPassword="0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	
	// password consta de 7 caracteres, NXxxxxN, empieza por un número sigue una 
	//mayuscula luego cuatro minusculas y termina en un número
	
	// 1º Número
	$NumRandom= rand ( 0 , 10);
	$password=substr($strPassword,$NumRandom,1);

	// 2º mayúsculas
	$NumRandom= rand (37 , 62);
	$password=$password.substr($strPassword,$NumRandom,1);
	
	// 3º cuatro minúsculas
	for ($i=0;$i<4;$i++){
		$NumRandom= rand ( 11 , 36);
		$password=$password.substr($strPassword,$NumRandom,1);
	}

	// 4º Número
	$NumRandom= rand ( 0 , 10);
	$password=$password.substr($strPassword,$NumRandom,1);

	return($password);
}


function formularioLogin(){
	?>
	<form method="POST" action="?">
        <div id="DivLogin">
            <label>Usuario</label><input id="usuario" type="text" name="usuario" placeholder="Nombre">
            <label>Contraseña</label><input id="contrasena" type="password" name="contrasena" placeholder="Contraseña">
            <div id="log"><input id="login" type="submit" name="Login" value="Login" ></div>
        </div>
	</form>
	<?php
}










Function encriptar($clave){
	$METHOD='AES-256-CBC';
	$SECRET_KEY='$Ignacio@2018';
	$SECRET_IV='101712';
	
	$output=FALSE;
	$key=hash('sha256', $SECRET_KEY);
	$iv=substr(hash('sha256', $SECRET_IV), 0, 16);
	$output=openssl_encrypt($clave, $METHOD, $key, 0, $iv);
	$output=base64_encode($output);
	/**TEST 
	 * Comprobacion de entrada y salida 
	*/
	//echo($output)."<br>";
	//echo "encriptar:".$clave;
	/*--- Fin Test ---*/
	return $output;

	
}

function desencriptar($clave){
	$METHOD='AES-256-CBC';
	$SECRET_KEY='$Ignacio@2018';
	$SECRET_IV='101712';

	$key=hash('sha256', $SECRET_KEY);
	$iv=substr(hash('sha256', $SECRET_IV), 0, 16);
	$output=openssl_decrypt(base64_decode($clave), $METHOD, $key, 0, $iv);
	/**
	 * TEST
	 * Comprobación variables de recibidas y para enviar
	 */
	//echo "desencriptar:".$clave.", ".$output;	
	/*--- fin Test ---*/
	return $output;
	
}














?>
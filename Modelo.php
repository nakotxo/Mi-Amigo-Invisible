<?php
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
	echo "<script>window.location.href='http://localhost/proyecto/index.php/Home'</script>";
}
/* ---- fin $_POST['logout'] ----*/


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
		$insertPadreUsuSor='INSERT INTO PADREUSUSOR (IdSor, IdUsu, IdAmi, IdDes1, IdDes2, IdDes3, IdDes4, IdDes5) VALUES
		('.$idSor.','.$idUsu.','.$idAmi.','.$idDes1.','.$idDes2.','.$idDes3.','.$idDes4.','.$idDes5.')';
		InsertPadreUsuSor($insertPadreUsuSor);
		/*-----------------FIN--------------------*/
	}
  
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
	$sqlInsert = "INSERT INTO SORTEOS (SorId, SorNom, SorPar, SorFec, SorPre)  VALUES ("
		.$sorteoInsert['SorId'].","
		."'".$sorteoInsert['SorNom']."',"
		."'".$sorteoInsert['SorPar']."',"
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


/*------ recepcion de datos de usuario buscando por Id o por Nombre ---- */
function UsuValorCualquiera($UsuId){	//por ID
	$conexion=get_Conexion();
	if ($mysqli=get_Conexion()){
		/* ------------ Inicio busqueda Participantes -------------- */
		$sqlUsuario="SELECT * FROM USUARIOS WHERE UsuId='".$UsuId."'";
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
		$sql="SELECT *  FROM USUARIOS WHERE UsuNom='".$UsuNom."'";
		
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
		$sql="SELECT SorId FROM SORTEOS";		//Select para ejecutar, donde, seleccionará los Id de los SORTEOS de la BD
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

function Listado(){
	$conexion=get_Conexion();
	if (isset($_POST['Listado'])){
		if ($mysqli=get_Conexion()){
			$sqlUsuarios="SELECT * FROM USUARIOS";
			if ($resultado=$mysqli->query($sqlUsuarios)){
				$datosUsuarios['titulo']="Listado Usuarios";
				while ($fila=$resultado->fetch_assoc()){
					$datosUsuarios[]=$fila;
				}
				ListarUsuarios($datosUsuarios);
			//print_r($datos);
			}

			$sqlDeseos="SELECT * FROM DESEOS";
			if ($resultado=$mysqli->query($sqlDeseos)){
				$datosDeseos['titulo']="Listado DESEOS";
				while ($fila=$resultado->fetch_assoc()){
					$datosDeseos[]=$fila;
				}
				ListarDeseos($datosDeseos);
			//print_r($datosDeseos);
			}

			$sqlSorteos="SELECT * FROM SORTEOS";
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
}

function ListarUsuarios($datosUsuarios){
	echo "<h1>".$datosUsuarios['titulo']."</h1>";
	?>	
		<table border-style='solid 1px' aling='center'>
			<tr>
				<td COLSPAN='8'>Usuarios Baneados</td>
			</tr>
			<tr>
				<td>ID</td>
				<td>Nombre</td>
				<td>Pasword</td>
				<td>Rol</td>
				<td>E-mail</td>
				<td>ID Sorteos</td>
				<td>ID Deseos</td>
				<td>Administrador de sorteo</td>
			</tr>
			
				<?php
					for ($i=0;$i<count($datosUsuarios)-1;$i++){
						echo "<tr>";
						echo "<td>".$datosUsuarios[$i]['UsuId']."</td>";
						echo "<td>".$datosUsuarios[$i]['UsuNom']."</td>";
						echo "<td>".$datosUsuarios[$i]['UsuPwd']."</td>";
						echo "<td>".$datosUsuarios[$i]['UsuRol']."</td>";
						echo "<td>".$datosUsuarios[$i]['UsuEma']."</td>";
						echo "<td>".$datosUsuarios[$i]['UsuSorId']."</td>";
						echo "<td>".$datosUsuarios[$i]['UsuDesId']."</td>";
						echo "<td>".$datosUsuarios[$i]['UsuAdminSorId']."</td>";
						echo "</tr>";
					} 
				?>
		</table>
	<?php
}

function SoloUsuarios(){
	$conexion=get_Conexion();
		if ($mysqli=get_Conexion()){
			$sqlUsuarios="SELECT * FROM USUARIOS";
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
		<table border-style='solid 1px' aling='center'>
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
		<table border-style='solid 1px' aling='center'>
			<tr>
				<td COLSPAN='4'>Listado de Sorteos</td>
			</tr>
			<tr>
				<td>ID</td>
				<td>Nombre Sorteo</td>
				<td>Caracteristicas</td>
				<td>Fecha sorteo</td>
			</tr>
				<?php
					for ($i=0;$i<count($datosSorteos)-1;$i++){
						echo "<tr>";
						echo "<td>".$datosSorteos[$i]['SorId']."</td>";
						echo "<td>".$datosSorteos[$i]['SorNom']."</td>";
						echo "<td>".$datosSorteos[$i]['SorPar']."</td>";
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
			$sqlSorteos="SELECT * FROM SORTEOS";
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
	$NumSorteos=$MisSorteos[0];


		


	/* -----------------------FIN------------------------- */
	

}

// Funcion que devuelve los datos del usuario





/* función encargada de buscar los sorteos e introducir todos sus datos en un array
para acceder rapidamente a la información.
N-º de sorteos, cuales son, amigos invisibles, los deseos de su amigo invisible y los deseos para ese sorteo*/

function BuscaSorteo($usuId){
	$conexion=get_Conexion();
	if ($mysqli=get_Conexion()){
		$LosSorteos=array(); 	// declaracion de array
		$sqlString='SELECT * FROM PADREUSUSOR WHERE IdUsu='.$usuId;
		$LosSorteos[0]="";
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
		print_r($LosSorteos);

		return $LosSorteos; //devuelve el array o de variable
	
}

function TratarDatosSorteos($MisDatos,$MisSorteos){
	
	/**TEST
	 * visualización de array,
	 * para posterior tratamiento
	 */
	//print_r ($MisSorteos);
	/*--- fin TEST */
	$NumSor=$MisSorteos[0]; //numero de sorteos
	
	?>
	<table border='1px' align='center'>
		<tr>
			<td>SORTEO</td>
			<td>FECHA SORTEO</td>
			<td>TU AMIGO INVISIBLE</td>
			<td>SUS DESEOS</td>
			<td>TUS DESEOS</td>
			<td>PARTICIPANTES</td>
		</tr>
		<?php 
		$cont=0;
		for ($i=0;$i<$NumSor;$i++){
			$DatSor=DatosSorteo($MisSorteos[$cont+1]);
			$DatAmi=DatosParticipante($MisSorteos[$cont+2]);
			
			// Carga de todos los deseos del amigo invisible
			$NumDes=0; //Numero de deseos que tiene el amigo invisible
			$DatDes=array();
			$DatDes[0]=DatosDeseos($MisSorteos[$cont+3]);
			$DatDes[1]=DatosDeseos($MisSorteos[$cont+4]);
			$DatDes[2]=DatosDeseos($MisSorteos[$cont+5]);
			$DatDes[3]=DatosDeseos($MisSorteos[$cont+6]);
			$DatDes[4]=DatosDeseos($MisSorteos[$cont+7]);
			$AmiDeseos="";
			for ($Des=0;$Des<=4;$Des++){
				if ($DatDes[$Des]['DesId']!=0){ 
					$NumDes++;
					if ($NumDes==1){
						$AmiDeseos=$DatDes[$Des]['DesNom'];
					}else{
						$AmiDeseos=$AmiDeseos."<br>".$DatDes[$Des]['DesNom'];
					}
				}
				if ($NumDes==0){
					$AmiDeseos="No ha elegido regalos para este sorteo";
				}
			}

			// Carga de todos mis deseos del Sorteo
			$NumMisDes=0; //Numero de deseos que tenemos
			$DatMisDes=array();
			$DatMisDes[0]=DatosDeseos($MisSorteos[$cont+8]);
			$DatMisDes[1]=DatosDeseos($MisSorteos[$cont+9]);
			$DatMisDes[2]=DatosDeseos($MisSorteos[$cont+10]);
			$DatMisDes[3]=DatosDeseos($MisSorteos[$cont+11]);
			$DatMisDes[4]=DatosDeseos($MisSorteos[$cont+12]);
			$MisDeseos="";
			for ($MisDes=0;$MisDes<=4;$MisDes++){
				if ($DatMisDes[$MisDes]['DesId']!=0){ 
					$NumMisDes++;
					if ($NumMisDes==1){
						$MisDeseos=$DatMisDes[$MisDes]['DesNom'];
					}else{
						$MisDeseos=$MisDeseos."<br>".$DatMisDes[$MisDes]['DesNom'];
					}
				}
				if ($NumMisDes==0){
					$MisDeseos="No has elegido regalos para este sorteo";
				}
			}

			$SorNom=$DatSor['SorNom'];
			$SorFec=$DatSor['SorFec'];
			$AmiNom=$DatAmi['UsuNom']."<br>".$DatAmi['UsuEma'];
			
			//carga de los Participantes
			$NumPar=$MisSorteos[$cont+13];
			$LosPartis="";
			for ($Partis=0;$Partis<$NumPar;$Partis++){
				$DatLosPartis=DatosParticipante($MisSorteos[$cont+14+$Partis]);
				$LosPartis=$LosPartis."<br> ".$DatLosPartis['UsuNom'];
			}
			
		
			$cont=$cont+$NumPar+13;
		?>
		<tr>
			<td><?php echo $SorNom?></td>
			<td><?php echo $SorFec?></td>
			<td><?php echo $AmiNom?></td>
			<td><?php echo $AmiDeseos?></td>
			<td><?php echo $MisDeseos?></td>
			<td><?php echo $LosPartis?></td>
		</tr>
		<?php
		}

		?>
	</table>
	
	<?php
	
}

//función para sacar toda la información del sorteo 
function DatosSorteo($IdSorteo){
	$conexion=get_Conexion();
	if ($mysqli=get_Conexion()){
		/* ------------ Inicio busqueda sorteos -------------- */
		$sqlSorteo="SELECT *  FROM SORTEOS WHERE SorId='".$IdSorteo."'";
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
function DatosParticipante($IdParticipante){
	$conexion=get_Conexion();
	if ($mysqli=get_Conexion()){
		/* ------------ Inicio busqueda Participantes -------------- */
		$sqlParticipante="SELECT *  FROM USUARIOS WHERE UsuId='".$IdParticipante."'";
		/* TEST compropación de la sintaxis de la sql	
		//echo $sqlParticipante;
		*/
		if ($resultado=$mysqli->query($sqlParticipante)){
			$fila=$resultado->fetch_assoc();
			return($fila);
		}
		/* -----------------------FIN------------------------- */
	}
}


//función para sacar toda la información del Participante
function DatosDeseos($IdDeseos){
	$conexion=get_Conexion();
	if ($mysqli=get_Conexion()){
		/* ------------ Inicio busqueda Participantes -------------- */
		$sqlDeseos="SELECT *  FROM DESEOS WHERE DesId='".$IdDeseos."'";
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
/** Función UsuValorCualquiera 
 * Función devolver valor deseos a traves de un UsuID */

?>
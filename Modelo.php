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

function MisSorteos(){
	//MisDatos --> Creacion de array con todos los datos del Usuario
	$UsuNom=$_SESSION['Usuario'];
	$MisDatos=DatosUsuario($UsuNom);
	

	//Asignacion de datos de Usuario a Variables	
	$UsuId=$MisDatos['UsuId'];
	$UsuRol=$MisDatos['UsuRol'];
	$UsuPwd=$MisDatos['UsuPwd'];
	$UsuEma=$MisDatos['UsuEma'];
	$UsuSorId=$MisDatos['UsuSorId'];
	$UsuDesId=$MisDatos['UsuDesId'];
	$UsuAdminSorId=$MisDatos['UsuAdminSorId'];
	//COMPROBACION ok
	//print_r ($MisDatos);
	//echo "<br>".$UsuId.	$UsuRol.$UsuNom.$UsuPwd.$UsuEma.$UsuSorId.$UsuDesId.$UsuAdminSorId;

	//MisSorteos --> Creacion de array con todos los sorteos del Usuario
	$MisSorteos=BuscaSorteo($UsuSorId);
	$NumSorteos=$MisSorteos[0];
	/*Aclaracion del contenido:
		si el Usuario tiene sorteos, en el array nos encontraremos:
		[0]=> numero de sorteos (n)
		[1]=> Id del Sorteo Nº x
		[2]=> Id del Amigo del Sorteo x
		[3]=> Id del Deseo1 del Amigo del Sorteo x
		[4]=> Id del Deseo2 del Amigo del Sorteo x
		[5]=> Id del Deseo3 del Amigo del Sorteo x
		[6]=> Id del Deseo4 del Amigo del Sorteo x
		[7]=> Id del Deseo5 del Amigo del Sorteo x
		...vuelta a empezar con el sorteo x+1
		[8]=> Id del Sorteo Nº x+1 (si lo hubiera)
		[9]=>Id del Amigo del Sorteo x+1 (si lo hubiera)
		...así sucesivamente hasta (n) */
	//COMPROBACION ok
	//echo "cantidad sorteos:".$NumSorteos;
	//print_r ($MisSorteos);


	TratarDatosSorteos($MisSorteos);

		


	/* -----------------------FIN------------------------- */
	

}

// Funcion que devuelve los datos del usuario
function DatosUsuario($UsuNom){
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


















function BuscaSorteo($sqlSorteo){
	$LosSorteos=array(); 		// declaracion de array
	if ($sqlSorteo==""){	//Si el resultado de la consulta esta vacio, $sqlSorteo-> sorteos del usuario 
		$LosSorteos[0]="<br/>Aun no esta incluido en ningún sorteo";
	}else{
		//echo $sqlSorteo."<br/>";
		$i=0;	//variable para controlar entrada y salida bucle	
		$Longitud= strlen($sqlSorteo);	//variable que contiene longitud del valor 
		$cuantos=substr_count ( $sqlSorteo , "S", $offset = 0, $Longitud); //Variable cuntos sorteos hay
		$LosSorteos[$i]=$cuantos;	// Primera posición del array guardamos cantidad de sorteos de la persona
		$cont=1;
		while ($i!=$cuantos){
			$inicioSorteo= strpos ($sqlSorteo,"S",$i);	//busqueda posicion del Id del Sorteo
			$finalSorteo=strpos ($sqlSorteo,"(",$inicioSorteo+1); // busqueda del fin del Id del Sorteo
			$totalCarateresSorteo= ($finalSorteo-$inicioSorteo)-1; // varible del total de caracteres que ocupa el Id del Sorteo
			
			$inicioAmigo= strpos ($sqlSorteo,"A",$inicioSorteo);	//busqueda posicion del Id del Amigo
			$finalAmigo=strpos ($sqlSorteo,"-",$inicioAmigo+1); // busqueda del fin del Id del Amigo
			$totalCarateresAmigo= ($finalAmigo-$inicioAmigo)-1; // varible del total de caracteres que ocupa el Id del Amigo
			
			
			$j=0;
			$inicioDeseo= strpos ($sqlSorteo,"-",$inicioAmigo)+1;	//busqueda posicion del Id del Deseo
			$finalDeseo=strpos ($sqlSorteo,",",$inicioDeseo); // busqueda del fin del Id del Deseo
			$totalCarateresDeseo=($finalDeseo-$inicioDeseo); // varible del total de caracteres que ocupa el Id del Deseo1
			$ElDeseo=substr($sqlSorteo,$inicioDeseo,$totalCarateresDeseo);
				echo "<br> inicio deseo: ".$inicioDeseo;
				echo ", final deseo: ".$finalDeseo;
				echo ", total caracteres deseo: ".$totalCarateresDeseo;
				echo ",el deseo: ".$ElDeseo;
			
			while ($j<4){
				echo $j;
				if ($j<3){
						$inicioDeseo= ($inicioDeseo+$totalCarateresDeseo+1);	//busqueda posicion del Id del Deseo
						$finalDeseo=strpos ($sqlSorteo,",",$inicioDeseo); // busqueda del fin del Id del Deseo
						$totalCarateresDeseo=($finalDeseo-$inicioDeseo); // varible del total de caracteres que ocupa el Id del Deseo1
						$ElDeseo=substr($sqlSorteo,$inicioDeseo,$totalCarateresDeseo);
				}else{
						$inicioDeseo= ($inicioDeseo+$totalCarateresDeseo+1);	//busqueda posicion del Id del Deseo
						$finalDeseo=strpos ($sqlSorteo,")",$inicioDeseo-$totalCarateresDeseo-2); // busqueda del fin del Id del Deseo
						$totalCarateresDeseo=($finalDeseo-$inicioDeseo); // varible del total de caracteres que ocupa el Id del Deseo1
						$ElDeseo=substr($sqlSorteo,$inicioDeseo,$totalCarateresDeseo);
				}
				
				
				echo "<br> inicio deseo: ".$inicioDeseo;
				echo ", final deseo: ".$finalDeseo;
				echo ", total caracteres deseo: ".$totalCarateresDeseo;
				echo ",el deseo: ".$ElDeseo;
				$j++;
			}
			
			echo "<br>";

			$ElSorteo= substr ($sqlSorteo, $inicioSorteo+1, $totalCarateresSorteo); // Extrae el dato Id del Sorteo
			$ElAmigo= substr ($sqlSorteo, $inicioAmigo+1, $totalCarateresAmigo); // Extrae el dato Id del Amigo
			
			//echo "El sorteo $ElSorteo, tiene como a amigo a $ElAmigo con los deseos $LosDeseos<br/>";
			
			$LosSorteos[$cont]= $ElSorteo;
			
			$cont++;
			$LosSorteos[$cont]= $ElAmigo;    //." ".$LosDeseos;
			$cont++;
			$i++;
		}
	}
	return $LosSorteos; //devuelve el array o de variable
}

function TratarDatosSorteos($losSorteos){
	
	echo "Usuario ".$_SESSION['Usuario'].", tienes $losSorteos[0] Sorteos <br>";
	$finalSorteo=strpos ($losSorteos[1]," ",0);
	$totalCarateresSorteo= ($finalSorteo); // varible del total de caracteres que ocupa el Id del Sorteo
	$ElSorteo=substr ($losSorteos[1], 0, $totalCarateresSorteo); // Extrae el dato Id del Sorteo
	$filaSorteo=DatosSorteo($ElSorteo); //llamada a la funcion para optener todos los datos del sorte $ElSorteo el cual posee el id del sorteo

	//tratamiento de los participantes para sacar sus datos
	$IdsPar=$filaSorteo['SorPar']; //identificadores de los participantes separados por comas 
	$TotalParticipantes =(substr_count($IdsPar,',')+1);//contando las comas puedo obtener el numero de participantes, sumando 1 mas.
	echo "numero de participantes:".$TotalParticipantes."<br>";
	echo "Participantes:".$IdsPar."<br>";

	$Participantes="";
	for($i=0;$i<$TotalParticipantes;$i++){
		
			if ($i==0){
				$IniPar=$i;
				$FinPar= strpos ($IdsPar,",",$IniPar+1);
				$CanCarPar=$FinPar-$IniPar;
				$ElParticipante=substr($IdsPar,$i,$CanCarPar); //Cantidad caracteres participante
				$IniPar=$i;
			}else{
				$IniPar=strpos ($IdsPar,",",$FinPar);
				$FinPar= $IniPar+$CanCarPar;
				$CanCarPar=$FinPar-$IniPar;
				$ElParticipante=substr($IdsPar,$IniPar+1,$CanCarPar); //Cantidad caracteres participante
			}
			
			$filaParticipante=DatosParticipante($ElParticipante); //llamada a la funcion para obtener todos los datos del participante
			$Participantes=$Participantes.$filaParticipante['UsuNom']." - ".$filaParticipante['UsuEma']."<br>";

			echo "<br>inicio:".$IniPar." fin:".$FinPar." Cantidad:".$CanCarPar." El usuario es:".$ElParticipante;
		
	}

	echo "<table border='1px' align='center'>";
		echo "<tr>";
			echo "<td>SORTEO</td>";
			echo "<td>PARTICIPANTES</td>";
			echo "<td>FECHA SORTEO</td>";
			echo "<td>TU AMIGO INVISIBLE</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>".$filaSorteo['SorNom']."</td>";
			echo "<td>".$Participantes."</td>";
			echo "<td>".$filaSorteo['SorFec']."</td>";
			
		echo "</tr>";
	echo "</table>";






	$inicioSorteo= strpos ($losSorteos[1]," ",0);	//busqueda posicion del Id del Sorteo
	$finalSorteo=strpos ($losSorteos[1]," ",$inicioSorteo+1); // busqueda del fin del Id del Sorteo
	$ElSorteo= substr ($losSorteos[1], $inicioSorteo+1, $totalCarateresSorteo); // Extrae el dato Id del Sorteo
	
	




}
//función para sacar toda la información del sorteo 
function DatosSorteo($IdSorteo){
	$conexion=get_Conexion();
	if ($mysqli=get_Conexion()){
		/* ------------ Inicio busqueda sorteos -------------- */
		$sqlSorteo="SELECT SorId,SorNom,SorPar,SorFec  FROM SORTEOS WHERE SorId='".$IdSorteo."'";
			echo $sqlSorteo;
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
			//echo $sqlParticipante;
		if ($resultado=$mysqli->query($sqlParticipante)){
			$fila=$resultado->fetch_assoc();
			return($fila);
		}
		/* -----------------------FIN------------------------- */
	}
}

?>
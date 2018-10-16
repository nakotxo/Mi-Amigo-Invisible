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
	<ul id="LstUsu" name="Usuarios">
		<?php 
		for ($i=0;$i<count($datosUsuarios)-1;$i++){
			echo "<li value= '".$datosUsuarios[$i]['UsuId']."'title='".$datosUsuarios[$i]['UsuNom']."'>".$datosUsuarios[$i]['UsuId']." - ".$datosUsuarios[$i]['UsuNom']."</li>";
		} ?>
	</ul>
	<!--Lista definitiva de usuarios a participar-->
	<ul id="LstUsuFin" name="ListaUsuariosFinal">
	</ul>
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
	$MisSorteos=BuscaSorteo($UsuSorId,$UsuDesId);
	$NumSorteos=$MisSorteos[0];
	/*Aclaracion del contenido de MisSorteos:
		si el Usuario tiene sorteos, en el array nos encontraremos:
		[0]=> numero de sorteos (n)
		[1]=> Id del Sorteo Nº x
		[2]=> Id del Amigo del Sorteo x
		[3]=> Id del Deseo1 del Amigo del Sorteo x
		[4]=> Id del Deseo2 del Amigo del Sorteo x
		[5]=> Id del Deseo3 del Amigo del Sorteo x
		[6]=> Id del Deseo4 del Amigo del Sorteo x
		[7]=> Id del Deseo5 del Amigo del Sorteo x
		[8]=> Id de mi Deseo1 para el sorteo x
		[9]=> Id de mi Deseo2 para el sorteo x
		[10]=>Id de mi Deseo3 para el sorteo x
		[11]=>Id de mi Deseo4 para el sorteo x
		[12]=>Id de mi Deseo5 para el sorteo x
		[13]=> número de participantes (n)
		[14]=> Participante 1 de n
		[15]=> Participante 2 de n
		[16]=> Participante 3 de n
		...vuelta a empezar con el sorteo x+1...
		[n+m+1]=> Id del Sorteo Nº x+1 (si lo hubiera)
		[n+m+2]=>Id del Amigo del Sorteo x+1 (si lo hubiera)
		...así sucesivamente hasta (n) */
	//COMPROBACION ok
	//echo "cantidad sorteos:".$NumSorteos;
	//print_r ($MisSorteos);


	TratarDatosSorteos($MisDatos,$MisSorteos);

		


	/* -----------------------FIN------------------------- */
	

}

// Funcion que devuelve los datos del usuario





/* función encargada de buscar los sorteos e introducir todos sus datos en un array
para acceder rapidamente a la información.
N-º de sorteos, cuales son, amigos invisibles, los deseos de su amigo invisible y los deseos para ese sorteo*/

function BuscaSorteo($sqlSorteo,$sqlMisDeseos){
	$LosSorteos=array(); 		// declaracion de array
	if ($sqlSorteo==""){	//Si el resultado de la consulta esta vacio, $sqlSorteo-> sorteos del usuario 
		$LosSorteos[0]="<br/>Aun no esta incluido en ningún sorteo";
	}else{
		//echo $sqlSorteo."<br/>";
		$i=0;	//variable para controlar entrada y salida bucle	
		$Longitud= strlen($sqlSorteo);	//variable que contiene longitud del valor 
		$cuantos=substr_count ( $sqlSorteo , "S", $offset = 0, $Longitud); //Variable cuntos sorteos hay
		$LosSorteos[$i]=$cuantos;	// posición [0] cantidad de sorteos de la persona
		
		$cont=1; 
		while ($i!=$cuantos){
			/* Busqueda y asignacion en array de la id del sorteo */
			$inicioSorteo= strpos ($sqlSorteo,"S",$i);	//busqueda posicion del Id del Sorteo
			$finalSorteo=strpos ($sqlSorteo,"(",$inicioSorteo+1); // busqueda del fin del Id del Sorteo
			$totalCarateresSorteo= ($finalSorteo-$inicioSorteo)-1; // varible del total de caracteres que ocupa el Id del Sorteo
			$ElSorteo= substr ($sqlSorteo, $inicioSorteo+1, $totalCarateresSorteo); // Extrae el dato Id del Sorteo
			
			$LosSorteos[$cont]= $ElSorteo;	//posición [1],[1+12]... Id del sorteo
			$cont++; 

			/* Busqueda del id del amigo */
			$inicioAmigo= strpos ($sqlSorteo,"A",$inicioSorteo);	//busqueda posicion del Id del Amigo
			$finalAmigo=strpos ($sqlSorteo,"-",$inicioAmigo+1); // busqueda del fin del Id del Amigo
			$totalCarateresAmigo= ($finalAmigo-$inicioAmigo)-1; // varible del total de caracteres que ocupa el Id del Amigo
			$ElAmigo= substr ($sqlSorteo, $inicioAmigo+1, $totalCarateresAmigo); // Extrae el dato Id del Amigo
			

			$LosSorteos[$cont]= $ElAmigo;    // posicion [2],[2+12]... Id del amigo
			$cont++; 

			//tratamiento de los deseos del amigo del sorteo
			$j=0;
			$inicioDeseo= strpos ($sqlSorteo,"-",$inicioAmigo)+1;	//busqueda posicion del Id del Deseo
			$finalDeseo=strpos ($sqlSorteo,",",$inicioDeseo); // busqueda del fin del Id del Deseo
			$totalCarateresDeseo=($finalDeseo-$inicioDeseo); // varible del total de caracteres que ocupa el Id del Deseo1
			$ElDeseo=substr($sqlSorteo,$inicioDeseo,$totalCarateresDeseo);
			
			$LosSorteos[$cont]=$ElDeseo; //posición [3],[3+12]... id deseo1 del amigo
			$cont++;

			while ($j<4){
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

				$LosSorteos[$cont]=$ElDeseo; //[4],[5],[6],[7]-,[4+12],[5+12],[6+12],[7+12]... id de los deseos 2,3,4,5 del amigo
				$cont++;
				$j++;
			}

			//tratamiento de los deseos propios para el sorteo
			$k=0;
			if ($cont<12){
				$InicioMiDeseo= strpos ($sqlMisDeseos,"(",0)+1;	//busqueda posicion del Id del Deseo
			}else{
				$InicioMiDeseo= strpos ($sqlMisDeseos,"(",$InicioMiDeseo)+1;	//busqueda posicion del Id del Deseo
			}
			$FinalMiDeseo=strpos ($sqlMisDeseos,",",$InicioMiDeseo); // busqueda del fin del Id del Deseo
			$TotalCarateresMiDeseo=($FinalMiDeseo-$InicioMiDeseo); // varible del total de caracteres que ocupa el Id del Deseo1
			$MiDeseo=substr($sqlMisDeseos,$InicioMiDeseo,$TotalCarateresMiDeseo);
			
			$LosSorteos[$cont]=$MiDeseo; //posición [8],[8+12] id de Mideseo1 
			$cont++;

			while ($k<4){
				if ($k<3){
						$InicioMiDeseo= ($InicioMiDeseo+$TotalCarateresMiDeseo+1);	//busqueda posicion del Id del Deseo

						$FinalMiDeseo=strpos ($sqlMisDeseos,",",$InicioMiDeseo); // busqueda del fin del Id del Deseo

						$TotalCarateresMiDeseo=($FinalMiDeseo-$InicioMiDeseo); // varible del total de caracteres que ocupa el Id del Deseo1
						$MiDeseo=substr($sqlMisDeseos,$InicioMiDeseo,$TotalCarateresMiDeseo);

				}else{
						$InicioMiDeseo= ($InicioMiDeseo+$TotalCarateresMiDeseo+1);	//busqueda posicion del Id del Deseo

						$FinalMiDeseo=strpos ($sqlMisDeseos,")",$InicioMiDeseo-$TotalCarateresMiDeseo-2); // busqueda del fin del Id del Deseo

						$TotalCarateresMiDeseo=($FinalMiDeseo-$InicioMiDeseo); // varible del total de caracteres que ocupa el Id del Deseo1
						$MiDeseo=substr($sqlMisDeseos,$InicioMiDeseo,$TotalCarateresMiDeseo);

				}

				$LosSorteos[$cont]=$MiDeseo; //[9],[10],[11],[12]-[9+12],[10+12],[11+12],[12+12]  id de MiDeseo 2,3,4,5
				$cont++;
				$k++;
			}
			//tratamiento de los participantes
			$DatPar=DatosSorteo($ElSorteo); //optencion de los datos del sorteo
			$LosPar=$DatPar['SorPar'];
			echo "participantes".$LosPar;
			$LongPar= strlen($LosPar);	//variable que contiene longitud del valor 
			$NumPar=substr_count($LosPar,',',$offset=0,$LongPar)+1; //contando las ',' mas 1 nos da el total de participantes
			echo "son: ".$NumPar;
			$LosSorteos[$cont]=$NumPar;
			$cont++;
			for ($m=0;$m<$NumPar;$m++){
				if ($m==0){
					$IniPar=0;
					$TotalCarateresPar=strpos($LosPar,',',$IniPar);
					$ElParticipante=substr($LosPar,$IniPar,$TotalCarateresPar);
					$LosSorteos[$cont]=$ElParticipante;
					$cont++;
					echo "El parti es: ".$ElParticipante;

				}else if ($m<$NumPar-1){
					$IniPar=$IniPar+$TotalCarateresPar+1;
					$FinPar=strpos($LosPar,',',$IniPar+1);
					$TotalCarateresPar=$FinPar-$IniPar;
					$ElParticipante=substr($LosPar,$IniPar,$TotalCarateresPar);
					$LosSorteos[$cont]=$ElParticipante;
					$cont++;
					echo "El parti es: ".$ElParticipante;
				}else if($m==$NumPar-1){
					$IniPar=$IniPar+$TotalCarateresPar+1;
					$FinPar=$LongPar;
					$TotalCarateresPar=$FinPar-$IniPar;
					$ElParticipante=substr($LosPar,$IniPar,$TotalCarateresPar);
					$LosSorteos[$cont]=$ElParticipante;
					$cont++;
					echo "El parti es: ".$ElParticipante;
				}
			}
			$i++;
		}
	}
	
	/*comprobacion de los datos introducidos al array
	todo ok 
	echo "<br>";
	print_r ($LosSorteos);
	echo "<br>";
	*/
	
	return $LosSorteos; //devuelve el array o de variable
	
}

function TratarDatosSorteos($MisDatos,$MisSorteos){
	
	
	print_r ($MisSorteos);
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


//función para sacar toda la información del Participante
function DatosDeseos($IdDeseos){
	$conexion=get_Conexion();
	if ($mysqli=get_Conexion()){
		/* ------------ Inicio busqueda Participantes -------------- */
		$sqlDeseos="SELECT *  FROM DESEOS WHERE DesId='".$IdDeseos."'";
			//echo $sqlDeseos;
		if ($resultado=$mysqli->query($sqlDeseos)){
			$fila=$resultado->fetch_assoc();
			return($fila);
		}
		/* -----------------------FIN------------------------- */
	}
}



?>
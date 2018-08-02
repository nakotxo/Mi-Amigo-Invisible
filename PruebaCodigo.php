<?php
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
        echo "conexion establecida\n";
        //return $conexion;
	}
	// 2- Realizamos la select en $sql
	$sql="SELECT * FROM `Usuarios`";
	if ($resultado=$conexion->query($sql)){
		echo "select realizada";
		$cont=mysqli_affected_rows($conexion);
		echo "$cont";
		while ($fila=$resultado->fetch_assoc()){
			echo ($fila["UsuId"]);
			echo ($fila["UsuNom"]);
		} 
	}else{
		echo "error en la SELECT";
	}

?>

<?php
//Insertar nota.
//Solicita codigo de materia, carnet, ciclo y nota final.
//url: 
//http://localhost/ws_nota_insert.php?carnet=SS00001&codmateria=MAT215&ciclo=2&notafinal=8
$codmateria=$_REQUEST['codmateria'];
$carnet=$_REQUEST['carnet'];
$ciclo=$_REQUEST['ciclo'];
$notafinal=$_REQUEST['notafinal'];
//Datos para la BD.
$servidor="localhost";
$usuario="root";
$baseDatos="av12013";
$password="usbw";
//Para no mostrar advertencias.
error_reporting(E_ALL ^ E_DEPRECATED);
//Inicializamos el resultado con el valor 0
$respuesta=array('resultado'=>0);
//json_encode($respuesta);
//Intentamos conectarnos al servidor.
$conexion=mysql_connect($servidor,$usuario,$password);
//Si fallo la conexion cerramos
if(!$conexion){
	$respuesta['error']="Error en la conexion de datos.";
	die(json_encode($respuesta));
}
//Intentamos seleccionar la BD.
$bd_seleccionada=mysql_select_db($baseDatos, $conexion);
//Si fallo seleccion cerramos.
if(!$bd_seleccionada){
	$respuesta['error']="Problemas en la seleccion de base de datos";
	die(json_encode($respuesta));
}

$query = "INSERT INTO NOTA VALUES('".$codmateria."','".$carnet."','".$ciclo."',".$notafinal.");";
//Ejecutamos el query,
$resultado = mysql_query($query);
//Si el resultado fallo, devolver en "error" el error, sirve para debug.
if(!$resultado){
	$respuesta['error']=mysql_error();
}
//Si la respuesta es correcta enviamos 1, indicando que el query se realizo con exito.
if(mysql_affected_rows() == 1)
$respuesta=array('resultado'=>1);
echo json_encode($respuesta);
mysql_close($conexion);
?>
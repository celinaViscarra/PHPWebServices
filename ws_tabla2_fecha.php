<?php
//Materia por fecha de modificado.
$year=$_REQUEST['year'];
$month=$_REQUEST['month'];
$day=$_REQUEST['day'];
$servidor="localhost";
$usuario="root";
$baseDatos="av12013";
$password="usbw";
error_reporting(E_ALL ^ E_DEPRECATED);
$conexion=mysql_connect($servidor,$usuario,$password) or
die ("Problemas en la conexion");
mysql_select_db($baseDatos,$conexion)
or die("Problemas en la selecciÃ³n de la base de datos");
$registros=mysql_query("Select * from MATERIA where fecha_modificado>'".$year."-".$month."-".$day."'",$conexion) or
die("Problemas en el select:".mysql_error());
$filas=array();
while ($reg=mysql_fetch_assoc($registros))
{
$filas[]=$reg;
}
echo json_encode($filas);
mysql_close($conexion);
?>
<?php
//http://localhost/AV12013/ws_max.php?carnet=SS00001
$carnet=$_REQUEST['carnet'];
$servidor="localhost";
$usuario="root";
$baseDatos="av12013";
$password="usbw";
error_reporting(E_ALL ^ E_DEPRECATED);
$conexion=mysql_connect($servidor,$usuario,$password) or
die ("Problemas en la conexion");
mysql_select_db($baseDatos,$conexion)
or die("Problemas en la seleccion de la base de datos");
$registros=mysql_query("SELECT CARNET,MAX(NOTAFINAL) AS MAXIMO FROM NOTA WHERE CARNET='".$carnet."' group by carnet",$conexion) or
die("Problemas en el select:".mysql_error());
$filas=array();
while ($reg=mysql_fetch_assoc($registros))
{
$filas[]=$reg;
}
echo json_encode($filas);
mysql_close($conexion);
?>
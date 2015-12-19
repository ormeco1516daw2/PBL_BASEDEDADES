<?php 
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");


$rows=array();
$json_response=array();
$nom_alumne=$_POST['nom_alumne'];

$mysqli = mysqli_connect("localhost","root","root","escola");
$sentencia = $mysqli -> prepare("select c.codi_assignatura from cursen c join alumne a on c.codi_alumne=a.codi_alumne where c.codi_alumne=(select codi_alumne from alumne where nom_alumne=?)" );
$sentencia->bind_param('s',$nom_alumne);
$sentencia->execute();
$sentencia->bind_result($codi_assignatura);
while ($sentencia->fetch()){
        
            array_push($json_response,$codi_assignatura);
        }

echo json_encode($json_response);
?>
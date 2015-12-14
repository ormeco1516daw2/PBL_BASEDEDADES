<?php

   notesAlumnes();
    function notasAlumnes() {
        $mysqli = mysqli_connect("localhost","root","root","escola");
        $resultado = mysqli_query($mysqli,"SELECT a.nom_alumne, a.codi_alumne , c.nota FROM alumne a join cursen c on a.codi_alumne=c.codi_alumne;");
        $filas=array();
        $error=array();
        $json_response=array();
        $contar = mysqli_num_rows($resultado);
       
            while($fila=mysqli_fetch_assoc($resultado)){
                $filas['nom_alumne'] = $fila['nom_alumne'];
                $filas['codi_alumne'] = $fila['codi_alumne'];
                $filas['nota'] = $fila['nota'];
                
                           
            }
        
	   echo json_encode($json_response);
        mysqli_close($mysqli);
    }

function mitjaperCurs() {
     $curs=1;
     $array_notes = [];
     $mysqli = mysqli_connect("localhost","root","root","escola");
     $sentencia = $mysqli -> prepare("SELECT avg(c.NOTA) FROM cursen c join assignatura a on c.codi_assignatura=a.codi_assignatura WHERE a.codi_curs = ?" );
     $sentencia->bind_param("s",$curs);
     $sentencia->execute();
     $sentencia->bind_result($nota);
    while ($sentencia->fetch())
    {
        array_push($array_notes, $nota);
        $curs++;
    }
        
        
       echo json_encode($json_response);
        mysqli_close($mysqli);
    }

/*function numAlumnesAssignatura() {
     $curs=1;
     $array_numAlum=[];
     $assignatura = array("CAT_1", "CAT_2", "CAT_3", "CAT_4","CAT_5","CAT_6","MAT_1", "MAT_2", "MAT_3", "MAT_4","MAT_5","MAT_6","NAT_1", "NAT_2", "NAT_3", "NAT_4","NAT_5","NAT_6");
     $mysqli = mysqli_connect("localhost","root","root","escola");
     $sentencia = $mysqli -> prepare("select count(codi_alumne),codi_assignatura from cursen where codi_assignatura=?" );
     $sentencia->bind_param("s",$assignatura[]);
     $sentencia->execute();
     $sentencia->bind_result($numAlum);
    while ($sentencia->fetch())
    {

        $array_numAlum[$assignatura[i]] = $numAlum;
        //array_push($array_numAlum, $numAlum);
        $i++;
    }
        
        
       echo json_encode($json_response);
        mysqli_close($mysqli);
    }*/

function numAlumnesAssignatura() {
     $array_numAlum=[];
     $i=0;
     $assignatura = array("CAT_1", "CAT_2", "CAT_3", "CAT_4","CAT_5","CAT_6","MAT_1", "MAT_2", "MAT_3", "MAT_4","MAT_5","MAT_6","NAT_1", "NAT_2", "NAT_3", "NAT_4","NAT_5","NAT_6");
     $mysqli = mysqli_connect("localhost","root","root","escola");
     $sentencia = $mysqli -> prepare("select count(codi_alumne),codi_assignatura from cursen where codi_assignatura=?" );
     $sentencia->bind_param("s",$assignatura[]);
     $sentencia->execute();
     $sentencia->bind_result($numAlum);
    while ($sentencia->fetch())
    {

        $array_numAlum[$assignatura[$i]] = $numAlum;
        //array_push($array_numAlum, $numAlum);
        $i++;
    }
        
        
       echo json_encode($json_response);
        mysqli_close($mysqli);
    }


function numAlumnesCurs(){
     $curs=1;
     $array_numAlum=[];
     $mysqli = mysqli_connect("localhost","root","root","escola");
     $sentencia = $mysqli -> prepare("select count(c.codi_alumne) from cursen c join assignatura a on a.codi_assignatura=c.codi_assignatura where a.codi_curs=?" );
     $sentencia->bind_param("s",$curs);
     $sentencia->execute();
     $sentencia->bind_result($numAlum);
    while ($sentencia->fetch())
    {

        array_push($array_numAlum, $numAlum);
        $curs++;
    }
        
        
       echo json_encode($json_response);
        mysqli_close($mysqli);
    }
  




}
>
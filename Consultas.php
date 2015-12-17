
<!DOCTYPE html>
<html lang="ca">

<head>
    <title>Consultes</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
</head>



<body>
    <a href="principal.php">
        <input type='submit' value='Torna enrere' class='info btn-primary'><br>
    </a>
</body>
</html>
<?php

if (isset($_POST['nom_Alum_Assig'])) {
    nom_Alum_Assig();
} 
 if (isset($_POST['mitjaperCurs'])) {
    mitjaperCurs();
}

 if (isset($_POST['mitjaperAssignatura'])) {
    mitjaperAssignatura();
}

if (isset($_POST['numAlumnesAssignatura'])) {
    numAlumnesAssignatura();
}
if (isset($_POST['numAlumnesCurs'])) {
    numAlumnesCurs();
}


function nom_Alum_Assig() {
    
    $mysqli = mysqli_connect("localhost","root","root","escola");
    $nom_alumne = $_POST['nom_alumne_assignatura'];
    //echo $nom_alumne;
    
    $array_assignatura = array();
    $array_notes = array();
    $sentencia = $mysqli -> prepare("Select c.codi_assignatura,c.nota from cursen c join alumne a on c.codi_alumne=a.codi_alumne where c.codi_alumne=(select codi_alumne from alumne where nom_alumne=?)");
    $sentencia -> bind_param ( 's', $nom_alumne );
    $sentencia->bind_result($codi_assignatura,$nota);
    $sentencia -> execute ();
        while ($sentencia->fetch())
        {   
            array_push($array_assignatura, $codi_assignatura);
            echo $codi_assignatura;
            array_push($array_notes, $nota);
            echo $nota;
            
        }
    }


function mitjaperCurs() {
    $mysqli = mysqli_connect("localhost","root","root","escola");
    $resultado = mysqli_query($mysqli,"SELECT codi_curs FROM curs");//les sentencies no es posen mai a la iteració
    $sentencia = $mysqli -> prepare("SELECT avg(c.NOTA) FROM cursen c join assignatura a on c.codi_assignatura=a.codi_assignatura WHERE a.codi_curs = ?" );//ha d'estar fora
        $filas=array();
        $error=array();
        //$json_response=array();
        $array_notes = array();
        
            while($fila=mysqli_fetch_assoc($resultado)){
                 $filas['codi_curs'] = (int)$fila['codi_curs'];
                  $codi_curs=$filas['codi_curs'];
                  echo $codi_curs." ";                                 
                 $sentencia->bind_param('s',$codi_curs);
                 $sentencia->execute();
                 $sentencia->bind_result($nota);
                 if ($sentencia->fetch())
                {
                    if($nota==null){
                      $nota=0;
                    }
                    array_push($array_notes, $nota);
                   echo $nota." ";
                   //$sentencia->close(); 
                }                           
            }             
        
}

function mitjaperAssignatura() {
        
   $mysqli = mysqli_connect("localhost","root","root","escola");
   $resultado = mysqli_query($mysqli,"SELECT codi_assignatura from assignatura");//les sentencies no es posen mai a la iteració
   $sentencia = $mysqli -> prepare("SELECT avg(c.NOTA) FROM cursen c join assignatura a on c.codi_assignatura=a.codi_assignatura WHERE a.codi_assignatura = ?" );//ha d'estar fora
   $filas=array();
   $error=array();
   //$json_response=array();
   $array_notes = array();
    
    while($fila=mysqli_fetch_assoc($resultado)){
         $filas['codi_assignatura'] = $fila['codi_assignatura'];
          $codi_assignatura=$filas['codi_assignatura'];
          echo $codi_assignatura." ";                                 
         $sentencia->bind_param('s',$codi_assignatura);
         $sentencia->execute();
         $sentencia->bind_result($nota);
         if ($sentencia->fetch())
        {
            if($nota==null){
                $nota=0;
            }
            array_push($array_notes, $nota);
           echo $nota." ";
           //$sentencia->close(); 
        }                           
    } 
}


function numAlumnesAssignatura() {
   $mysqli = mysqli_connect("localhost","root","root","escola");
   $resultado = mysqli_query($mysqli,"SELECT codi_assignatura from assignatura");//les sentencies no es posen mai a la iteració
   $sentencia = $mysqli -> prepare("select count(codi_alumne) from cursen where codi_assignatura=?" );//ha d'estar fora
   $filas=array();
   $error=array();
   //$json_response=array();
   $array_num_alumne = array();
    
    while($fila=mysqli_fetch_assoc($resultado)){
         $filas['codi_assignatura'] = $fila['codi_assignatura'];
          $codi_assignatura=$filas['codi_assignatura'];
          echo $codi_assignatura." ";                                 
         $sentencia->bind_param('s',$codi_assignatura);
         $sentencia->execute();
         $sentencia->bind_result($num_alumne);
         if ($sentencia->fetch()){
        
            array_push($array_num_alumne, $num_alumne);
           echo $num_alumne." ";
           //$sentencia->close(); 
        }                           
    } 
}


function numAlumnesCurs(){
    
    $mysqli = mysqli_connect("localhost","root","root","escola");
    $resultado = mysqli_query($mysqli,"SELECT codi_curs FROM curs");//les sentencies no es posen mai a la iteració
    $sentencia = $mysqli -> prepare("select count(c.codi_alumne) from cursen c join assignatura a on a.codi_assignatura=c.codi_assignatura where a.codi_curs=?" );//ha d'estar fora
    $filas=array();
    $error=array();
    //$json_response=array();
    $array_num_alumne = array();
        
    while($fila=mysqli_fetch_assoc($resultado)){
         $filas['codi_curs'] = $fila['codi_curs'];
          $codi_curs=$filas['codi_curs'];
          echo $codi_curs." ";                                 
         $sentencia->bind_param('s',$codi_curs);
         $sentencia->execute();
         $sentencia->bind_result($num_alumne);
         if ($sentencia->fetch())
        {
            
            array_push($array_num_alumne, $num_alumne);
           echo $num_alumne." ";
           //$sentencia->close(); 
        }                           
    }
}


    

/*
   notesAlumnes();
    function notasAlumnes() {
        $mysqli = mysqli_connect("localhost","root","root","escola");
        $resultado = mysqli_query($mysqli,"SELECT a.nom_alumne, a.codi_alumne , c.nota FROM alumne a join cursen c on a.codi_alumne=c.codi_alumne");
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
*/

//}
?>
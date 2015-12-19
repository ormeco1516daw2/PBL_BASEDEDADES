
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
if (isset($_POST['Assig_AproSusp'])) {
    AssigAproSusp();
}


function AssigAproSusp() {
    
    $mysqli = mysqli_connect("localhost","root","root","escola");
    $nom_assignatura = $_POST['nom_assignatura'];
    //echo $nom_alumne;
    
    $array_assignatura = array();
    $array_apro_sus = array();
    $sentencia = $mysqli -> prepare("SELECT count(nota) FROM cursen where codi_assignatura= ? and nota>=5");
    $sentencia -> bind_param ( 's', $nom_assignatura );
    $sentencia->bind_result($num_apro);
    $sentencia -> execute ();
    $usuari="root";
    $contrasenya="root";
    $gbd = new PDO ( 'mysql:host=localhost;dbname=escola' , $usuari ,$contrasenya);
    $sentencia1 = $gbd -> prepare ( "SELECT count(nota) FROM cursen where codi_assignatura= :nom_assignatura and nota<5" );
    $sentencia1 -> bindParam ( ':nom_assignatura' , $nom_assignatura );
    $sentencia1->bindColumn(1, $num_susp);
    $sentencia1 -> execute ();
        if ($sentencia->fetch())
        {   
            array_push($array_assignatura, $nom_assignatura);
            echo $nom_assignatura;
            array_push($array_apro_sus, $num_apro);
            echo $num_apro;  
        }
         if ($sentencia1 -> fetch ())
        {   
          
            array_push($array_apro_sus, $num_susp);
            echo $num_susp;  
        }
    }


function CursAproSusp() {
    
    $mysqli = mysqli_connect("localhost","root","root","escola");
    $nom_assignatura = $_POST['nom_assignatura'];
    //echo $nom_alumne;
    
    $array_assignatura = array();
    $array_apro_sus = array();
    $sentencia = $mysqli -> prepare("SELECT count(nota) FROM cursen where codi_assignatura= ? and nota>=5");
    $sentencia -> bind_param ( 's', $nom_assignatura );
    $sentencia->bind_result($num_apro);
    $sentencia -> execute ();
    $usuari="root";
    $contrasenya="root";
    $gbd = new PDO ( 'mysql:host=localhost;dbname=escola' , $usuari ,$contrasenya);
    $sentencia1 = $gbd -> prepare ( "SELECT count(nota) FROM cursen where codi_assignatura= :nom_assignatura and nota<5" );
    $sentencia1 -> bindParam ( ':nom_assignatura' , $nom_assignatura );
    $sentencia1->bindColumn(1, $num_susp);
    $sentencia1 -> execute ();
        if ($sentencia->fetch())
        {   
            array_push($array_assignatura, $nom_assignatura);
            echo $nom_assignatura;
            array_push($array_apro_sus, $num_apro);
            echo $num_apro;  
        }
         if ($sentencia1 -> fetch ())
        {   
          
            array_push($array_apro_sus, $num_susp);
            echo $num_susp;  
        }
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
            array_push($array_assignatura, $codi_assignatura);//Assignatures que li pasarem al imgmagiik
            echo $codi_assignatura;
            array_push($array_notes, $nota);//Notes que li pasarem al imgmagik
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
        $array_codi_curs = array();
        
            while($fila=mysqli_fetch_assoc($resultado)){
                 $filas['codi_curs'] = (int)$fila['codi_curs'];
                  $codi_curs=$filas['codi_curs'];
                   array_push($array_codi_curs, $codi_curs);//Array dels cursos que agafarem per el imgmagiic
                  echo $codi_curs." ";                                 
                 $sentencia->bind_param('s',$codi_curs);
                 $sentencia->execute();
                 $sentencia->bind_result($nota);
                 if ($sentencia->fetch())
                {
                    if($nota==null){
                      $nota=0;
                    }
                    array_push($array_notes, $nota);//Array de les mitjes que agafarem per el imgmagiic
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
   $array_codi_assignatura = array();
    
    while($fila=mysqli_fetch_assoc($resultado)){
         $filas['codi_assignatura'] = $fila['codi_assignatura'];
          $codi_assignatura=$filas['codi_assignatura'];
          array_push($array_codi_assignatura, $codi_assignatura);//Array de les assignatures que agafarem per el imgmagiic
          echo $codi_assignatura." ";                                 
         $sentencia->bind_param('s',$codi_assignatura);
         $sentencia->execute();
         $sentencia->bind_result($nota);
         if ($sentencia->fetch())
        {
            if($nota==null){
                $nota=0;
            }
            array_push($array_notes, $nota);//Array de les mitjes que agafarem per el imgmagiic
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
   $array_codi_assignatura = array();
   
    
    while($fila=mysqli_fetch_assoc($resultado)){
         $filas['codi_assignatura'] = $fila['codi_assignatura'];
          $codi_assignatura=$filas['codi_assignatura'];
          array_push($array_codi_assignatura, $codi_assignatura);//Array de les assignatures que agafarem per el imgmagiic
          echo $codi_assignatura." ";                                 
         $sentencia->bind_param('s',$codi_assignatura);
         $sentencia->execute();
         $sentencia->bind_result($num_alumne);
         if ($sentencia->fetch()){
        
            array_push($array_num_alumne, $num_alumne);//Array del numero d'alumnes que agafarem per el imgmagiic
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
    $array_codi_curs = array();
        
    while($fila=mysqli_fetch_assoc($resultado)){
         $filas['codi_curs'] = $fila['codi_curs'];
          $codi_curs=$filas['codi_curs'];
          array_push($array_codi_curs, $codi_curs);//Array dels cursos que agafarem per el imgmagiic
          echo $codi_curs." ";                                 
         $sentencia->bind_param('s',$codi_curs);
         $sentencia->execute();
         $sentencia->bind_result($num_alumne);
         if ($sentencia->fetch())
        {
            
            array_push($array_num_alumne, $num_alumne);//Array del numero d'alumnes que agafarem per el imgmagiic
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
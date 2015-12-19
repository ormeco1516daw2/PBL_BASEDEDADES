<!DOCTYPE html>
<html lang="ca">

<head>
    <title>Insercions</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <a href="principal.php">
        <input type='submit' value='Torna enrere' class='info btn-primary'><br>
    </a>
</body>

</html>

<?php
if (isset($_POST['alumne'])) {
    alumne();
} 
if (isset($_POST['assignatura'])) {
    assignatura();
}
if (isset($_POST['Elimin_Alum'])) {
    Elimin_Alum();
}
if (isset($_POST['Modifica_nota'])) {
    Modi_Nota();
}
if (isset($_POST['alta_assignatura'])) {
    alta_assignatura();
}


function alumne(){
    try{
        $mysqli = new mysqli( "localhost" , "root" , "root" , "escola");
        if ($mysqli->connect_errno) {
            echo "Falló la conexión a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        }
        // Aqui  extreurem la id del alumne pk nosaltres li posem automaticament com es un codi correlatiu agafarem el codi mes alt i tot seguit i li sumarem un per tal de la inserció sigui el nombre seguent
        $id=0;
        $resultat = $mysqli -> query("SELECT (MAX(codi_alumne)+1) as codi_maxim  from ALUMNE" );
        if($fila=$resultat->fetch_assoc()){
            $id = $fila["codi_maxim"];    
        }
        
        try {
            $gbd = new PDO ( 'mysql:host=localhost;dbname=escola' , 'root' , 'root' );
        } catch ( Exception $e ) {
            die( "problema de connexio: " . $e -> getMessage ());
        }
        
        $nom_alumne = $_POST['nom'];
        $data_naix = $_POST['data_naix'];
        $sentencia = $gbd -> prepare ( "INSERT INTO alumne (codi_alumne, nom_alumne, data_naix)
        VALUES (:id, :nom_alumne, :datanaix)");
        $sentencia -> bindParam ( ':id', $id );
        $sentencia -> bindParam ( ':nom_alumne', $nom_alumne );
        $sentencia -> bindParam ( ':datanaix', $data_naix );    
        $sentencia -> execute ();
        echo"<p>Inserció correcte</p>";
    }catch ( Exception $e ) {
      echo"No s'ha pogut insertar l'alumne!";
    }

}


function assignatura(){
    try{
        $mysqli = new mysqli( "localhost" , "root" , "root" , "escola");
        if ($mysqli->connect_errno) {
            echo "Falló la conexión a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        }
        try {
            $gbd = new PDO ( 'mysql:host=localhost;dbname=escola' , 'root' , 'root' );
        } catch ( Exception $e ) {
            die( "problema de connexio: " . $e -> getMessage ());
        }
     
        $nom_assig = $_POST['nom_assig'];
        $curs = $_POST['curs'];
        $codi_assignatura=strtoupper(substr($nom_assig,0,3))."_".$curs;
        //echo $codi_assignatura;
        $sentencia = $gbd -> prepare ( "INSERT INTO assignatura (codi_assignatura, nom_assignatura, codi_curs)
        VALUES (:codi_assignatura, :nom_assignatura, :codi_curs)");
        $sentencia -> bindParam ( ':codi_assignatura', $codi_assignatura );
        $sentencia -> bindParam ( ':nom_assignatura', $nom_assig );
        $sentencia -> bindParam ( ':codi_curs', $curs );    
        $sentencia -> execute ();
        echo"<p>Inserció correcte</p>";
    }catch ( Exception $e ) {
      echo"No s'ha pogut insertar la assignatura!";
    }
}

 function Elimin_Alum(){
    try{
         $mysqli = mysqli_connect("localhost","root","root","escola");
         $nom_alumne = $_POST['Elimina_alumne'];
         $sentencia1 = $mysqli -> prepare("SELECT codi_alumne FROM alumne where nom_alumne=?" );//ha d'estar fora                           
         $sentencia1->bind_param('s',$nom_alumne);
         $sentencia1->bind_result($codi_alumne);
         $sentencia1->execute();
         echo $codi_alumne;
             if ($sentencia1->fetch())
            {
               $codi_alumne =$codi_alumne;
               
            }
        try {
            $gbd = new PDO ( 'mysql:host=localhost;dbname=escola' , 'root' , 'root' );
        } catch ( Exception $e ) {
            die( "problema de connexio: " . $e -> getMessage ());
        }
     
        //echo $codi_assignatura;
        $sentencia = $gbd -> prepare ( "DELETE FROM alumne WHERE codi_alumne = :codi_alumne"); 
        $sentencia -> bindParam (':codi_alumne', $codi_alumne);    
        $sentencia -> execute ();
        echo"<p>Eliminació correcte</p>";
    }catch ( Exception $e ) {
      echo"No s'ha pogut eliminar l'alumne!";
    }
}

 function Modi_Nota(){
     try{
         $mysqli = mysqli_connect("localhost","root","root","escola");
         $nom_alumne = $_POST['Modifica_alum'];
         $sentencia1 = $mysqli -> prepare("SELECT codi_alumne FROM alumne where nom_alumne=?" );//ha d'estar fora                           
         $sentencia1->bind_param('s',$nom_alumne);
         $sentencia1->bind_result($codi_alumne);
         $sentencia1->execute();
         echo $codi_alumne;
             if ($sentencia1->fetch())
            {
               $codi_alumne =$codi_alumne;
               
            }
        try {
            $gbd = new PDO ( 'mysql:host=localhost;dbname=escola' , 'root' , 'root' );
        } catch ( Exception $e ) {
            die( "problema de connexio: " . $e -> getMessage ());
        }
     
        
        $assig = $_POST['Modifica_assig'];
        $nota = $_POST['nota'];
        //echo $codi_assignatura;
        $sentencia = $gbd -> prepare ( "Update cursen Set nota = :nota Where codi_alumne= :codi_alumne and codi_assignatura=:codi_assignatura");
        $sentencia -> bindParam (':nota', $nota );
        $sentencia -> bindParam (':codi_alumne', $codi_alumne);
        $sentencia -> bindParam (':codi_assignatura', $assig);    
        $sentencia -> execute ();
        echo"<p>Modificació correcte</p>";
     }catch ( Exception $e ) {
      echo"No s'ha pogut modificar la nota!";
    }

 }
function alta_assignatura(){

    try{
        $mysqli = mysqli_connect("localhost","root","root","escola");
        $nom_alumne = $_POST['nom_alta_alumne_assignatura'];
        //echo $nom_alumne;
        
        $sentencia1 = $mysqli -> prepare("SELECT codi_alumne from ALUMNE where nom_alumne=?");
        $sentencia1 -> bind_param ( 's', $nom_alumne );
        $sentencia1->bind_result($codi_alumne);
        $sentencia1-> execute ();
            if ($sentencia1->fetch())
            {   
               $codi_alumne=$codi_alumne;
            }
            //echo $codi_alumne;
        try {
                $gbd = new PDO ( 'mysql:host=localhost;dbname=escola' , 'root' , 'root' );
            } catch ( Exception $e ) {
                die( "problema de connexio: " . $e -> getMessage ());
            }
         
            
            $assig = $_POST['nom_alta_assignatura'];
            $nota = 0;
            //echo $codi_assignatura;
            $sentencia = $gbd -> prepare ( "INSERT INTO cursen (codi_assignatura, codi_alumne, nota)
        VALUES (:codi_assignatura, :codi_alumne, :nota)");
            $sentencia -> bindParam (':codi_assignatura', $assig );
            $sentencia -> bindParam (':codi_alumne', $codi_alumne);
            $sentencia -> bindParam (':nota', $nota);    
            $sentencia -> execute ();
            echo"<p>Alta correcte</p>";
    }catch ( Exception $e ) {
      echo"No s'ha pogut donar d'alta la assignatura!";
    }
}



?>
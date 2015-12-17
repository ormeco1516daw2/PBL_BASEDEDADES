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
} else if (isset($_POST['assignatura'])) {
    assignatura();
}

function alumne(){
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
}


function assignatura(){
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
}



?>
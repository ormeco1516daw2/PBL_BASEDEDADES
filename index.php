<?php
$usuari="root";
$contrasenya="root";
$gbd = new PDO ( 'mysql:host=localhost;dbname=escola' , $usuari ,
$contrasenya , array( PDO :: ATTR_PERSISTENT => true ));


$sentencia = $gbd -> prepare ( "INSERT INTO alumne (codi_alumne, nom_alumne, data_naix) VALUES (?, ?,?)" );
$sentencia -> bindParam ( 1 , $codi );
$sentencia -> bindParam ( 2 , $nom );
$sentencia -> bindParam ( 2 , $naixament );
$sentencia -> execute (); 
///////////////////////////////////////////////////Insert assignatura

$sentencia = $gbd -> prepare ( "INSERT INTO assignatura (codi_assignatura, nom_assignatura, codi_curs) VALUES (?, ?,?)" );
$sentencia -> bindParam ( 1 , $codi );
$sentencia -> bindParam ( 2 , $nom );
$sentencia -> bindParam ( 2 , $curs );
$sentencia -> execute (); 



//////////////////////////////////////////////////Botones para el index para seleccionar alumno i ver sus notas por assignatura li pasarem per post a un altre fromulari



foreach( $gbd -> query ("SELECT nom_alumne from alumne") as $fila ) {
                               echo "<option>".$fila["nom_alumne"]."</option>";
                            }


////////////////////////////////////////////////















>
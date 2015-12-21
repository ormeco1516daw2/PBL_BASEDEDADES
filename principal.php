<!DOCTYPE html>
<html lang="ca">

<head>
    <title>Practica d'Oriol, Marta, Marc</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./css/style.css">
    <script type="text/javascript" src="./js/jquery.js"></script>
    <script src="./js/AjaxAssig.js"></script>
    
</head>


<body >
    <?php
spl_autoload_register(function ($classe) {
                            include $classe . '.php';
                        });
?>
      <header>
       <h3>PBL de Oriol Mejias, Marta Grau i Marc Llobera</h3>
      </header>  
     <div id="content">
        <h2><u>Consultes dinamiques</u></h2>
        <form action='Consultas.php' method='post'><!--aqui posarem el php on enviem els parmetre seleccionat -->
            <div class="alumnes">
                <h3>Selecciona un alumne i veuras les notes de cada assignatura que cursa </h3>
                <select id="nom_alumne_assignatura" name="nom_alumne_assignatura" class="selectpicker">
                    <?php
                    //Fem un carrega amb pdo del nom dels alumnes por pder-los seleccionar y treure grafiques 
                        $usuari="root";
                        $contrasenya="root";
                        $gbd = new PDO ( 'mysql:host=localhost;dbname=escola' , $usuari ,
                        $contrasenya);                    
                        foreach( $gbd -> query ("SELECT nom_alumne from alumne") as $fila ) {
                           echo "<option>".$fila["nom_alumne"]."</option>";
                       }                                                 
                    ?>
                </select>
                
                <input id="nom_Alum_Assig" name='nom_Alum_Assig' type='submit' value='Buscar'>
            </div>
        </form><br>

        <form action='Consultas.php' method='post'><!--aqui posarem el php on enviem els parmetre seleccionat -->
            
                <h3>Selecciona una assignatura i veuras el nombre d'aprobats i els de suspesos </h3>
                <select id="nom_assignatura" name="nom_assignatura" class="selectpicker">
                    <?php
                    //Fem un carrega amb pdo del nom dels alumnes por pder-los seleccionar y treure grafiques 
                        $usuari="root";
                        $contrasenya="root";
                        $gbd = new PDO ( 'mysql:host=localhost;dbname=escola' , $usuari ,
                        $contrasenya);                    
                        foreach( $gbd -> query ("SELECT codi_assignatura from assignatura") as $fila ) {
                           echo "<option>".$fila["codi_assignatura"]."</option>";
                       }                                                 
                    ?>
                </select>
                
                <input id="Assig_AproSusp" name='Assig_AproSusp' type='submit' value='Buscar' >
            
        </form><br>



        <h2><u>Consultes estatiques</u></h2>
        <div class="consultes_estatiques">

            <form action='Consultas.php' method='post'>
                <input id="mitjaperCurs" name='mitjaperCurs' type='submit' value='Mitja Nota/Curs'>
            </form><br>
             <form action='Consultas.php' method='post'>
                <input id="mitjaperAssignatura" name='mitjaperAssignatura' type='submit' value='Mitja Nota/Assignatura'>
            </form><br>
            <form action='Consultas.php' method='post'>
                <input id="numAlumnesAssignatura" name='numAlumnesAssignatura' type='submit' value='Num Alumne/Assignatura'>
            </form><br>
            <form action='Consultas.php' method='post'>
                <input id="numAlumnesCurs" name='numAlumnesCurs' type='submit' value='Num Alumne/Curs'>
            </form><br>
        </div>
        <form action='insertar.php' method='post'><!--php  per inserir    -->
            <div class="inserts">
                <h3>Insereix alumnes</h3> 
                Nom del alumne:<br>
                <input id="nom" name="nom" type='text'><br>
                Data naixament:<br>
                <input id="data_naix" name="data_naix"  type='date'>
               <!-- Assignatura que cursa(Introdueix una assignatura despres podras introduir mes assignatures):<br>
                <input id="assignatura" type='date'  class='btn btn-primary'>
                Nota de l'assignatura:<br>
                <input id="nota" type='date'  class='btn btn-primary'> -->
                <input id="alumne" name='alumne' type='submit' value='Insertar'>
            </div>
        </form>
         <form action='insertar.php' method='post'><!--php  per inserir    -->
            <div class="inserts">
                <h3>Dona d'alta un alumne en una assignatura</h3> 
                Nom del alumne:<br>
                <select id="nom_alta_alumne_assignatura" name="nom_alta_alumne_assignatura" class="selectpicker">
                    <?php
                    //Fem un carrega amb pdo del nom dels alumnes por pder-los seleccionar y treure grafiques 
                        $usuari="root";
                        $contrasenya="root";
                        $gbd = new PDO ( 'mysql:host=localhost;dbname=escola' , $usuari ,
                        $contrasenya);                    
                        foreach( $gbd -> query ("SELECT nom_alumne from alumne") as $fila ) {
                           echo "<option>".$fila["nom_alumne"]."</option>";
                       }                                                 
                    ?>
                </select><br>
                Assignatura:<br>
                <select id="nom_alta_assignatura" name="nom_alta_assignatura" class="selectpicker">
                    <?php
                    //Fem un carrega amb pdo del nom dels alumnes por pder-los seleccionar y treure grafiques 
                        $usuari="root";
                        $contrasenya="root";
                        $gbd = new PDO ( 'mysql:host=localhost;dbname=escola' , $usuari ,
                        $contrasenya);                    
                        foreach( $gbd -> query ("SELECT codi_assignatura from assignatura") as $fila ) {
                           echo "<option>".$fila["codi_assignatura"]."</option>";
                       }                                                 
                    ?>
                </select>
                
                <input id="alta_assignatura" name='alta_assignatura' type='submit' value='Alta'>
            </div>
        </form>
        <form action='insertar.php' method='post'><!--php  per inserir    -->
            <div class="inserts">
                <h3>Insereix assignatura</h3> 
                Nom assignatura:<br>
                <input id="nom_assig" name="nom_assig" type='text'><br>
                Curs on es realitza<br>
                <input id="curs" name="curs" type='number' min="1" max="6"><br>              
                <input id="assignatura" name='assignatura' type='submit' value='Insertar'>
            </div>
        </form>
        <form action='insertar.php' method='post'><!--aqui posarem el php on enviem els parmetre seleccionat -->
            <div class="alumnes">
                <h3>Selecciona un alumne per eliminar-lo  </h3>
                <select id="Elimina_alumne" name="Elimina_alumne" class="selectpicker">
                    <?php
                    //Fem un carrega amb pdo del nom dels alumnes por pder-los seleccionar y treure grafiques 
                        $usuari="root";
                        $contrasenya="root";
                        $gbd = new PDO ( 'mysql:host=localhost;dbname=escola' , $usuari ,
                        $contrasenya);                    
                        foreach( $gbd -> query ("SELECT nom_alumne from alumne") as $fila ) {
                           echo "<option>".$fila["nom_alumne"]."</option>";
                       }                                                 
                    ?>
                </select>
                
                <input id="Elimin_Alum" name='Elimin_Alum' type='submit' value='Eliminar'>
            </div>
        </form><br>

         <form action='insertar.php' method='post'><!--aqui posarem el php on enviem els parmetre seleccionat -->
            <div class="alumnes">
                <h3>Selecciona un alumne i una assignatura per modificar una nota </h3>
                <select id="Modifica_alum" name="Modifica_alum" class="selectpicker">
                    <?php
                     $usuari="root";
                        $contrasenya="root";
                        $gbd = new PDO ( 'mysql:host=localhost;dbname=escola' , $usuari ,
                        $contrasenya);                    
                        foreach( $gbd -> query ("SELECT nom_alumne from alumne") as $fila ) {
                           echo "<option>".$fila["nom_alumne"]."</option>";
                       }                                                 
                    ?>
                </select>
                
                <select id="Modifica_assig" name="Modifica_assig" class="selectpicker">
                    <!--<?php
                    // $usuari="root";
                      //  $contrasenya="root";
                        //$gbd = new PDO ( 'mysql:host=localhost;dbname=escola' , $usuari ,
                       // $contrasenya);                    
                        //foreach( $gbd -> query ("SELECT codi_assignatura from assignatura") as $fila ) {
                        //   echo "<option>".$fila["codi_assignatura"]."</option>";
                     //  }                                                 
                    ?>-->
                </select>
                <input id="nota" name="nota" type='number' min="0" max="10"><br>
                <input id="Modifica_nota" name='Modifica_nota' type='submit' value='Modificar' >
            </div>
        </form><br>
    </div>

       
</body>

</html>
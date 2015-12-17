<!DOCTYPE html>
<html lang="ca">

<head>
    <title>Practica d'Oriol, Marta, Marc</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./css/style.css">
</head>


<body>
    <?php
spl_autoload_register(function ($classe) {
                            include $classe . '.php';
                        });
?>
      <header>
       <h3>PBL de Oriol Mejias, Marta Grau i Marc Llobera</h3>
      </header>  
     <div id="content">
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
                <br>
                <br>
                <br>
                <input id="nom_Alum_Assig" name='nom_Alum_Assig' type='submit' value='Buscar' class='btn btn-primary'>
            </div>
        </form><br>
        <h3>Consultes estatiques</h3>
        <div class="consultes_estatiques">

            <form action='Consultas.php' method='post'>
                <input id="mitjaperCurs" name='mitjaperCurs' type='submit' value='Mitja Nota/Curs' class='btn btn-primary'>
            </form><br>
             <form action='Consultas.php' method='post'>
                <input id="mitjaperAssignatura" name='mitjaperAssignatura' type='submit' value='Mitja Nota/Assignatura' class='btn btn-primary'>
            </form><br>
            <form action='Consultas.php' method='post'>
                <input id="numAlumnesAssignatura" name='numAlumnesAssignatura' type='submit' value='Num Alumne/Assignatura' class='btn btn-primary'>
            </form><br>
            <form action='Consultas.php' method='post'>
                <input id="numAlumnesCurs" name='numAlumnesCurs' type='submit' value='Num Alumne/Curs' class='btn btn-primary'>
            </form><br>
        </div>
        <form action='insertar.php' method='post'><!--php  per inserir    -->
            <div class="inserts">
                <h3>Insereix alumnes</h3> 
                Nom del alumne:<br>
                <input id="nom" name="nom" type='text'  class='btn btn-primary'><br>
                Data naixament:<br>
                <input id="data_naix" name="data_naix"  type='date'  class='btn btn-primary'>
               <!-- Assignatura que cursa(Introdueix una assignatura despres podras introduir mes assignatures):<br>
                <input id="assignatura" type='date'  class='btn btn-primary'>
                Nota de l'assignatura:<br>
                <input id="nota" type='date'  class='btn btn-primary'> -->
                <input id="alumne" name='alumne' type='submit' value='Insertar' class='btn btn-primary'>
            </div>
        </form>
        <form action='insertar.php' method='post'><!--php  per inserir    -->
            <div class="inserts">
                <h3>Insereix assignatura</h3> 
                Nom assignatura:<br>
                <input id="nom_assig" name="nom_assig" type='text'  class='btn btn-primary'><br>
                Curs on es realitza<br>
                <input id="curs" name="curs" type='number' min="1" max="6"  class='btn btn-primary'><br>              
                <input id="assignatura" name='assignatura' type='submit' value='Insertar' class='btn btn-primary'>
            </div>
        </form>
    </div>

       
</body>

</html>
<?php
require_once 'clases/conexion/Conexion.php';
require_once 'clases/modelo/Noticia.php';
$arrNoticias = [];
$lista = new ListaNoticias();
$num = new Conexion();
$noticias = $lista->listarNoticias();

if (isset($_POST) && !empty($_POST)) {

    if (!empty($_POST['noticias'])) {
       
        foreach ($_POST['noticias'] as $selected) {
            array_push($arrNoticias, $selected);
        }
    }
    $lista->descarga($arrNoticias, $_POST);
    
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "includes/head.php" ?>

</head>

<body>
    <?php include "includes/nav.php" ?>
    <div class="container">
        <table class='main-container table table-bordered'>
            <thead>
                <tr>
                    <th class="container">Epigrafe</th>
                    <th>Categoria</th>
                    <th>Seleccionar</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>      
    <?php echo $noticias ?>    

        </table>
        <form method="POST" class="contact100-form validate-form">
  
<div class=" container ">
<div class=" row">
    <div class="col-2">
       <input class=" btn btn-primary input100" type="submit" name="json" value=".JSON">
    </div>
    <div class="col-2 ">
       <input class=" btn btn-danger input100" type="submit" name="xml" value=".XML">
    </div>
  </div>
  </div>
        </form>


        <br>
        <br>
    </div>

</body>

</html>
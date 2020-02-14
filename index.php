<?php
require_once 'clases/conexion/Conexion.php';
require_once 'clases/modelo/Noticia.php';
$id = "";
$noticia = new Noticia();

if (isset($_GET['id']) && !empty($_GET['id'])) {  
     $id = $_GET['id'];   
    $noticia = Conexion::obtenerID($id);
    
    if (isset($_POST) && !empty($_POST)) {  
         Conexion::update($noticia, $_POST);
        header("Location: noticias.php");
    }
} else {
    if (isset($_POST) && !empty($_POST)) {
           $new = new Noticia(
            $_POST['epi'],
            $_POST['titulo'],
            $_POST['subtitulo'],
            $_POST['tipo'],
            $_POST['body']
          
        );
        $new->insertar();
    }
}

$lista = new ListaNoticias();
$num = new Conexion();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "includes/head.php" ?>
</head>

<body>
    <?php include "includes/nav.php" ?>
    <!--================================================================================== -->

    <div class="container-contact100">
        <div class="wrap-contact100">
            <form method="POST" class="contact100-form validate-form">
                <span class="contact100-form-title">Newsletter</span>
                <div class="wrap-input100 validate-input bg1" data-validate="Please Type Your Name">
                    <span class="label-input100">Epigrafe*</span>
                    <input class="input100" type="text" name="epi" placeholder="Epígrafe o Antetitulo" value=" <?php echo $noticia->getEpi() ?> ">
                </div>


                <div class="wrap-input100 validate-input bg1 rs1-wrap-input100" data-validate="Tiuto (e@a.x)">
                    <span class="label-input100">Titular *</span>
                    <input class="input100" type="text" name="titulo" placeholder="Tiuto " value=" <?php echo $noticia->getTitulo() ?>">
                </div>

                <div class="wrap-input100 bg1 rs1-wrap-input100">
                    <span class="label-input100">Subtitulo</span>
                    <input class="input100" type="text" name="subtitulo" placeholder="Enter subtitulo"  value=" <?php echo $noticia->getSubtitulo() ?>">
                </div>


                <div class="wrap-input100 input100-select bg1">
                    <span class="label-input100">Seleccione el tipo de descarga *</span>
                    <div>
                        <select class="js-select2" name="tipo">
                            <option value="Deportes">Deportes</option>
                            <option value="Farandula">Farandula</option>
                        </select>
                        <div class="dropDownSelect2"></div>
                    </div>
                </div>
                <div class="wrap-input100 validate-input bg0 rs1-alert-validate" data-validate="Please Type Your Message">
                    <span class="label-input100"></span>
                    <textarea class="input100" name="body" placeholder="Your message here..."> <?php echo  $noticia->getBody(); ?>"</textarea>
                </div>

                <div class="container-contact100-form-btn">
                    <input type="submit" value="enviar" class="contact100-form-btn">
                </div>
            </form>
        </div>
    </div>


    <!--===============================================================================================-->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
    <script>
        $(".js-select2").each(function() {
            $(this).select2({
                minimumResultsForSearch: 20,
                dropdownParent: $(this).next('.dropDownSelect2')
            });


            $(".js-select2").each(function() {
                $(this).on('select2:close', function(e) {
                    if ($(this).val() == "Please chooses") {
                        $('.js-show-service').slideUp();
                    } else {
                        $('.js-show-service').slideUp();
                        $('.js-show-service').slideDown();
                    }
                });
            });
        })
    </script>
    <!--===============================================================================================-->
    <script src="vendor/daterangepicker/moment.min.js"></script>
    <script src="vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/noui/nouislider.min.js"></script>
    <script>
        var filterBar = document.getElementById('filter-bar');

        noUiSlider.create(filterBar, {
            start: [1500, 3900],
            connect: true,
            range: {
                'min': 1500,
                'max': 7500
            }
        });

        var skipValues = [
            document.getElementById('value-lower'),
            document.getElementById('value-upper')
        ];

        filterBar.noUiSlider.on('update', function(values, handle) {
            skipValues[handle].innerHTML = Math.round(values[handle]);
            $('.contact100-form-range-value input[name="from-value"]').val($('#value-lower').html());
            $('.contact100-form-range-value input[name="to-value"]').val($('#value-upper').html());
        });
    </script>
    <!--===============================================================================================-->
    <script src="js/main.js"></script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-23581568-13');
    </script>

</body>

</html>
<!--=============NAV================================================================================-->

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="#">
    
    </a>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link label-input100" href="prueba.php">Home<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link label-input100" href="#">Contacto</a>
      </li>

 <li class="nav-item">
        <a class="nav-link label-input100" href="noticias.php"> Mis Noticias (<?=$num->numeroNoticias();?>)</a>
      </li>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item label-input100" href="index.php?tipo=1">.XML</a>
        <div class="dropdown-divider"></div>
          <a class="dropdown-item label-input100" href="index.php?tipo=2">.JSON</a>

        </div>
      </li>
    </ul>
   
  </div>
</nav>
<!--===============================================================================================-->

<!--Home.php--> 
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel='stylesheet' href='http://<?=URLSERVIDOR?>/css/bootstrap.css'>
    <!-- link para los iconos GALERIA: https://fontawesome.com/icons?d=gallery -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <title>Mi Amigo Invisible!</title>
  </head>

  <body>
    <header>
      <div class="row">
        
        <div class="col-2">
          <img src='http://<?=URLSERVIDOR?>/multimedia/logo.jpg' class="img-fluid" alt="Responsive image">
        </div>

        <div class="col-8">
            <br>
            <h1 class="text-center">Mi Amigo Invisible</h1>
        </div>

        <div id="DivLogOut" class="col-2 container">
          <div class="row">
            <div class="col text-center">
              <?php 
                if (isset($_SESSION['Usuario'])&&($_SESSION['Usuario']!="")){
              ?>
                  <label class="text-center">Bienvenido Usuario<br/><?php echo $_SESSION['Usuario'] ?></label>
                  <form method="POST" action="?">
                    <input class="btn btn-primary btn-sm" id='inpLogin2' type="submit" name="logout" value="LogOut" >
                  </form>
              <?php    
                }else{
              ?>
                  <br><br>
                  <input class="btn btn-primary btn-sm" id='inpLogin2' type="button" value="LogIn" onclick="location.href='http://<?=URLSERVIDOR?>/index.php/login'">
              <?php
                }
              ?>
            </div>
          </div>
        </div>
      </div>
      <!--barra navegacion superios--> 
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="col-2"></div>
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">HOME <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href='http://<?=URLSERVIDOR?>/index.php/Registro'>NUEVO USUARIO </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                QUIENES SOMOS
              </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="#">EMPRESA</a>
                  <a class="dropdown-item" href="#">EVENTOS</a>
                  <a class="dropdown-item" href="#">NOVEDADES</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
            </li>
          </ul>
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
        </div>
      </nav>
    </header>
    <!---------------seccion cuerpo de trabajo---------------------------------------->
    <div class="text-center">
      <h1><?php echo $datos['titulo'];?></h1><hr/>
      <section id="homeSection">
      <?php
        if ($valor!=""){
      ?> 
          <div class="row">
            <div class="col-3"></div>
            <div class="alert alert-danger col-6 " role="alert">
              <h3><?php echo $valor?></h3>
            </div>
            <div class="col-3"></div>
          </div>
      <?php
        }
      ?>    
        <div class="container-logeo">
          <h1><?php echo $datos['titulo'];?></h1><hr/>
          <div class="row">
            <div class="container" id="formContainer">
              <form method="POST" action="?" class="form-signin" id="login" role="form">
                <h3 class="form-signin-heading">Identifiquese, por favor.</h3>
                <a href="#" id="flipToRecover" class="flipLink">
                  <div id="triangle-topright"></div>
                </a>
                <input class="form-control" id="usuario" type="text" name="usuario" placeholder="Usuario" required autofocus>
                <input id="contrasena" class="form-control" type="password" name="contrasena" placeholder="Contraseña" required>
                <br>
                <input   class="btn btn-lg btn-primary btn-block" type="submit" name="Login" value="Log-In">
              </form>
              <br>
              <form class="form-signin" id="recover" role="form">
                <button class="btn btn-lg btn-primary btn-block" type="submit">Recover password</button>
              </form>
            </div> <!-- /formcontainer -->
          </div>
        </section>
      </div>
    </div>
    <!---------------seccion cuerpo de trabajo---------------------------------------->
    
    <!-- Footer -->
<footer class="page-footer font-small mdb-color pt-4">
<!-- Footer Links -->
  <div class="container text-center text-md-left">

    <!-- Footer links -->
    <div class="row text-center text-md-left mt-3 pb-3">
      <!-- Grid column -->
      <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
        <h6 class="text-uppercase mb-4 font-weight-bold">Company name</h6>
        <p>Este Proyecto ha sido creado para entrega final de curso.<br>
        Con una calificación de sobresaliente, antes de la incorporación 
        de diseño con Bootstrap.</p>
      </div>
      <!-- Grid column -->
  
      <!-- Grid column -->
      <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
        <h6 class="text-uppercase mb-4 font-weight-bold">Lenguajes Utilizados</h6>
        <p>
          <a href="#!">MDBootstrap</a>
          <br>
          <a href="#!">PHP</a>
          <br>
          <a href="#!">JQuery</a>
          <br>
          <a href="#!">Html5</a>
        </p>
      </div>
      <!-- Grid column -->


      <!-- Grid column -->
      <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
        <h6 class="text-uppercase mb-4 font-weight-bold">Contacto</h6>
        <p>
          <i class="fas fa-home mr-3"></i> Bilbao, Bizkaia
          <br>
          <a href="mailto:HidalgoJ.Ignacio@gmail.com"> <i class="fas fa-envelope mr-3"></i> HidalgoJ.Ignacio@gmail.com</a>
          <br>
          <i class="fas fa-phone mr-3"></i> + 34 609 100 721
          <!--
          <br>
          <i class="fas fa-print mr-3"></i> + 01 234 567 89-->
          </p>
    </div>
  </div>
  <!-- Footer links -->

  <hr>

  <!-- Grid row -->
  <div class="row d-flex align-items-center">
    <!-- Grid column -->
    <div class="col-md-7 col-lg-8">
      <!--Copyright-->
      <p class="text-center text-md-left">© 2018 Copyright:
          <strong>Jose Ignacio Hidalgo</strong>
        </a>
      </p>
    </div>
    <!-- Grid column -->

    <!-- Grid column -->
    <div class="col-md-5 col-lg-4 ml-lg-0">
      <!-- Social buttons -->
      <div class="text-center text-md-right">
        <ul class="list-unstyled list-inline">
          <li class="list-inline-item">
            <a class="btn-floating btn-sm rgba-white-slight mx-1">
              <i class="fab fa-facebook-f"></i>
            </a>
          </li>
          <li class="list-inline-item">
            <a class="btn-floating btn-sm rgba-white-slight mx-1">
              <i class="fab fa-twitter"></i>
            </a>
          </li>
          <li class="list-inline-item">
            <a class="btn-floating btn-sm rgba-white-slight mx-1">
              <i class="fab fa-google-plus-g"></i>
            </a>
          </li>
          <li class="list-inline-item">
            <a class="btn-floating btn-sm rgba-white-slight mx-1">
              <i class="fab fa-linkedin-in"></i>
            </a>
          </li>
        </ul>
      </div>

    </div>
    <!-- Grid column -->
  </div>
  <!-- Grid row -->
</div>
<!-- Footer Links -->
</footer>
<!-- Footer -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src='http://<?=URLSERVIDOR?>/js/bootstrap.min.js' integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript" src='http://<?=URLSERVIDOR?>/js/main.js'></script>
  </body>
</html>
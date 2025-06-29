<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('icona.ico') }}">
    @yield('header')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  </head>
  <body style="background-color: rgba(0, 0, 0, 0.05);">
    <style>
      .btn-floating:hover{
        background-color: rgba(0, 0, 0, 0.05);
        border-radius: 110%;
      }
      .bi-envelope-top{
          opacity: 0;
          transition: 0.3s;
      }
      .btn-secondary:hover .bi-envelope-top{
        opacity: 1;
        transition: 0.3s;
      }
      .card{
        margin: 2%;
      }
      .card:hover{
        margin: 2%;
        border-color: white;
      }
    </style>
    <nav class="navbar navbar-dark navbar-expand-lg bg-dark" style="z-index: 9999; position:fixed;width: 100%;top: 0%;">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="{{ request()->is('/') ? 'active nav-link' : 'nav-link' }}" aria-current="page" href="/">HOME</a>
            </li>
            <li class="nav-item">
              <a class="{{ request()->is('chisiamo') ? 'active nav-link' : 'nav-link' }}" aria-current="page" href="/chisiamo">CHI SIAMO</a>
            </li>
            <li class="nav-item">
              <a class="{{ request()->is('progetti') ? 'active nav-link' : 'nav-link' }}" aria-current="page" href="/progetti">PROGETTI</a>
            </li>
            <li class="nav-item">
              <a class="{{ request()->is('pubblicazioni') ? 'active nav-link' : 'nav-link' }}" aria-current="page" href="/pubblicazioni">PUBBLICAZIONI</a>
            </li>
            <li class="nav-item">
              <a class="{{ request()->is('corsi') ? 'active nav-link' : 'nav-link' }}" aria-current="page" href="/corsi">CORSI</a>
            </li>
            @role('admin')
                <li class="nav-item">
                <a class="{{ request()->is('admin') ? 'active nav-link' : 'nav-link' }}" aria-current="page" href="{{ route('admin.users.index') }}">ADMIN</a>
                </li>
            @endrole
          </ul>
          <ul class="navbar-nav ml-auto">
            @guest
                <li class="nav-item">
                    <a class="{{ request()->is('login') ? 'active nav-link bi-box-arrow-in-right' : 'nav-link bi-box-arrow-in-right' }}" href="/login">&nbsp;Log in</a>
                </li>
                <li class="nav-item">
                    <a class="{{ request()->is('register') ? 'active nav-link bi-person-circle' : 'nav-link bi-person-circle' }}" href="/register">&nbsp;Register</a>
                </li>
            @endguest
            @auth
                <div class="dropdown">
                  <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <strong>{{ auth()->user()->email }}</strong>
                  </a>
                  <a class="text-white text-decoration-none text-center" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ auth()->user()->getRoleNames() }}
                  </a>
                  <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                    <form action="/account" class="d-flex justify-content-center pt-3">
                      <li><button type="submit" class="btn btn-secondary" style="background-color:#343a40;border:none">Account</button></li>
                    </form>
                    <form method="POST" action="/logout" class="d-flex justify-content-center pt-3">
                      @csrf
                      <li><button type="submit" class="btn btn-secondary" style="background-color:#343a40;border:none">Sign out</button></li>
                    </form>
                  </ul>
                </div>
                
            @endauth
          </ul>
        </div>
    </div>
</nav>

    @yield('main')
    <!--CONTATTI-->
      <div class="container-fluid bg-dark text-center" id="contatti" style="top: 0px;">
        <br><br>
        <div style="color: aliceblue;">
          <h2>CONTATTI</h2>
          <p><i>Qui trovi i nostri contatti!</i></p><br><br><br>
          <div style="margin:0 auto;display: flex; justify-content: center;align-items: center;">
              <div style="float:left;width: 40%;text-align: center;margin-right: 10%;"><i class="bi bi-map"></i><br>Brescia</div>
              <div style="float:left;width: 40%;text-align: center;margin-left: 10%;"><i class="bi bi-phone"></i><br>Tel: 333 333 3333</div>
          </div>
          <div style="margin:0 auto;display: flex; justify-content: center;align-items: center;">
            <div style="float:left;width: 33%;text-align: center;"><i class="bi bi-envelope" ></i><br>gruppodiricerca@gmail.com<br><br><br></div>
          </div>
        </div>
      </div>

      <footer class="text-center bg-body-tertiary">
        <!-- Grid container -->
        <div class="container pt-4">
          <!-- Section: Social media -->
          <section class="mb-4">
            <a class="btn btn-link btn-floating btn-lg text-body m-1" href="#!"><i class="bi bi-facebook"></i></a>
            <a class="btn btn-link btn-floating btn-lg text-body m-1" href="#!"><i class="bi bi-twitter"></i></a>
            <a class="btn btn-link btn-floating btn-lg text-body m-1" href="#!"><i class="bi bi-google"></i></a>
            <a class="btn btn-link btn-floating btn-lg text-body m-1" href="#!"><i class="bi bi-instagram"></i></a>
            <a class="btn btn-link btn-floating btn-lg text-body m-1" href="#!"><i class="bi bi-linkedin"></i></a>
            <a class="btn btn-link btn-floating btn-lg text-body m-1" href="#!"><i class="bi bi-github"></i></a>
          </section>
          <!-- Section: Social media -->
        </div>
        <!-- Grid container -->
      
        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
          Copyright &copy; Gruppo Di Ricerca 2025
        </div>
        <!-- Copyright -->
      </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var alertList = document.querySelectorAll('.alert');
        alertList.forEach(function (alert) {
          new bootstrap.Alert(alert);
        });
    </script>
  </body>
</html>
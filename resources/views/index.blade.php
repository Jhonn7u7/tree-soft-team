<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="bootstrap.min.css" rel="stylesheet" >
    <link href="{{ asset('css/app.css') }}" >
    
    <title>Autores</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Biblioteca Admin</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Autores</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Libros</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Prestamos</a>
        </li>
      </ul>
      <form class="d-flex d-grid gap-2 d-md-block">
        <a class="btn  btn-outline-primary  " href="#">Registrarse</a>
        <a class="btn  btn-outline-primary " href="#">Iniciar Seccion</a>
      </form>
    </div>
  </div>
</nav>
<br>
<br>
<section class="intro" id="app">
    <authors-container v-slot="{ data }">
      <div class="row">
        <div class="col-12">
          <table-component  :headings="['Nombre', 'Apellido', 'Lugar', 'Creado', 'Actualizado']" :contents="data.autores" />
        </div>
      </div>
    </authors-container>
  </section>
</div>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
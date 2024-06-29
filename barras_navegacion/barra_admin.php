<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-success">
  <div class="container-fluid d-flex justify-content-between">
    <div class="my-class-left">
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Gestionar</a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item" href="javascript:Refrescar('formularios/add_universidades.html','areaprincipal')">Gestionar universidades</a></li>
              <li><a class="dropdown-item" href="#">Gestionar rectores</a></li>
              <li><a class="dropdown-item" href="#">Otros</a></li>
            </ul>
          </li>
        </ul>
      </div>
      </div>
    <div class="my-class-right">
      <?PHP
        if (isset($_GET['Accion'])){
            if ($_GET['Accion']==1){
                  echo "<a class='nav-link active' href='index.php?Accion=1&Mostrar=1'>Entrar</a>";
            }else{
                  echo "<a class='nav-link active' href='index.php?'>Salir</a>";
            }
        }else{
                echo "<a class='nav-link active' href='index.php?Accion=1&Mostrar=1'>Entrar</a>";
        }
      ?>
    </div>
  </div>
</nav>
<script src="bootstrap.bundle.min.js"></script>
<script src="script.js"></script>
</body>
</html>
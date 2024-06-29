<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/misestilos.css"> -->
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-success">
  <div class="container-fluid d-flex justify-content-between">
    <div class="my-class-left">
      <a class="navbar-brand" href="index.php">Home</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        
      </div>
    </div>
    <div class="my-class-right">
    <div class="navbar-nav">
        <?PHP
          	if (isset($_GET['Accion'])){
              if ($_GET['Accion']==1){
                echo "<a class='nav-link active' href='index.php?Accion=1&Mostrar=1'>Entrar</a>";
              }else{
                echo "<a class='nav-link active' href='index.php?Accion=1&Mostrar=0'>Salir</a>";
              }
            }else{
              echo "<a class='nav-link active' href='index.php?Accion=1&Mostrar=1'>Entrar</a>";
            }
        ?>
      </div>
    </div>
  </div>
</nav>	
</body>
</html>
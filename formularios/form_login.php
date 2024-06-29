<?php
    include_once("include.php");
    include_once($PATH."/libreria.php");
?>
<!DOCTYPE HTML>
<html>
    <title></title>
    <head>
    <link rel="stylesheet" href="/titulacion/css/bootstrap.min.css">
    </head>
    <body>
      <script type="text/JavaScript">
        function BorrarContainer() {
          //document.getElementById("Contenedor1").InnerHTML=""
        }
          function Mandar(){
            document.form1.submit()
            //document.form1.reset()
          }
      </script>
      
      <?php
       function ImprimeFormulario(){ //Funciona para imprimir el formulario
              echo "<div class='container' id='LoginForm'>";
                echo "<form class='form-floating' name='form1' method='post' action='portero.php'>";
                  echo "<div class='row'>";
                      echo "<div class='col'>";
                        echo "<div class='mb-1'>";
                          echo "<input class='form_control' name='cuenta' type='text' id='cuenta' default mb-1>";
                        echo "</div>";
                      echo "</div>";
                  echo "</div>";
                  echo "<div class='row'>";
                      echo "<div class='col'>";
                        echo "<div class='mb-1'>";
                          echo "<input class='form_control' name='contrasena' type='password' id='contrasena'>"; 
                        echo "</div>";
                      echo "</div>";
                  echo "</div>";
                  echo "<div class='row'>";
                      echo "<div class='col'>";
                        echo "<div class='mb-1'>";
                          echo "<input class='btn btn-success' type='Button' name='Submit' value='Enviar' onClick='Mandar()'>";
                          echo "<input class='btn btn-danger' type='reset' name='Submit2' value='Cancelar'>";
                        echo "</div>";
                      echo "</div>";
                  echo "</div>";
                echo "</form>";
              echo "</div>";
       }
       //session_start(['suario']);
      //  if (isset($_SESSION['usuario']['cuenta'])) {
      //     echo $_SESSION['usuario']['cuenta'];
      //     header("Location: form_login.php");
      //  }else{
        if (isset($_GET['Fallo'])){
          echo "Datos incorrectos. Intente de nuevo...";
        };
      ImprimeFormulario();
      //  }
    ?>
    </body>
</html>
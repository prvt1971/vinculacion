$(function() {
  console.log("Trabajando1");
 $('#capa-login').hide(); //Ocultar el pànel de login
 $('#capa-datos').hide(); //Ocultar el pànel de datos

//Para capturar y realizar acción cuando se da Submit al formulario añadir universidades
 $('#form-addUni').submit(function(e){
  e.preventDefault();
  console.log("kkkkkkkkk");
   
 }); 
 
 //Para capturar y realizar acción cuando se da clic en Entrar
  $(document).on('click','.click-texto',function(e){
    e.preventDefault();
    $('#capa-datos').hide();
    if ($('#accion')[0].innerHTML == 'Salir'){
      $('#accion')[0].innerHTML = "Entrar"
      $('#capa-login').hide();
      haceBarra(0);
    }else{
      $('#accion').hide();
      $('#form-login').trigger('reset'); //Para limpiar todos los campos del formulario despues de enviar los datos
      $('#capa-login').show();
    }
    
  })

  //Para capturar y realizar acción cuando se da clic en las opciones de la barra de manú
  $(document).on('click','.click-menu',function(e){
    e.preventDefault();
    archivo = this.getAttribute("marca");
    Refrescar(archivo,'areaprincipal')
  })

    //Para capturar y realizar acción cuando se da Submit al formulario del login
  $('#form-login').submit(function(e){
     e.preventDefault();
     let usuario = $('#usuario').val();
     let clave = $('#clave').val();
     let dato = { usuario,clave }
     let plantilla = '';
     let rolid = 0;
     $.post('portero.php',dato,function(respuesta){
        let plantilla = '';
        //console.log(respuesta);
        resultados = JSON.parse(respuesta) 
        resultados.forEach(element => { //Recorrer todos los elementos del objeto
            plantilla += `<center>${element.nombres} ${element.apellidos}<br>
            <img style='max-width:100px;' name='logotipo' id='logotipo' src='imagenes/fotos_usuarios/${element.foto}' alt = 'Salir'><br>
            ${element.rol}</center>
            `
            let rolid = element.rolid;
            haceBarra(rolid); //Para construir la barra de menú para cada tipod e usuario
        });
         
        if (resultados != ""){ //Sucede cuando las credenciales son correctas
          $('#card-nombre').html(plantilla);
          $('#capa-login').hide();
          $('#capa-datos').show();
          $('#accion')[0].innerHTML="Salir";
          $('#accion').show();
        }else{ //Sucede cuando las credenciales son incorrectas
          $('#form-login').trigger('reset'); //Para limpiar todos los campos del formulario despues de enviar los datos
          $('#mensaje').html("<b>Datos incorrectos ...</b>");
        }
      
    });

    

  })

  
  

  function haceBarra(rolid){
    let dato = { rolid }
    if (rolid !=0) {  //Para personalizar la opcion, Entrar/Salir
        etiquetaTemporal = 'Salir';
    }else{
      etiquetaTemporal = 'Entrar';
    }

    $.post('make_barra.php',dato,function(respuesta){
      let plantilla = `<nav class="navbar navbar-expand-lg navbar-dark bg-success">
      <div class="container-fluid d-flex justify-content-between">
        <div class="my-class-left">
          <!-- <a class="navbar-brand" href="#"></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button> -->
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Casa</a>
              </li>
              <li class="nav-item dropdown">
      `
        resultados = JSON.parse(respuesta) 
        if (resultados.length>1){ //Construyo las opciones desplegables si hay un usuario logueado
          let funcionVieja = ""
          resultados.forEach(element => { //Recorrer todos los elementos del objeto
              let funcionNueva = element.funcion;
              let accionNueva =  element.accion;
              if (funcionNueva != funcionVieja){
                if (funcionVieja != ""){
                  plantilla += `</ul>
                  </li>
                  <li class="nav-item dropdown">
                  `; 
                  
                }
                funcionVieja = funcionNueva
                plantilla += `<a class='nav-link dropdown-toggle' href='#' id='navbarDropdownMenuLink' role='button' data-bs-toggle='dropdown' 
                aria-expanded='false'>${funcionVieja}</a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                `
              }
                plantilla += `<li><a marca='${element.codigo}' class='dropdown-item click-menu' href='#'>${accionNueva}</a></li>`
               
          }) 
        }
        
        plantilla += `
              </ul>
              
            </ul>
          </div>
          </div>
          <div class="my-class-right">
          <div class="navbar-nav">
            <a name='Entrar' class='click-texto nav-link active' id='accion'  href='#'>${etiquetaTemporal}</a>
          </div>
          </div>
        </div>
      </div>
      </div>
    </nav>
            `
        $('#BarraPrincipal').html(plantilla); 
    })
  }

    //Para evitar que se reacrgue la página
  window.addEventListener("beforeunload", (evento) => {
    if (true) {
        evento.preventDefault();
        evento.returnValue = "";
        return "";
    }
});


});



function registraUniversidad(){
  console.log($('#form-addUni'));
  //console.log($('#uninombre').val());
}


function Refrescar(archivo,contenedor){
  fetch(archivo)
  .then(response => response.text())
  .then(data => {
    document.getElementById(contenedor).innerHTML = data;
  });
}
// $imagenPrevisualizacion = document.querySelector("#logotipo");
// // Obtener referencia al input y a la imagen
	
// const $seleccionArchivos = document.querySelector("#logofile"),

// // Escuchar cuando cambie
// $seleccionArchivos.addEventListener("change", () => {
//   // Los archivos seleccionados, pueden ser muchos o uno
//   const archivos = $seleccionArchivos.files;
//   // Si no hay archivos salimos de la función y quitamos la imagen
//   if (!archivos || !archivos.length) {
//     $imagenPrevisualizacion.src = "";
//     return;
//   }
//   // Ahora tomamos el primer archivo, el cual vamos a previsualizar
//   const primerArchivo = archivos[0];
//   // Lo convertimos a un objeto de tipo objectURL
//   const objectURL = URL.createObjectURL(primerArchivo);
//   // Y a la fuente de la imagen le ponemos el objectURL
//   $imagenPrevisualizacion.src = objectURL;
//   window.alert("cambie");
// });

function actualizaImagen(){
  $imagenPrevisualizacion = document.querySelector("#logotipo");
// Obtener referencia al input y a la imagen
	
$seleccionArchivos = document.querySelector("#logofile"),

// Escuchar cuando cambie
  // Los archivos seleccionados, pueden ser muchos o uno
  archivos = $seleccionArchivos.files;
  // Si no hay archivos salimos de la función y quitamos la imagen
  if (!archivos || !archivos.length) {
    $imagenPrevisualizacion.src = "";
    return;
  }
  // Ahora tomamos el primer archivo, el cual vamos a previsualizar
  primerArchivo = archivos[0];
  // Lo convertimos a un objeto de tipo objectURL
  objectURL = URL.createObjectURL(primerArchivo);
  // Y a la fuente de la imagen le ponemos el objectURL
  $imagenPrevisualizacion.src = objectURL;
}


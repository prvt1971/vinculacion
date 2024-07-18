$(function() {
 $('#capa-login').hide(); //Ocultar el pànel de login
 $('#capa-datos').hide(); //Ocultar el pànel de datos
 //Para capturar y realizar acción cuando se da clic en Entrar
  $(document).on('click','.click-texto',function(e){
    e.preventDefault();
    $('#capa-datos').hide();
    if ($('#accion')[0].innerHTML == 'Salir'){
      location.reload()
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
    switch (archivo) {
      case "formularios/add_facultades.html":
          $('#visualizador').html("");//Para limpiar el área de visualización
          listaFacultades();
          colocaDecanos();
          break;
        case "formularios/add_universidades.html":
          $('#visualizador').html("");//Para limpiar el área de visualización
          listaUniversidades();
          colocaRectores();
          break;
        case "formularios/add_usuarios.html":
          $('#visualizador').html("");//Para limpiar el área de visualización
          listaUsuarios(document.getElementById('BarraPrincipal').getAttribute("rol"));//Paso como parametro el rol del usuario logueado
          break;
        case "formularios/add_carreras.html":
          $('#visualizador').html("");//Para limpiar el área de visualización
          listaCarreras();
          colocaCoordinadores()
          break;
        case "formularios/add_periodos.html":
          $('#visualizador').html("");//Para limpiar el área de visualización
            listaPeriodos();
            break;
        case "formularios/add_provincias.html":
          $('#visualizador').html("");//Para limpiar el área de visualización
            listaProvincias();
          break;
        case "formularios/add_cantones.html":
          $('#visualizador').html("");//Para limpiar el área de visualización
            listaCantones();
            colocaProvincias();
          break;
        case "formularios/add_parroquias.html":
          $('#visualizador').html("");//Para limpiar el área de visualización
            listaParroquias();
            colocaCantones();
          break;
        case "formularios/add_comunidades.html":
          $('#visualizador').html("");//Para limpiar el área de visualización
            listaComunidades();
            colocaParroquias();
          break;
        case "formularios/compose_email.html":
          $('#visualizador').html("");//Para limpiar el área de visualización
    }
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
     let activado = 0; //Asumiendo que la cuenta no esta activada
        let plantilla = '';
        resultados = JSON.parse(respuesta) 
        resultados.forEach(element => { //Recorrer todos los elementos del objeto
            if (element.foto == 'nobody.png'){ //para gestionar lo que sucede si se trata de un usuario si foto
              if (element.sexo == 1){ // Es una mujer
                plantilla += `<center>${element.nombres} ${element.apellidos}<br>
              <img style='max-width:100px;' name='logotipo' id='logotipo' src='imagenes/fotos_usuarios/mujer.png' alt = 'Salir'><br>
              ${element.rolname}</center>
              `
              }else{ // Es un hombre
                plantilla += `<center>${element.nombres} ${element.apellidos}<br>
              <img style='max-width:100px;' name='logotipo' id='logotipo' src='imagenes/fotos_usuarios/hombre.png' alt = 'Salir'><br>
              ${element.rolname}</center>
              `
              }
            }else{
              plantilla += `<center>${element.nombres} ${element.apellidos}<br>
              <img style='max-width:100px;' name='logotipo' id='logotipo' src='imagenes/fotos_usuarios/${element.foto}' alt = 'Salir'><br>
              ${element.rolname}</center>
              `
            }
            
            let rolid = element.rolid;
            let activado =  (element.confirmado == 1);
            let datoPasar = element.rolid + "," + element.parametro + "," + element.valor;
            if (activado){
              haceBarra(rolid); //Para construir la barra de menú para cada tipod e usuario
              document.getElementById('BarraPrincipal').setAttribute("rol", datoPasar);
            }else{
              Refrescar('formularios/confirmar_registro.html','areaprincipal')  
            }
            document.getElementById('BarraPrincipal').setAttribute("userId", element.id);
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
function Refrescar(archivo,contenedor){
  fetch(archivo)
  .then(response => response.text())
  .then(data => {
    document.getElementById(contenedor).innerHTML = data;
  });
}
//Para mostrar el formulario  e registro
function crearCuenta(){
  archivo = "formularios/add_usuarios.html"
  Refrescar(archivo,'areaprincipal')
  $('#capa-login').hide();
  document.getElementById('BarraPrincipal').setAttribute("userId", 0);
}
//Para limpiar el formulario de los usuarios
function resetearaddUsuarios(){
  if (document.getElementById('BarraPrincipal').getAttribute("userId") == 0){
    location.reload()
  }else{
    $('#form-addUser').trigger('reset');
    document.getElementById("user-edi").innerHTML = "Aceptar";
  }
}
// Para enviar correo desde una cuenta de Gmail
function EnviarCorreo(){
    var form_data = new FormData(); //Crear objeto de tipo formulario apra pasarlo al servidor con JSON
    //const form = document.querySelector('#enviar-correo');
    let direccion = $('#destinatario').val();
    let asunto = $('#asunto').val();
    let cuerpo = $('#contenido').val();
    let dato = { direccion,asunto,cuerpo }
    form_data.append('data', JSON.stringify(dato));
    $.ajax({
      url: 'enviar_correo.php',
      type: 'POST',
      data: form_data,
      contentType: false,
      processData: false,
      success: function(response) {
          console.log(response)
      }
   
    })
}
function verificarRegistro(){
  var form_data = new FormData(); //Crear objeto de tipo formulario apra pasarlo al servidor con JSON
  //const form = document.querySelector('#enviar-correo');
  let usuario = $('#codigo-oculto').val();
  let codigo = $('#codigo-verificacion').val();
  let dato = { usuario,codigo}
  form_data.append('data', JSON.stringify(dato));
  $.ajax({
    url: 'activar_usuario.php',
    type: 'POST',
    data: form_data,
    contentType: false,
    processData: false,
    success: function(response) {
       let resultados = JSON.parse(response) 
        if (resultados[0][0] === "Activado"){
          Refrescar('formularios/confirmacion_positiva.html','areaprincipal')
          $('#capa-datos').hide()
        }else{
          Refrescar('formularios/confirmar_registro.html','areaprincipal')
        }
    }
 
  })   
}
//Funcion para solicitar un codigo de verificacion
function solicitarCodigo(){
    let userid = document.getElementById('BarraPrincipal').getAttribute("UserId")
    let dato = { userid}
    $.post('solicitar_codigo.php',dato,function(respuesta){
      console.log(respuesta)
    })
    document.getElementById("codigo-oculto").value = userid
    
}

//Funcion para hacer visible el formulario de logueo
function showLoguin(){
  $('#accion').hide();
  $('#capa-datos').hide();
  $('#form-login').trigger('reset'); //Para limpiar todos los campos del formulario despues de enviar los datos
  $('#capa-login').show();
}





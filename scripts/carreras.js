//PARA LA GESTIÓN DE LAS CARRERAS
function registraCarrera(tipo){
    let userid = document.getElementById('BarraPrincipal').getAttribute("userId");//Id del usuario logueado guardado como peropiedad de la barra principal
    var form_data = new FormData(); //Crear objeto de tipo formulario apra pasarlo al sertvidor con JSON
    const form = document.querySelector('#form-addCarr');
    if (form.checkValidity()) {
      let nombre = $('#carr-nombre').val();
      let coordinador = $('#carr-coordinador').val();
      let accion = document.getElementById('carr-edi').innerHTML;
      let carrera = document.getElementById('carr-edi').name;
      var dato = { nombre,coordinador,carrera,accion,userid  }
      // Agregar archivo al objeto FormData
      form_data.append('archivo', $('#carr-logofile')[0].files[0]);
      // Agregar JSON al objeto FormData
       form_data.append('data', JSON.stringify(dato));
      $.ajax({
        url: 'registrar_carrera.php',
        type: 'POST',
        data: form_data,
        contentType: false,
        processData: false,
        success: function(response) {
            $('#form-addCarr').trigger('reset');
            listaCarreras();
            limpiarFormularioCarreras()
        }
      });
    } else {
      form.reportValidity();
    }
  }
  //Para colocar el listado de carreras
  function listaCarreras(){
    let userid = document.getElementById('BarraPrincipal').getAttribute("userId");//Id del usuario logueado guardado como peropiedad de la barra principal
    $.ajax({ //método ajax para hacerle una peticion al servidor
        url: 'lista_carreras.php',
        type: 'GET',
        data: { dato: userid },
        success: function(respuesta){
            let plantilla = "<div class=row>"
            plantilla += "<div class='col-md-12'>"
            plantilla += "<hd>LISTADO DE CARRERAS</hd>"
            plantilla += "<table class=\"table table-primary display table-hover table-bordered\">" //Tabla para mostrar el listado
            plantilla += "<thead><tr><td>Id</td><td>Nombre</td><td>Coordinador</td><td>Logotipo</td><td></td><td></td>"
            plantilla += "</tr></thead><tbody id=\"cuerpo\">"
            let resultados = JSON.parse(respuesta) 
            resultados.forEach(element => { //Recorrer todos los elementos del objeto
                plantilla += `<tr atributo="${element.id}"> 
                    <td>${element.id}</td>
                    <td>${element.nombre}</td>
                    <td>${element.coordinador}</td>
                    <td><img  width='35' height='35' src='${element.path}' alt = 'Salir'></td>
                    <td>
                        <button id="${element.id}" class='user-borrar btn btn-danger' onClick="borrarCarrera(${element.id})">Borrar</button>
                    </td>
                    <td>
                        <button marca='${element.id}' class='btn btn-secondary' onClick="editarCarrera(${element.id})">Editar</button>
                    </td>
                </tr>`
            });
            plantilla += "</tbody></table>"
            plantilla +="</div></div>"
            $('#visualizador').html(plantilla); //Aquí debo ver a que objeto le asigno la propiedad
            $('table.display').DataTable();
        }
        
    })
  }
  //Acción al borrar una facultad
  function borrarCarrera(carrera){
    let Dato = { carrera }
      $.post('borra_carrera.php',Dato,function(respuesta){
          listaCarreras(0);
      })
  }
  //Para editar un usuario, responde al evento OnClick del boton editar en el formulario de usuarios
  function editarCarrera(carrera){
    let Dato = { carrera }
      limpiarFormularioCarreras()
      document.getElementById("carr-edi").innerHTML = "Actualizar";
      document.getElementById("carr-edi").name = carrera;
      $.post('editar_carrera.php',Dato,function(respuesta){
        console.log(respuesta)
        let resultados = JSON.parse(respuesta) 
        resultados.forEach(element => { //Recorrer todos los elementos del objeto
          document.getElementById("carr-nombre").value = element.nombre
          document.getElementById("carr-logotipo").src = element.path
          document.getElementById("carr-coordinador").value = element.coordinador
          document.getElementById("carr_edi").focus()
        })
      })
  }
  //Para llenar el listado de decanos en el formulario
  function colocaCoordinadores(){
    let userid = document.getElementById('BarraPrincipal').getAttribute("userId");//Id del usuario logueado guardado como peropiedad de la barra principal
     $.ajax({ //método ajax para hacerle una peticion al servidor
      url: 'get_coordinadores.php',
      type: 'GET',
      data: { dato: userid },
      success: function(respuesta){
          let plantilla = "<option value=0 selected></option>";
          let resultados = JSON.parse(respuesta);
          resultados.forEach(element => { //Recorrer todos los elementos del objeto
              plantilla += `"<option value=${element.id}>${element.apellidos} ${element.nombre}</option>"` 
          });
          $('#carr-coordinador').html(plantilla); //Aquí debo ver a que objeto le asigno la propiedad
          
      }
    })
  }
  //Para resetear el formulariode Facultades
function limpiarFormularioCarreras(){
  $imagenPrevisualizacion = document.querySelector("#carr-logotipo");
  $('#form-addCarr').trigger('reset');
  $imagenPrevisualizacion.src = "imagenes/i1.png";
  document.getElementById("carr-edi").innerHTML = "Aceptar";
}
//Para actualizar el logo de la facultad
function actualizalogoCarr(){
  $imagenPrevisualizacion = document.querySelector("#carr-logotipo");
// Obtener referencia al input y a la imagen
$seleccionArchivos = document.querySelector("#carr-logofile"),
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



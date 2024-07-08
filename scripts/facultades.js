//PARA LA GESTIÓN DE LAS FACULTADES
function registraFacultad(tipo){
    let userid = document.getElementById('BarraPrincipal').getAttribute("userId");//Id del usuario logueado guardado como peropiedad de la barra principal
    var form_data = new FormData(); //Crear objeto de tipo formulario apra pasarlo al sertvidor con JSON
    const form = document.querySelector('#form-addFac');
    if (form.checkValidity()) {
      let nombre = $('#fac-nombre').val();
      let decano = $('#fac-decano').val();
      let accion = document.getElementById('fac-edi').innerHTML;
      let facultad = document.getElementById('fac-edi').name;
      var dato = { nombre,decano,facultad,accion,userid  }
      // Agregar archivo al objeto FormData
      form_data.append('archivo', $('#fac-logofile')[0].files[0]);
      // Agregar JSON al objeto FormData
       form_data.append('data', JSON.stringify(dato));
      $.ajax({
        url: 'registrar_facultad.php',
        type: 'POST',
        data: form_data,
        contentType: false,
        processData: false,
        success: function(response) {
            $('#form-addFac').trigger('reset');
            listaFacultades();
            limpiarFormularioFacultades()
        }
      });
    } else {
      form.reportValidity();
    }
  }
  //Para colocar el listado de facultades
  function listaFacultades(){
    let userid = document.getElementById('BarraPrincipal').getAttribute("userId");//Id del usuario logueado guardado como peropiedad de la barra principal
    $.ajax({ //método ajax para hacerle una peticion al servidor
        url: 'lista_facultades.php',
        type: 'GET',
        data: { dato: userid },
        success: function(respuesta){
            let plantilla = "<div class=row>"
            plantilla += "<div class='col-md-12'>"
            plantilla += "<hd>LISTADO DE USUARIOS</hd>"
            plantilla += "<table class=\"table table-primary display table-hover table-bordered\">" //Tabla para mostrar el listado
            plantilla += "<thead><tr><td>Id</td><td>Nombre</td><td>Decano</td><td>Logotipo</td><td></td><td></td>"
            plantilla += "</tr></thead><tbody id=\"cuerpo\">"
            let resultados = JSON.parse(respuesta) 
            resultados.forEach(element => { //Recorrer todos los elementos del objeto
                plantilla += `<tr atributo="${element.id}"> 
                    <td>${element.id}</td>
                    <td>${element.nombre}</td>
                    <td>${element.decano}</td>
                    <td><img  width='35' height='35' src='${element.path}' alt = 'Salir'></td>
                    <td>
                        <button id="${element.id}" class='user-borrar btn btn-danger' onClick="borrarFacultad(${element.id})">Borrar</button>
                    </td>
                    <td>
                        <button marca='${element.id}' class='btn btn-secondary' onClick="editarFacultad(${element.id})">Editar</button>
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
  function borrarFacultad(facultad){
    let Dato = { facultad }
      $.post('borra_facultad.php',Dato,function(respuesta){
          listaFacultades(0);
      })
  }
  //Para editar un usuario, responde al evento OnClick del boton editar en el formulario de usuarios
  function editarFacultad(facultad){
    let Dato = { facultad }
      limpiarFormularioFacultades()
      document.getElementById("fac-edi").innerHTML = "Actualizar";
      document.getElementById("fac-edi").name = facultad;
      $.post('editar_facultad.php',Dato,function(respuesta){
        let resultados = JSON.parse(respuesta) 
        resultados.forEach(element => { //Recorrer todos los elementos del objeto
          document.getElementById("fac-nombre").value = element.nombre
          document.getElementById("fac-logotipo").src = element.path
          document.getElementById("fac-decano").value = element.decano
          document.getElementById("fac_nombre").focus()
        })
      })
  }
  //Para llenar el listado de decanos en el formulario
  function colocaDecanos(){
    let userid = document.getElementById('BarraPrincipal').getAttribute("userId");//Id del usuario logueado guardado como peropiedad de la barra principal
    $.ajax({ //método ajax para hacerle una peticion al servidor
      url: 'get_decanos.php',
      type: 'GET',
      data: { dato: userid },
      success: function(respuesta){
        //console.log(respuesta)
          let plantilla = "<option value=0 selected></option>";
          let resultados = JSON.parse(respuesta);
          resultados.forEach(element => { //Recorrer todos los elementos del objeto
              plantilla += `"<option value=${element.id}>${element.apellidos} ${element.nombre}</option>"` 
          });
          $('#fac-decano').html(plantilla); //Aquí debo ver a que objeto le asigno la propiedad
      }
    })
  }
  //Para resetear el formulariode Facultades
function limpiarFormularioFacultades(){
  $imagenPrevisualizacion = document.querySelector("#fac-logotipo");
  $('#form-addFac').trigger('reset');
  $imagenPrevisualizacion.src = "imagenes/i1.png";
  document.getElementById("fac-edi").innerHTML = "Aceptar";
}
//Para actualizar el logo de la facultad
function actualizalogoFac(){
  $imagenPrevisualizacion = document.querySelector("#fac-logotipo");
// Obtener referencia al input y a la imagen
$seleccionArchivos = document.querySelector("#fac-logofile"),
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
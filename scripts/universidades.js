//Función para validar el formulario de universidaes y enviar los datos para el registro
function registraUniversidad(){
    var form_data = new FormData(); //Crear objeto de tipo formulario apra pasarlo al sertvidor con JSON
    const form = document.querySelector('#form-addUni');
    if (form.checkValidity()) {
      let nombre = $('#uni-nombre').val();
      let url = $('#uni-url').val();
      let email = $('#uni-email').val();
      //if (!(email)){
      //  let email = ""
      //}
      let rector = $('#uni-rector').val();
      if (rector == ''){
        let rector = 0;
      }
      console.log(rector)
      let accion = document.getElementById('uni-edi').innerHTML;
      let universidad = document.getElementById('uni-edi').name;
      var dato = { nombre,email,url,rector,accion,universidad }
      // Agregar archivo al objeto FormData
      form_data.append('archivo', $('#uni-logofile')[0].files[0]);
      // Agregar JSON al objeto FormData
       form_data.append('data', JSON.stringify(dato));
      $.ajax({
        url: 'registrar_universidad.php',
        type: 'POST',
        data: form_data,
        contentType: false,
        processData: false,
        success: function(response) {
            $('#form-addUni').trigger('reset');
            listaUniversidades();
            limpiarFormularioUniversidades()
        }
      });
      
    } else {
      form.reportValidity();
    }
  }
  //funcion para colocar el listado de rectores
  function colocaRectores(){
    $.ajax({ //método ajax para hacerle una peticion al servidor
      url: 'get_rectores.php',
      type: 'GET',
      success: function(respuesta){
          let plantilla = "<option value=0 selected></option>";
          let resultados = JSON.parse(respuesta);
          resultados.forEach(element => { //Recorrer todos los elementos del objeto
              plantilla += `"<option value=${element.id}>${element.apellidos} ${element.nombre}</option>"`
          });
          $('#uni-rector').html(plantilla); //Aquí debo ver a que objeto le asigno la propiedad
      }
    })
  }
  //Función para listar las universidades
  function listaUniversidades(){
    $.ajax({ //método ajax para hacerle una peticion al servidor
        url: 'lista_universidades.php',
        type: 'GET',
        success: function(respuesta){
            let plantilla = "<div class=row>"
            plantilla += "<div class='col-md-12'>"
            plantilla = "<hd>LISTADO DEE UNIVERSIDADES</hd>"
            plantilla += "<table class=\"table table-primary display table-hover table-bordered\">" //Tabla para mostrar el listado
            plantilla += "<thead><tr><td>Id</td><td>Nombre de la universida</td><td>email</td><td>URL</td><td>Rector</td><td>Logotipo</td><td></td><td></td>"
            plantilla += "</tr></thead><tbody id=\"cuerpo\">"
            let resultados = JSON.parse(respuesta) 
            resultados.forEach(element => { //Recorrer todos los elementos del objeto
                plantilla += `<tr atributo="${element.id}"> 
                    <td>${element.id}</td>
                    <td>${element.nombre}</td>
                    <td>${element.email}</td>
                    <td>${element.url}</td>
                    <td>${element.rector}</td>
                    <td><img  width='35' height='35' src='${element.path}' alt = 'Salir'></td>
                    <td>
                        <button id="${element.id}" class='uni-borrar btn btn-danger' onClick="borrarUniversidad(${element.id})">Borrar</button>
                    </td>
                    <td>
                        <button marca='${element.id}' class='btn btn-secondary' onClick="editarUniversidad(${element.id})">Editar</button>
                    </td>
                </tr>`
            });
            plantilla += "</tbody></table>"
            plantilla += "</div></div>"
            $('#visualizador').html(plantilla); //Aquí debo ver a que objeto le asigno la propiedad
            $('table.display').DataTable();
        }
        
    })
  }
  //Para limpiar el formulario de universidades
  function limpiarFormularioUniversidades(){
    $imagenPrevisualizacion = document.querySelector("#logotipo");
    $('#form-addUni').trigger('reset');
    $imagenPrevisualizacion.src = "imagenes/i1.png";
    document.getElementById("uni-edi").innerHTML = "Aceptar";
  }
  //Para borrar una universidad, responde al evento OnClick del boton borrar en el formulario de universidades
  function borrarUniversidad(universidad){
    let Dato = { universidad }
      $.post('borra_universidad.php',Dato,function(respuesta){
          listaUniversidades();
      })
  
  }
  //Para editar una universidad, responde al evento OnClick del boton borrar en el formulario de universidades
  function editarUniversidad(universidad){
    let Dato = { universidad }
      limpiarFormularioUniversidades()
      //$('#form-addUni').trigger('reset');
      document.getElementById("uni-edi").innerHTML = "Actualizar";
      document.getElementById("uni-edi").name = universidad;
      $.post('editar_universidad.php',Dato,function(respuesta){
          console.log(respuesta)
          let resultados = JSON.parse(respuesta) 
          resultados.forEach(element => { //Recorrer todos los elementos del objeto
          document.getElementById("uni-nombre").value = element.nombre
          document.getElementById("uni-url").value = element.url
          document.getElementById("uni-email").value = element.email
          document.getElementById("logotipo").src = element.path
          document.getElementById("uni-rector").value = element.rectorId
          document.getElementById("uni-nombre").focus();
        })
        //listaUniversidades();
      })
  }
  //Para actializar el logotipo al seleccionar un archivo
  function actualizaImagen(){
    $imagenPrevisualizacion = document.querySelector("#logotipo");
  // Obtener referencia al input y a la imagen
    
  $seleccionArchivos = document.querySelector("#uni-logofile"),
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
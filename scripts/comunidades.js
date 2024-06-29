//PARA LA GESTIÓN DE LAS CANTONES
function registraComunidad(tipo){
    let userid = document.getElementById('BarraPrincipal').getAttribute("userId");//Id del usuario logueado guardado como peropiedad de la barra principal
    var form_data = new FormData(); //Crear objeto de tipo formulario apra pasarlo al servidor con JSON
    const form = document.querySelector('#form-addComunidades');
    if (form.checkValidity()) {
      let nombre = $('#com-nombre').val();
      let parroquia = $('#com-parroquia').val();
      let accion = document.getElementById('com-edi').innerHTML;
      let comunidad = document.getElementById('com-edi').name;
      var dato = { nombre,userid,accion,parroquia,comunidad }
      // Agregar JSON al objeto FormData
      form_data.append('data', JSON.stringify(dato));  
      $.ajax({
        url: 'registrar_comunidad.php',
        type: 'POST',
        data: form_data,
        contentType: false,
        processData: false,
        success: function(response) {
            $('#form-addComunidades').trigger('reset');
            listaComunidades();
            limpiarFormularioComunidades()
        }
      });
    } else {
      form.reportValidity();
    }
  }
  //Para colocar el listado de Comunidades
  function listaComunidades(){
    let userid = document.getElementById('BarraPrincipal').getAttribute("userId");//Id del usuario logueado guardado como peropiedad de la barra principal
    $.ajax({ //método ajax para hacerle una peticion al servidor
        url: 'lista_comunidades.php',
        type: 'GET',
        data: { dato: userid },
        success: function(respuesta){
            let plantilla = "<div class=row>"
            plantilla += "<div class='col-md-12'>"
            plantilla += "<hd>LISTADO DE COMUNIDADES</hd>"
            plantilla += "<table class=\"table table-primary display table-hover table-bordered\">" //Tabla para mostrar el listado
            plantilla += "<thead><tr><td>Id</td><td>Nombre de la comunidad</td><td>Parroquia</td><td></td><td></td>"
            plantilla += "</tr></thead><tbody id=\"cuerpo\">"
            let resultados = JSON.parse(respuesta) 
            resultados.forEach(element => { //Recorrer todos los elementos del objeto
                plantilla += `<tr atributo="${element.id}"> 
                    <td>${element.id}</td>
                    <td>${element.nombre}</td>
                    <td>${element.parroquia}</td>
                    <td>
                        <button id="${element.id}" class='user-borrar btn btn-danger' onClick="borrarComunidad(${element.id})">Borrar</button>
                    </td>
                    <td>
                        <button marca='${element.id}' class='btn btn-secondary' onClick="editarComunidad(${element.id})">Editar</button>
                    </td>
                </tr>`
            });
            plantilla += "</tbody></table>"
            plantilla +="</div></div>"
            $('#visualizador').html(plantilla); //Aquí debo ver a que objeto le asigno la propiedad
            //$('table.display').DataTable();
        }
        
    })
  }
  //Acción al borrar una facultad
  function borrarComunidad(comunidad){
    let Dato = { comunidad }
      $.post('borra_comunidad.php',Dato,function(respuesta){
          listaComunidades(0);
      })
  }
  //Para editar un usuario, responde al evento OnClick del boton editar en el formulario de usuarios
  function editarComunidad(comunidad){
    let Dato = { comunidad }
      limpiarFormularioComunidades()
      document.getElementById("com-edi").innerHTML = "Actualizar";
      document.getElementById("com-edi").name = comunidad;
      $.post('editar_comunidad.php',Dato,function(respuesta){
        let resultados = JSON.parse(respuesta) 
        resultados.forEach(element => { //Recorrer todos los elementos del objeto
          document.getElementById("com-nombre").value = element.nombre
          document.getElementById("com-parroquia").value = element.parroquia
          document.getElementById("com_edi").focus() 
        })
      })
  }
  
  //Para resetear el formulario de Periodos
function limpiarFormularioComunidades(){
  $('#form-addComunidades').trigger('reset');
  document.getElementById("com-edi").innerHTML = "Aceptar";
}

function colocaParroquias(){
  $.ajax({ //método ajax para hacerle una peticion al servidor
    url: 'get_parroquias.php',
    type: 'GET',
    success: function(respuesta){
        let plantilla = "<option value=0 selected></option>";
        let resultados = JSON.parse(respuesta);
        resultados.forEach(element => { //Recorrer todos los elementos del objeto
            plantilla += `"<option value=${element.id}> ${element.nombre}</option>"`
        });
        $('#com-parroquia').html(plantilla); //Aquí debo ver a que objeto le asigno la propiedad
    }
  })
}



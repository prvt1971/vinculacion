//PARA LA GESTIÓN DE LAS CANTONES
function registraCanton(tipo){
    let userid = document.getElementById('BarraPrincipal').getAttribute("userId");//Id del usuario logueado guardado como peropiedad de la barra principal
    var form_data = new FormData(); //Crear objeto de tipo formulario apra pasarlo al servidor con JSON
    const form = document.querySelector('#form-addCantones');
    if (form.checkValidity()) {
      let nombre = $('#can-nombre').val();
      let provincia = $('#can-provincia').val();
      let accion = document.getElementById('can-edi').innerHTML;
      let canton = document.getElementById('can-edi').name;
      var dato = { nombre,userid,accion,canton,provincia }
      // Agregar JSON al objeto FormData
      form_data.append('data', JSON.stringify(dato));  
      $.ajax({
        url: 'registrar_canton.php',
        type: 'POST',
        data: form_data,
        contentType: false,
        processData: false,
        success: function(response) {
            $('#form-addCantones').trigger('reset');
            listaCantones();
            limpiarFormularioCantones()
        }
      });
    } else {
      form.reportValidity();
    }
  }
  //Para colocar el listado de Cantoness
  function listaCantones(){
    let userid = document.getElementById('BarraPrincipal').getAttribute("userId");//Id del usuario logueado guardado como peropiedad de la barra principal
    $.ajax({ //método ajax para hacerle una peticion al servidor
        url: 'lista_Cantones.php',
        type: 'GET',
        data: { dato: userid },
        success: function(respuesta){
            let plantilla = "<div class=row>"
            plantilla += "<div class='col-md-12'>"
            plantilla += "<hd>LISTADO DE CANTONES</hd>"
            plantilla += "<table class=\"table table-primary display table-hover table-bordered\">" //Tabla para mostrar el listado
            plantilla += "<thead><tr><td>Id</td><td>Nombre del Cantón</td><td>Provincia</td><td></td><td></td>"
            plantilla += "</tr></thead><tbody id=\"cuerpo\">"
            let resultados = JSON.parse(respuesta) 
            resultados.forEach(element => { //Recorrer todos los elementos del objeto
                plantilla += `<tr atributo="${element.id}"> 
                    <td>${element.id}</td>
                    <td>${element.nombre}</td>
                    <td>${element.provincia}</td>
                    <td>
                        <button id="${element.id}" class='user-borrar btn btn-danger' onClick="borrarCanton(${element.id})">Borrar</button>
                    </td>
                    <td>
                        <button marca='${element.id}' class='btn btn-secondary' onClick="editarCanton(${element.id})">Editar</button>
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
  function borrarCanton(canton){
    let Dato = { canton }
      $.post('borra_Canton.php',Dato,function(respuesta){
          listaCantones(0);
      })
  }
  //Para editar un usuario, responde al evento OnClick del boton editar en el formulario de usuarios
  function editarCanton(canton){
    let Dato = { canton }
      limpiarFormularioCantones()
      document.getElementById("can-edi").innerHTML = "Actualizar";
      document.getElementById("can-edi").name = canton;
      $.post('editar_canton.php',Dato,function(respuesta){
        let resultados = JSON.parse(respuesta) 
        resultados.forEach(element => { //Recorrer todos los elementos del objeto
          document.getElementById("can-nombre").value = element.nombre
          document.getElementById("can-provincia").value = element.provincia
          document.getElementById("can_edi").focus() 
        })
      })
  }
  
  //Para resetear el formulario de Periodos
function limpiarFormularioCantones(){
  $('#form-addCantoness').trigger('reset');
  document.getElementById("can-edi").innerHTML = "Aceptar";
}

function colocaProvincias(){
  $.ajax({ //método ajax para hacerle una peticion al servidor
    url: 'get_provincias.php',
    type: 'GET',
    success: function(respuesta){
        let plantilla = "<option value=0 selected></option>";
        let resultados = JSON.parse(respuesta);
        resultados.forEach(element => { //Recorrer todos los elementos del objeto
            plantilla += `"<option value=${element.id}> ${element.nombre}</option>"`
        });
        $('#can-provincia').html(plantilla); //Aquí debo ver a que objeto le asigno la propiedad
    }
  })
}



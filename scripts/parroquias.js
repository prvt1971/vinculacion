//PARA LA GESTIÓN DE LAS CANTONES
function registraParroquia(tipo){
    let userid = document.getElementById('BarraPrincipal').getAttribute("userId");//Id del usuario logueado guardado como peropiedad de la barra principal
    var form_data = new FormData(); //Crear objeto de tipo formulario apra pasarlo al servidor con JSON
    const form = document.querySelector('#form-addParroquias');
    if (form.checkValidity()) {
      let nombre = $('#parr-nombre').val();
      let canton = $('#parr-canton').val();
      let accion = document.getElementById('parr-edi').innerHTML;
      let parroquia = document.getElementById('parr-edi').name;
      var dato = { nombre,userid,accion,parroquia,canton }
      // Agregar JSON al objeto FormData
      form_data.append('data', JSON.stringify(dato));  
      $.ajax({
        url: 'registrar_parroquia.php',
        type: 'POST',
        data: form_data,
        contentType: false,
        processData: false,
        success: function(response) {
            $('#form-addParroquias').trigger('reset');
            listaParroquias();
            limpiarFormularioParroquias()
        }
      });
    } else {
      form.reportValidity();
    }
  }
  //Para colocar el listado de Cantoness
  function listaParroquias(){
    let userid = document.getElementById('BarraPrincipal').getAttribute("userId");//Id del usuario logueado guardado como peropiedad de la barra principal
    $.ajax({ //método ajax para hacerle una peticion al servidor
        url: 'lista_parroquias.php',
        type: 'GET',
        data: { dato: userid },
        success: function(respuesta){
            let plantilla = "<div class=row>"
            plantilla += "<div class='col-md-12'>"
            plantilla += "<hd>LISTADO DE PARROQUIAS</hd>"
            plantilla += "<table class=\"table table-primary display table-hover table-bordered\">" //Tabla para mostrar el listado
            plantilla += "<thead><tr><td>Id</td><td>Nombre de la parroquia</td><td>cantón</td><td></td><td></td>"
            plantilla += "</tr></thead><tbody id=\"cuerpo\">"
            let resultados = JSON.parse(respuesta) 
            resultados.forEach(element => { //Recorrer todos los elementos del objeto
                plantilla += `<tr atributo="${element.id}"> 
                    <td>${element.id}</td>
                    <td>${element.nombre}</td>
                    <td>${element.canton}</td>
                    <td>
                        <button id="${element.id}" class='user-borrar btn btn-danger' onClick="borrarParroquia(${element.id})">Borrar</button>
                    </td>
                    <td>
                        <button marca='${element.id}' class='btn btn-secondary' onClick="editarParroquia(${element.id})">Editar</button>
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
  function borrarParroquia(parroquia){
    let Dato = { parroquia }
      $.post('borra_parroquia.php',Dato,function(respuesta){
          listaParroquias(0);
      })
  }
  //Para editar un usuario, responde al evento OnClick del boton editar en el formulario de usuarios
  function editarParroquia(parroquia){
    let Dato = { parroquia }
      limpiarFormularioParroquias()
      document.getElementById("parr-edi").innerHTML = "Actualizar";
      document.getElementById("parr-edi").name = parroquia;
      $.post('editar_parroquia.php',Dato,function(respuesta){
        let resultados = JSON.parse(respuesta) 
        resultados.forEach(element => { //Recorrer todos los elementos del objeto
          document.getElementById("parr-nombre").value = element.nombre
          document.getElementById("parr-canton").value = element.canton
          document.getElementById("parr_edi").focus() 
        })
      })
  }
  
  //Para resetear el formulario de Periodos
function limpiarFormularioParroquias(){
  $('#form-addparroquias').trigger('reset');
  document.getElementById("parr-edi").innerHTML = "Aceptar";
}

function colocaCantones(){
  $.ajax({ //método ajax para hacerle una peticion al servidor
    url: 'get_cantones.php',
    type: 'GET',
    success: function(respuesta){
        let plantilla = "<option value=0 selected></option>";
        let resultados = JSON.parse(respuesta);
        resultados.forEach(element => { //Recorrer todos los elementos del objeto
            plantilla += `"<option value=${element.id}> ${element.nombre}</option>"`
        });
        $('#parr-canton').html(plantilla); //Aquí debo ver a que objeto le asigno la propiedad
    }
  })
}



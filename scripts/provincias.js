//PARA LA GESTIÓN DE LAS CARRERAS
function registraProvincia(tipo){
    let userid = document.getElementById('BarraPrincipal').getAttribute("userId");//Id del usuario logueado guardado como peropiedad de la barra principal
    var form_data = new FormData(); //Crear objeto de tipo formulario apra pasarlo al servidor con JSON
    const form = document.querySelector('#form-addProvincias');
    if (form.checkValidity()) {
      let nombre = $('#pro-nombre').val();
      let accion = document.getElementById('pro-edi').innerHTML;
      let provincia = document.getElementById('pro-edi').name;
      var dato = { nombre,userid,accion,provincia }
      // Agregar JSON al objeto FormData
      form_data.append('data', JSON.stringify(dato));  
      $.ajax({
        url: 'registrar_provincia.php',
        type: 'POST',
        data: form_data,
        contentType: false,
        processData: false,
        success: function(response) {
            $('#form-addProvincias').trigger('reset');
            listaProvincias();
            limpiarFormularioProvincias()
        }
      });
    } else {
      form.reportValidity();
    }
  }
  //Para colocar el listado de provincias
  function listaProvincias(){
    let userid = document.getElementById('BarraPrincipal').getAttribute("userId");//Id del usuario logueado guardado como peropiedad de la barra principal
    $.ajax({ //método ajax para hacerle una peticion al servidor
        url: 'lista_provincias.php',
        type: 'GET',
        data: { dato: userid },
        success: function(respuesta){
            let plantilla = "<div class=row>"
            plantilla += "<div class='col-md-12'>"
            plantilla += "<hd>LISTADO DE PROVINCIAS</hd>"
            plantilla += "<table class=\"table table-primary display table-hover table-bordered\">" //Tabla para mostrar el listado
            plantilla += "<thead><tr><td>Id</td><td>Nombre de la provincia</td><td></td><td></td>"
            plantilla += "</tr></thead><tbody id=\"cuerpo\">"
            let resultados = JSON.parse(respuesta) 
            resultados.forEach(element => { //Recorrer todos los elementos del objeto
                plantilla += `<tr atributo="${element.id}"> 
                    <td>${element.id}</td>
                    <td>${element.nombre}</td>
                    <td>
                        <button id="${element.id}" class='user-borrar btn btn-danger' onClick="borrarProvincia(${element.id})">Borrar</button>
                    </td>
                    <td>
                        <button marca='${element.id}' class='btn btn-secondary' onClick="editarProvincia(${element.id})">Editar</button>
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
  function borrarProvincia(provincia){
    let Dato = { provincia }
      $.post('borra_provincia.php',Dato,function(respuesta){
          listaProvincias(0);
      })
  }
  //Para editar un usuario, responde al evento OnClick del boton editar en el formulario de usuarios
  function editarProvincia(provincia){
    let Dato = { provincia }
      limpiarFormularioProvincias()
      document.getElementById("pro-edi").innerHTML = "Actualizar";
      document.getElementById("pro-edi").name = provincia;
      $.post('editar_provincia.php',Dato,function(respuesta){
        let resultados = JSON.parse(respuesta) 
        resultados.forEach(element => { //Recorrer todos los elementos del objeto
          document.getElementById("pro-nombre").value = element.nombre
          document.getElementById("pro_edi").focus() 
        })
      })
  }
  
  //Para resetear el formulario de Periodos
function limpiarFormularioProvincias(){
  $('#form-addProvincias').trigger('reset');
  document.getElementById("pro-edi").innerHTML = "Aceptar";
}




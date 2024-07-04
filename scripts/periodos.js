//PARA LA GESTIÓN DE LAS CARRERAS
function registraPeriodo(tipo){
    let userid = document.getElementById('BarraPrincipal').getAttribute("userId");//Id del usuario logueado guardado como peropiedad de la barra principal
    var form_data = new FormData(); //Crear objeto de tipo formulario apra pasarlo al servidor con JSON
    const form = document.querySelector('#form-addPeriodos');
    if (form.checkValidity()) {
      let nombrelargo = $('#per-titulolargo').val();
      let nombrecorto = $('#per-titulocorto').val();
      let inicia = $('#per-fechainicio').val();
      let termina = $('#per-fechatermina').val();
      let accion = document.getElementById('per-edi').innerHTML;
      let periodo = document.getElementById('per-edi').name;
      var dato = { nombrelargo,nombrecorto,inicia,termina,userid,accion,periodo }
      // Agregar JSON al objeto FormData
      form_data.append('data', JSON.stringify(dato));  
      $.ajax({
        url: 'registrar_periodo.php',
        type: 'POST',
        data: form_data,
        contentType: false,
        processData: false,
        success: function(response) {
            $('#form-addPeriodos').trigger('reset');
            listaPeriodos();
            limpiarFormularioPeriodos()
        }
      });
    } else {
      form.reportValidity();
    }
  }
  //Para colocar el listado de carreras
  function listaPeriodos(){
    let userid = document.getElementById('BarraPrincipal').getAttribute("userId");//Id del usuario logueado guardado como peropiedad de la barra principal
    $.ajax({ //método ajax para hacerle una peticion al servidor
        url: 'lista_periodos.php',
        type: 'GET',
        data: { dato: userid },
        success: function(respuesta){
            let plantilla = "<div class=row>"
            plantilla += "<div class='col-md-12'>"
            plantilla += "<hd>LISTADO DE PERIODOS ACADÉMICOS</hd>"
            plantilla += "<table class=\"table table-primary display table-hover table-bordered\">" //Tabla para mostrar el listado
            plantilla += "<thead><tr><td>Id</td><td>Nombre corto</td><td>Fecha de inicio</td><td>Fecha de culminación</td><td></td><td></td>"
            plantilla += "</tr></thead><tbody id=\"cuerpo\">"
            console.log(respuesta)
            let resultados = JSON.parse(respuesta) 
            resultados.forEach(element => { //Recorrer todos los elementos del objeto
                plantilla += `<tr atributo="${element.id}"> 
                    <td>${element.id}</td>
                    <td>${element.nombre}</td>
                    <td>${element.inicia}</td>
                    <td>${element.termina}</td>
                    <td>
                        <button id="${element.id}" class='user-borrar btn btn-danger' onClick="borrarPeriodo(${element.id})">Borrar</button>
                    </td>
                    <td>
                        <button marca='${element.id}' class='btn btn-secondary' onClick="editarPeriodo(${element.id})">Editar</button>
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
  function borrarPeriodo(periodo){
    let Dato = { periodo }
      $.post('borra_periodo.php',Dato,function(respuesta){
          listaPeriodos(0);
      })
  }
  //Para editar un usuario, responde al evento OnClick del boton editar en el formulario de usuarios
  function editarPeriodo(periodo){
    let Dato = { periodo }
      limpiarFormularioPeriodos()
      document.getElementById("per-edi").innerHTML = "Actualizar";
      document.getElementById("per-edi").name = periodo;
      $.post('editar_periodo.php',Dato,function(respuesta){
        console.log(respuesta)
        let resultados = JSON.parse(respuesta) 
        resultados.forEach(element => { //Recorrer todos los elementos del objeto
          document.getElementById("per-titulolargo").value = element.titulolargo
          document.getElementById("per-titulocorto").value = element.titulocorto
          document.getElementById("per-fechainicio").value = element.fechainicio
          document.getElementById("per-fechatermina").value = element.fechatermina
          document.getElementById("per_edi").focus() 
        })
      })
  }
  
  //Para resetear el formulario de Periodos
function limpiarFormularioPeriodos(){
  $('#form-addPeriodos').trigger('reset');
  document.getElementById("per-edi").innerHTML = "Aceptar";
}




function habilitaFormulario(valor){
      document.getElementById('user-nombres').disabled = valor;
      document.getElementById('user-apellidos').disabled = valor;
      document.getElementById('user-email').disabled = valor;
      document.getElementById('user-cuenta').disabled = valor;
      document.getElementById('user-fotografia').disabled = valor;
      document.getElementById('user-sexo').disabled = valor;
      document.getElementById('user-clave1').disabled = valor;
      document.getElementById('user-clave2').disabled = valor;
} 
function chequearExistencia(){
  //console.log("El input ha perdido el focosssss.");
  let cedula = $('#user-cedula').val();
  let dato = { cedula }
  $.post('chequea-usuario.php',dato,function(respuesta){
    console.log(respuesta)
    if (respuesta.length === 6){
      habilitaFormulario(false)
    }else{
      if (document.getElementById("user-edi").innerHTML === "Aceptar"){
          habilitaFormulario(true)
          let resultados = JSON.parse(respuesta)
          document.getElementById("user-nombres").value = resultados[0]['nombres']
          document.getElementById("user-apellidos").value = resultados[0]['apellidos']
          document.getElementById("user-email").value = resultados[0]['email']
          document.getElementById("user-cuenta").value = resultados[0]['cuenta']
          document.getElementById("fotografia").src = resultados[0]['path']
          document.getElementById("user-sexo").value = resultados[0]['sexo']
          document.getElementById("user-edi").innerHTML = "Aplicar";
          document.getElementById("user-edi").name = resultados[0]['id'];//Para pasar el dato del ID del usuario encontrado
        }
    }
  })
  //
}
//Para colocar el listado de usuarios
function listaUsuarios(tipo){
  var arreglo = tipo.split(",");
  var tipou = arreglo[0];
  var para = arreglo[1];
  var valo = arreglo[2];
  let userid = document.getElementById('BarraPrincipal').getAttribute("userId");
    $.ajax({ //método ajax para hacerle una peticion al servidor
        url: 'lista_usuarios.php',
        type: 'GET',
        data: { dato: tipou,parametro: para,valor: valo, usuario: userid },
        success: function(respuesta){
            let plantilla = "<div class=row>"
            plantilla += "<div class='col-md-12'>"
            plantilla += "<hd>LISTADO DE USUARIOS</hd>"
            plantilla += "<table class=\"table table-primary display table-hover table-bordered\">" //Tabla para mostrar el listado
            plantilla += "<thead><tr><td>Id</td><td>Cédula</td><td>Apellidos & nombres</td><td>EMAIL</td><td>Logotipo</td><td></td><td></td>"
            plantilla += "</tr></thead><tbody id=\"cuerpo\">"
            let resultados = JSON.parse(respuesta) 
            resultados.forEach(element => { //Recorrer todos los elementos del objeto
                plantilla += `<tr atributo="${element.id}"> 
                    <td>${element.id}</td>
                    <td>${element.cedula}</td>
                    <td>${element.nombre}</td>
                    <td>${element.email}</td>
                    <td><img  width='35' height='35' src='${element.path}' alt = 'Salir'></td>
                    <td>
                        <button id="${element.id}" class='user-borrar btn btn-danger' onClick="borrarUsuario(${element.id})">Quitar provilegio</button>
                    </td>
                    <td>
                        <button marca='${element.id}' class='btn btn-secondary' onClick="editarUsuario(${element.id})">Editar</button>
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
  function pasavalor(valor){ //para pasr el id del usuario q se registro al cuadro de texto oculto
    document.getElementById("codigo-oculto").value = valor
  }
  //Función para validar el formulario de usuarios y enviar los datos para el registro
  function registraUsuario(tipo){
    if (document.getElementById('BarraPrincipal').getAttribute("UserId") == 0) {
      var tipou = 6;
      var seguir = false;
    }else{
      AA = document.getElementById('BarraPrincipal').getAttribute("rol");
      var arreglo = AA.split(",");
      var tipou = AA[0]*1+1;
      var seguir = true;
    }
    var form_data = new FormData(); //Crear objeto de tipo formulario apra pasarlo al sertvidor con JSON
    const form = document.querySelector('#form-addUser');
    if (form.checkValidity()) {
      let cedula = $('#user-cedula').val();
      let apellidos = $('#user-nombres').val();
      let nombres = $('#user-apellidos').val();
      let sexo = $('#user-sexo').val();
      let correo = $('#user-email').val();
      let cuenta = $('#user-cuenta').val();
      let clave = $('#user-clave1').val();
      let accion = document.getElementById('user-edi').innerHTML;
      let usuario = document.getElementById('user-edi').name;
      let tipo = tipou
      let userid = document.getElementById('BarraPrincipal').getAttribute("userId");//Id del usuario logueado guardado como peropiedad de la barra principal
      var dato = { cedula,nombres,apellidos,sexo,correo,cuenta,clave,usuario,accion,tipo,userid  }
      // Agregar archivo al objeto FormData
      form_data.append('archivo', $('#user-fotografia')[0].files[0]);
      // Agregar JSON al objeto FormData
       form_data.append('data', JSON.stringify(dato));
      $.ajax({
        url: 'registrar_usuario.php',
        type: 'POST',
        data: form_data,
        contentType: false,
        processData: false,
        success: function(response) {
            //console.log(response)
             $('#form-addUser').trigger('reset');
            if (seguir) {
              listaUsuarios(AA);
              limpiarFormularioUsuarios();
            } else {
              Refrescar('formularios/confirmar_registro.html','areaprincipal')
              setTimeout(function() { // espero 2 segundos para pasar el dato al campo oculto del formulario
                pasavalor(response);
              }, 3000);
            }
        }
      });
    } else {
      form.reportValidity();
    }
  }
  //Para borrar un usuario, responde al evento OnClick del boton borrar en el formulario de usuarios
  function borrarUsuario(usuario){
    var AA = document.getElementById('BarraPrincipal').getAttribute("rol");
    let Dato = { usuario }
      $.post('borra_usuario.php',Dato,function(respuesta){
          listaUsuarios(AA);
      })
  }
  //Para editar un usuario, responde al evento OnClick del boton editar en el formulario de usuarios
  function editarUsuario(usuario){
    document.getElementById("user-eliminar").style.display = "block";
    let Dato = { usuario }
      limpiarFormularioUsuarios()
      $('#form-addUni').trigger('reset');
      document.getElementById("user-edi").innerHTML = "Actualizar";
      document.getElementById("user-edi").name = usuario;
      $.post('editar_usuario.php',Dato,function(respuesta){
         let resultados = JSON.parse(respuesta) 
        resultados.forEach(element => { //Recorrer todos los elementos del objeto
          document.getElementById("user-cedula").value = element.cedula
          document.getElementById("user-nombres").value = element.nombres
          document.getElementById("user-apellidos").value = element.apellidos
          document.getElementById("user-email").value = element.correo
          document.getElementById("user-cuenta").value = element.cuenta
          document.getElementById("fotografia").src = element.path
          document.getElementById("user-sexo").value = element.sexo
          document.getElementById("user-cedula").focus();
        })
      })
  }
  //Para limpiar el formulario de usuarios
  function limpiarFormularioUsuarios(){
    $imagenPrevisualizacion = document.querySelector("#fotografia");
    $('#form-addUser').trigger('reset');
    $imagenPrevisualizacion.src = "imagenes/i1.png";
    document.getElementById("user-edi").innerHTML = "Aceptar";
    habilitaFormulario(false)
  }
  //Para actualizar la fotografia del usuario al seleccionar un archivo
  function actualizaFotografia(){
    $imagenPrevisualizacion = document.querySelector("#fotografia");
  // Obtener referencia al input y a la imagen
    
  $seleccionArchivos = document.querySelector("#user-fotografia"),
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
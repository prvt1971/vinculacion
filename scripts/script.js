function Refrescar(archivo,contenedor){
  fetch(archivo)
  .then(response => response.text())
  .then(data => {
    document.getElementById(contenedor).innerHTML = data;
  });
}
// $imagenPrevisualizacion = document.querySelector("#logotipo");
// // Obtener referencia al input y a la imagen
	
// const $seleccionArchivos = document.querySelector("#logofile"),

// // Escuchar cuando cambie
// $seleccionArchivos.addEventListener("change", () => {
//   // Los archivos seleccionados, pueden ser muchos o uno
//   const archivos = $seleccionArchivos.files;
//   // Si no hay archivos salimos de la función y quitamos la imagen
//   if (!archivos || !archivos.length) {
//     $imagenPrevisualizacion.src = "";
//     return;
//   }
//   // Ahora tomamos el primer archivo, el cual vamos a previsualizar
//   const primerArchivo = archivos[0];
//   // Lo convertimos a un objeto de tipo objectURL
//   const objectURL = URL.createObjectURL(primerArchivo);
//   // Y a la fuente de la imagen le ponemos el objectURL
//   $imagenPrevisualizacion.src = objectURL;
//   window.alert("cambie");
// });

function actualizaImagen(){
  $imagenPrevisualizacion = document.querySelector("#logotipo");
// Obtener referencia al input y a la imagen
	
$seleccionArchivos = document.querySelector("#logofile"),

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
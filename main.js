var formulario = document.getElementById("formulario");
var contenido = document.getElementById("contenido");
var alerta = document.getElementById("alerta");
const imagen = document.getElementById("imagen");
var num = 0;
var num2 = Math.random()*99;
num2 = Math.floor(num2) 

function traer() {
    fetch('personas.json' + "?v=00" + num2++)
        .then(res => res.json())
        .then(datos => {
            contenido.innerHTML = `
     <div class="contenido">
     <img src="imagenes/mini/${datos[num]["finalName"]}" alt="Perfil">
        <p>ID : ${num}</p>
     <p>Nombre: ${datos[num].nombre}</p>
     <p>Apellido: ${datos[num].apellido}</p>
     <p>Edad: ${datos[num++]["edad"]} Años</p>
     </div> `;
            const numero = datos.length;
            if (num === numero) {
                num = 0;
            }
        })
}
formulario.addEventListener('submit', function (e) {
    e.preventDefault();
    var dates = new FormData(formulario);
    var nombre = dates.get('nombre');
    dates.get('apellido');
    formulario.reset()
    fetch('archivo.php', {
        method: 'POST',
        body: dates
    })
    .then(res => res.json())
    .then(data => {
      if(data === 'error'){
        alerta.innerHTML = `<div class="resultado red_alert">Formato no valido: por favor use estos formatos [PNG|JPG|WEBP|GIF]</div>`;
      }else{
        alerta.innerHTML = `<div class="resultado">${data}</div>`;
      }
    })
  })
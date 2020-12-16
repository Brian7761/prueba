document.getElementById("icon-menu").addEventListener("click", mostrar_menu);

function mostrar_menu(){
    document.getElementById("move-content").classList.toggle('move-container-all');
    document.getElementById("show-menu").classList.toggle('show-lateral');

}




let i = 0;
const showMoreInfo = (value) => {

  if (!i) {

    let element = document.getElementById(`mi-super-contenido-${value}`);

    element.classList.remove("hideInfo");
    element.classList.add("showInfo");
 
    document.getElementsByClassName(`button-${value}`)[0].innerHTML =
      "Leer Menos";
    i = 1;

  } else {
 
    let element = document.getElementById(`mi-super-contenido-${value}`);

    element.classList.remove("showInfo");

    element.classList.add("hideInfo");

    document.getElementsByClassName(`button-${value}`)[0].innerHTML = "Leer Mas";
    i = 0;
  }
};






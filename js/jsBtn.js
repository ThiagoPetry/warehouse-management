function admin(y) {
    var vetor = ["cad", "atu", "log"];
    for(x = 0; x < vetor.length; x++) {
        document.getElementById(vetor[x]).style.display = "none";    
    }
    var btn = y;
    document.getElementById(btn).style.display = "block";
}

function fechaTela(x) {
    var tela = x;
    document.getElementById(tela).style.display = "none";
}

function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
        }
    }
  }
}
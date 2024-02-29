let prevScrollPos = window.pageYOffset;

window.onscroll = function() {
    let currentScrollPos = window.pageYOffset;

    if (prevScrollPos > currentScrollPos) {
        document.querySelector('.menu_container').style.opacity = '1';
    } else {
        document.querySelector('.menu_container').style.opacity = '0'; /* Altura del header */
    }

    prevScrollPos = currentScrollPos;
}

function goback(){
    window.history.back();
}

function buscarEnBaseDeDatos() {
    var campo = document.getElementById("campo").value;

    // Verificar si el campo de búsqueda no está vacío
    if (campo.trim() !== "") {
        // Enviar la solicitud al servidor PHP con el término de búsqueda
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Mostrar los resultados en el contenedor especificado
                document.getElementById("resultadosBusqueda").innerHTML = xhr.responseText;
            }
        };
        xhr.open("GET", "busqueda.php?campo=" + campo, true);
        xhr.send();
    } else {
        // Limpiar los resultados si el campo de búsqueda está vacío
        document.getElementById("resultadosBusqueda").innerHTML = "";
    }
}

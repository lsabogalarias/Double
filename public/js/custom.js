window.addEventListener('DOMContentLoaded', function() {
    const divError = document.getElementById('error_username');
  
    if (divError) {
      divError.style.visibility = 'hidden';
      divError.style.height = '0';
      divError.style.padding = '0';
      divError.style.margin = '0';
    }
    
});

// Método encargado de validar el input user.login  
function validarCampo(event) {
    const valor = event.target.value.toLowerCase(); // Convertir el valor a minúsculas
    const prohibido = 'doublevpartner';
    const divError = document.getElementById('error_username');
  
    if (valor.length < 4) {
        event.target.value = ''; // Limpiar el campo si tiene menos de 4 caracteres
      
        if (divError) {
            divError.style.visibility = 'visible'; // Mostrar el div de error
        }
    } else if (valor.includes(prohibido)) {
        event.target.value = ''; // Limpiar el campo si se encuentra la cadena prohibida
      
        if (divError) {
            divError.style.visibility = 'visible'; // Mostrar el div de error
        }
    } else {
      if (divError) {
        divError.style.visibility = 'hidden'; // Ocultar el div si no hay errores
      }
    }
}
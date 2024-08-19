let navbar = document.querySelector('.header .navbar');

document.querySelector('#menu-btn').onclick = () =>{
    navbar.classList.add('active');
}

document.querySelector('#nav-close').onclick = () =>{
    navbar.classList.remove('active');
}

let searchForm = document.querySelector('.search-form');

document.querySelector('#search-btn').onclick = () =>{
    searchForm.classList.add('active');
}

document.querySelector('#close-search').onclick = () =>{
    searchForm.classList.remove('active');
}

window.onscroll = () =>{
    navbar.classList.remove('active');

    if(window.scrollY > 0){
        document.querySelector('.header').classList.add('active');
    }else{
        document.querySelector('.header').classList.remove('active');
    }
};

window.onload = () =>{
    if(window.scrollY > 0){
        document.querySelector('.header').classList.add('active');
    }else{
        document.querySelector('.header').classList.remove('active');
    }
};


var swiper = new Swiper(".home-slider", {
    loop: true,
    grabCursor: true,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});

var swiper = new Swiper(".product-slider", {
    loop: true,
    grabCursor: true,
    spaceBetween: 20,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    breakpoints: {
        0: {
            slidesPerView: 1,
        },
        640: {
            slidesPerView: 2,
        },
        768: {
            slidesPerView: 3,
        },
        1024: {
            slidesPerView: 4,
        },
    },
});

var swiper = new Swiper(".review-slider", {
    loop: true,
    grabCursor: true,
    spaceBetween: 20,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    breakpoints: {
        0: {
            slidesPerView: 1,
        },
        640: {
            slidesPerView: 2,
        },
        768: {
            slidesPerView: 3,
        },
    },
});

var swiper = new Swiper(".blogs-slider", {
    loop: true,
    grabCursor: true,
    spaceBetween: 10,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    breakpoints: {
        0: {
            slidesPerView: 1,
        },
        768: {
            slidesPerView: 2,
        },
        991: {
            slidesPerView: 3,
        },
    },
});

var swiper = new Swiper(".clients-slider", {
    loop: true,
    grabCursor: true,
    spaceBetween: 20,
    breakpoints: {
        0: {
            slidesPerView: 1,
        },
        640: {
            slidesPerView: 2,
        },
        768: {
            slidesPerView: 3,
        },
        1024: {
            slidesPerView: 4,
        },
    },
});

//CONFIRMAR SI EL USUARIO QUIERE CERRAR SESION
function confirmLogout(event) {
    event.preventDefault();

    Swal.fire({
        title: '¿Estás seguro de que quieres cerrar sesión?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Cerrar sesión',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('logout-form').submit();
        }
    });
}



// Obtener los elementos del modal y el campo de viaje
const modal = document.getElementById("modalForm");
const closeModalBtn = document.querySelector(".close");
const viajeInput = document.getElementById("viaje");
const fechaPagarInput = document.getElementById("fecha_pagar");

// Función para abrir el modal y establecer el título del viaje
function openModal(tituloViaje, fechaSalida) {
    modal.style.display = "block";
    viajeInput.value = tituloViaje;
    viajeInput.readOnly = true;  // Establece el campo de viaje como readonly
    document.body.classList.add("modal-open");  // Añade la clase para ocultar el scroll

    // Obtener la fecha actual y la fecha de salida
    const now = new Date();
    const fechaSalidaDate = new Date(fechaSalida);

    // Asegúrate de que la fecha de salida sea una fecha válida
    if (isNaN(fechaSalidaDate.getTime())) {
        console.error('Fecha de salida no válida');
        return;
    }

    // Configurar los límites de la fecha y hora
    const minDate = new Date(now);
    const minDateString = minDate.toISOString().slice(0, 16); // Formato YYYY-MM-DDTHH:MM

    // Configurar el rango permitido para la hora
    const minHour = "10:00";
    const maxHour = "18:00";
    const maxDate = new Date(fechaSalidaDate);
    maxDate.setHours(18, 0, 0); // Establecer la hora máxima en la fecha de salida
    const maxDateString = maxDate.toISOString().slice(0, 16); // Formato YYYY-MM-DDTHH:MM

    // Aplicar los valores al campo
    fechaPagarInput.min = minDateString;
    fechaPagarInput.max = maxDateString;
}

// Función para cerrar el modal
closeModalBtn.onclick = function() {
    modal.style.display = "none";
    document.body.classList.remove("modal-open");  // Quita la clase para reactivar el scroll
}

// Cerrar el modal si se hace clic fuera de él
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
        document.body.classList.remove("modal-open");  // Quita la clase para reactivar el scroll
    }
}

// Ejemplo de cómo se podría llamar la función openModal
// Deberías reemplazar esto con el evento real que llama a la función openModal
// Ejemplo de llamada: openModal('Viaje a la playa', '2024-08-25T12:00');

//==============================================================================
// Archivo: /js/modalImg.js
// Autor: Federico Ramos <federico.g.ramos@gmail.com>
// Modificado: 20241126 0110
//
// Los siguientes archivos forman parte de una librería para desplegar imágenes
// del tipo popup:
// # modalImg.php
// # ./js/modalImg.js
// # ./css/modalImg.css
//==============================================================================


// Globals =====================================================================

var currentModal = 0;
var listenersEnabled = 0;// Si no uso este flag, el primer abre y cierra.
var slideIndex = 0;


//==============================================================================
// Receives:
// # modalIndex = html may have multiple groups of images. To identify each.

function openModal(modalIndex) {
    currentModal = modalIndex;
    window.addEventListener("click", clickListener, false);
    window.addEventListener("keyup", keyListener, false);
//    object.addEventListener("keypress", myScript);

    document.getElementById("modal_" + modalIndex).style.display = "-webkit-inline-box";
    // De esta manera se ubica verticalmente centrado.
}


//==============================================================================
// Receives:
// # modalIndex = html may have multiple groups of images. To identify each.

function closeModal(modalIndex) {
    document.getElementById("modal_" + modalIndex).style.display = "none";
    window.removeEventListener("click", clickListener, false);
    window.removeEventListener("keyup", keyListener, false);
    listenersEnabled = 0;
}


//==============================================================================
// Next-previous controls

function plusSlides(n) {
    showSlides(slideIndex += n);
}


//==============================================================================
// Thumbnail image controls
function currentSlide(n) {
    showSlides(slideIndex = n);
}


//==============================================================================

function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("slides_"+currentModal);
    var vSlideImg = document.getElementsByClassName("slideImg_"+currentModal);
    //var ctrl = document.getElementsByClassName("modalImgCtrl");
    var ctrl = document.getElementsByClassName("modalImgCtrl_"+currentModal);

    var captionText = document.getElementById("caption_"+currentModal);

    if(n > slides.length-1) slideIndex = 0;
    if(n < 0) slideIndex = slides.length-1;
    for(i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
    }
    for (i = 0; i < ctrl.length; i++) {
    ctrl[i].className = ctrl[i].className.replace(" active", "");
    }

    slides[slideIndex].style.display = "block";
    ctrl[slideIndex].className += " active";
    captionText.innerHTML = ctrl[slideIndex].alt;

    // Activa el src solo cuando se selecciona (hace que no se descargue imagen
    // al divino boton).
    var hiddenImgSrc = vSlideImg[slideIndex].getAttribute("data-src");
    vSlideImg[slideIndex].setAttribute("src", hiddenImgSrc);	
}


//==============================================================================

function clickListener(e) {
    if(listenersEnabled) {// inside
        if(document.getElementById("modalContent_"+currentModal).contains(e.target)) {
        }
        else {// outside
            closeModal(currentModal);
        }
     }
    else {
        listenersEnabled = 1;
    }
}


//==============================================================================
// Receives:
// # e = key

function keyListener(e) {
    if(e.key === "Escape") {
         closeModal(currentModal);
    }
    else if(e.key === "ArrowLeft") {
        plusSlides(-1);
    }
    else if(e.key === "ArrowRight") {
        plusSlides(1);
    }
}











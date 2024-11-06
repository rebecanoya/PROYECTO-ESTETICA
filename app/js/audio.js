let estado = false;
const reproductor = new Audio("audio/softpianomezcla.mp3");
const audioButton = document.getElementById("audio");
reproductor.muted = true;
reproductor.loop = true;
reproductor.volume = 1;

audioButton.addEventListener("click", () => {

    if (reproductor.paused) {
        reproductor.play();
    }
    estado = !estado;
    reproductor.muted = !estado;
    if (estado) {
        audioButton.classList.remove("fa-volume-xmark");
        audioButton.classList.add("fa-volume-high");
    } else {
        audioButton.classList.remove("fa-volume-high");
        audioButton.classList.add("fa-volume-xmark");
    }
    console.log(reproductor.muted);
});
reproductor.addEventListener("ended", () => {

    reproductor.currentTime = 0;
    reproductor.play();

});

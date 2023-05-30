/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const openCameraButton = document.getElementById("open-camera-btn");
    const saveSnapButton = document.querySelector(".capture-btn");
    const recordForm = document.getElementById("record-form");
    const fileNameSpan = document.getElementById("file-name");
    const submitButton = document.getElementById("record-submit-button");
    const cameraContainer = document.querySelector(".camera-container");
    const formSelect = document.querySelector(".form-select");
    const fileInput = document.querySelector(".file-input");
    const myCamera = document.getElementById("my-camera")

    function configure() {
        cameraContainer.classList.remove("hidden");
        submitButton.scrollIntoView({ behavior: "smooth" });
        Webcam.set({
            width: 580,
            height: 440,
            image_format: "png",
            png_quality: 90
        });

        Webcam.attach("#my-camera");

    }

    function saveSnap() {
        saveSnapButton.classList.add("hidden");
        myCamera.classList.add("hidden");

        Webcam.snap(function(data_uri) {
            document.getElementById("results").innerHTML = '<img id="webcam" src="'+ data_uri +'">';
            submitButton.disabled = false;
        });

        Webcam.reset();

        let base64image = document.getElementById("webcam").src;
        document.getElementById("image-input").value = base64image;
    }

    saveSnapButton.addEventListener("click", saveSnap);

    fileInput.addEventListener("change", (event) => {
    const files = event.target.files;
    handleFormValidation();
    if (files.length > 0) {
        fileNameSpan.textContent = files[0].name;
    } else {
        fileNameSpan.textContent = "Escolher um arquivo";
    }
    });

    submitButton.addEventListener("click", (event => {
        recordForm.submit();
        alert("Imagem cadastrada!");
    }))

    function handleFormValidation() {
    if (formSelect.value !== "Selecione um usuário" && fileInput.files.length > 0) {
        submitButton.disabled = false;
    } else {
        submitButton.disabled = true;
    }
    }

    formSelect.addEventListener("change", handleFormValidation);

    openCameraButton.addEventListener("click", configure);





/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// import Pusher from 'pusher-js';
// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
//     wsHost: import.meta.env.VITE_PUSHER_HOST ? import.meta.env.VITE_PUSHER_HOST : `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// });



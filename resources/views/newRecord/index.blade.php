@extends('layouts.app')

@section("content")
<div class="new-record-page-container">
    <h1 class="new-record-page-title">Cadastrar imagem</h1>
    <div id="record-form-container">
        <form id="record-form" action="{{ route('createRecord') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <p class="select-title">Informe o usuário</p>
            <select class="form-select" name="select" id="">
                <option value="Selecione um usuário">Selecione um usuário</option>
                @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            <label class="file-input-label">
                <ion-icon class="cloud-upload" name="cloud-upload"></ion-icon>
                <span id="file-name">Escolher um arquivo</span>
                <input class="file-input" type="file" name="upload-image">
              </label>
            <input type="hidden" id="image-input" name="image">
        </form>
        <p class="division-text">Ou</p>
        <button id="open-camera-btn"><ion-icon class="camera-icon" name="camera"></ion-icon>Usar a câmera</button>
        <div class="camera-container hidden">
             <div id="my-camera"></div>
             <button class="capture-btn"><ion-icon class="capture-camera-icon" name="camera"></ion-icon></button>
             <div id="results"></div>
        </div>
        <button id="record-submit-button" disabled>Enviar</button>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>

<script>
    // const openCameraButton = document.getElementById("open-camera-btn");
    // const saveSnapButton = document.querySelector(".capture-btn");
    // const recordForm = document.getElementById("record-form");
    // const fileNameSpan = document.getElementById("file-name");
    // const submitButton = document.getElementById("record-submit-button");
    // const cameraContainer = document.querySelector(".camera-container");
    // const formSelect = document.querySelector(".form-select");
    // const fileInput = document.querySelector(".file-input");
    // const myCamera = document.getElementById("my-camera")

    // function configure() {
    //     cameraContainer.classList.remove("hidden");
    //     submitButton.scrollIntoView({ behavior: "smooth" });
    //     Webcam.set({
    //         width: 580,
    //         height: 440,
    //         image_format: "png",
    //         png_quality: 90
    //     });

    //     Webcam.attach("#my-camera");

    // }

    // function saveSnap() {
    //     saveSnapButton.classList.add("hidden");
    //     myCamera.classList.add("hidden");

    //     Webcam.snap(function(data_uri) {
    //         document.getElementById("results").innerHTML = '<img id="webcam" src="'+ data_uri +'">';
    //         submitButton.disabled = false;
    //     });

    //     Webcam.reset();

    //     let base64image = document.getElementById("webcam").src;
    //     document.getElementById("image-input").value = base64image;
    // }

    // saveSnapButton.addEventListener("click", saveSnap);

    // fileInput.addEventListener("change", (event) => {
    // const files = event.target.files;
    // handleFormValidation();
    // if (files.length > 0) {
    //     fileNameSpan.textContent = files[0].name;
    // } else {
    //     fileNameSpan.textContent = "Escolher um arquivo";
    // }
    // });

    // submitButton.addEventListener("click", (event => {
    //     recordForm.submit();
    //     alert("Imagem cadastrada!");
    // }))

    // function handleFormValidation() {
    // if (formSelect.value !== "Selecione um usuário" && fileInput.files.length > 0) {
    //     submitButton.disabled = false;
    // } else {
    //     submitButton.disabled = true;
    // }
    // }

    // formSelect.addEventListener("change", handleFormValidation);

    // openCameraButton.addEventListener("click", configure);
</script>
@endsection

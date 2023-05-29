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
            <video id="camera-preview" autoplay></video>
            <button id="capture-btn"><ion-icon class="capture-camera-icon" name="camera"></ion-icon></button>
        </div>
        <button id="record-submit-button">Enviar</button>
    </div>
</div>

<script>
    // Get the necessary DOM elements
    const cameraPreview = document.getElementById("camera-preview");
    const openCameraButton = document.getElementById("open-camera-btn");
    const captureButton = document.getElementById("capture-btn");
    const recordForm = document.getElementById("record-form");
    const fileInput = document.querySelector(".file-input");
    const imageInput = document.getElementById("image-input");
    const fileNameSpan = document.getElementById("file-name");
    const submitButton = document.getElementById("record-submit-button");
    const cameraContainer = document.querySelector(".camera-container");

    fileInput.addEventListener("change", (event) => {
    const files = event.target.files;
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

    // Function to open the camera
    function openCamera() {
        // Access the device camera
        cameraContainer.classList.remove("hidden");
        captureButton.scrollIntoView({ behavior: "smooth" });
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(stream => {
                // Set the camera stream as the source for the video element
                cameraPreview.srcObject = stream;
                // Enable the capture and submit buttons
                captureButton.disabled = false;
                // recordForm.querySelector("button[type="submit"]").disabled = false;
            })
            .catch(error => {
                console.error("Error accessing camera:", error);
            });
    }

    // Function to capture the picture
    function capturePicture() {
        const canvas = document.createElement("canvas");
        const context = canvas.getContext("2d");
        canvas.width = cameraPreview.videoWidth;
        canvas.height = cameraPreview.videoHeight;
        context.drawImage(cameraPreview, 0, 0, canvas.width, canvas.height);

        // Convert the canvas image to a Data URL
        const imageDataUrl = canvas.toDataURL("image/png");

        // Set the image data as the value of the hidden input field
        imageInput.value = imageDataUrl;

        recordForm.submit();
        alert("Imagem cadastrada!");
    }

    // Add event listener to the open camera button
    openCameraButton.addEventListener("click", openCamera);

    // Add event listener to the capture button
    captureButton.addEventListener("click", capturePicture);
</script>
@endsection

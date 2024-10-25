const modalfoto = document.getElementById('cont_alertamodal');
const inputGroupFileAddon03 = document.getElementById('inputGroupFileAddon03');

inputGroupFileAddon03.addEventListener('click', function() {
    modalfoto.innerHTML = '<div class="modal fade" id="alertaModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">'+
                                '<div class="modal-dialog" role="document">'+
                                    '<div class="modal-content">'+
                                        //'<div class="modal-header alert alert-info" role="alert">'+
                                               //'<h5 class="modal-title" id="ModalLabel"> FOTO </h5>'+
                                        //'</div>'+
                                        '<div class="modal-body p-0 m-0">'+
                                               '<video id="video">Câmera não disponível.</video>'+
                                        '</div>'+
                                        '<div class="modal-footer">'+
                                               //'<button id="startButton">Start</button>'+
                                               '<button id="captureButton">Capturar</button>'+
                                               '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>';
  chamaModal();
})

function chamaModal(){
  myModal = new bootstrap.Modal(document.getElementById('alertaModal'), {
      keyboard: true
  })
  myModal.show()
  capturaFoto()
}

function capturaFoto(){
    const video = document.getElementById('video');
    const inputFile = document.getElementById('upCarteira');

    navigator.mediaDevices.getUserMedia({ video: true })
    .then((stream) => {
        video.srcObject = stream;
        video.play();

        video.width = 335;
        //video.height = 200;

        capturar = document.getElementById('captureButton');
        capturar.addEventListener('click', () => {

            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');

            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;

            context.drawImage(video, 0, 0, canvas.width, canvas.height);

            const imageUrl = canvas.toDataURL();
            
            const capturedImage = document.createElement('img');
            capturedImage.src = imageUrl;

            video.parentNode.removeChild(video);
            document.body.appendChild(capturedImage);

            stream.getTracks().forEach(track => track.stop());

            const file = dataURLtoFile(imageUrl, 'captured-image.png');
            const fileList = new DataTransfer();
            fileList.items.add(file);
            inputFile.files = fileList.files;        

            const event = new Event('change', { bubbles: true });
            inputFile.dispatchEvent(event);
            myModal.hide();
            
        });
    })
    .catch((error) => {
        console.error('Erro ao acessar a câmera:', error);
    });
  
}

function dataURLtoFile(dataUrl, filename) {
    const arr = dataUrl.split(',');
    const mime = arr[0].match(/:(.*?);/)[1];
    const bstr = atob(arr[1]);
    let n = bstr.length;
    const u8arr = new Uint8Array(n);
    while (n--) {
        u8arr[n] = bstr.charCodeAt(n);
    }
    return new File([u8arr], filename, { type: mime });
}


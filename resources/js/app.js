import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
])

// MODAL
const deleteBtns = document.querySelectorAll(".btn-delete");

if(deleteBtns.length > 0) {
    deleteBtns.forEach((btn) => {
        btn.addEventListener("click", function(event) {
            event.preventDefault();
            const projectTitle = btn.getAttribute("data-project-title");

            const deleteModal = new bootstrap.Modal(document.getElementById("delete-modal"));

            document.getElementById("project-title").innerText = projectTitle;
            document.getElementById("action-delete").addEventListener("click", function() {
                btn.parentElement.submit();
            });
            deleteModal.show();
        });
    });
}

// PREVIEW
// Trovo l'elemento image-input
const imageInput = document.getElementById("image-input");
const imagePreview = document.getElementById("image-preview");

// se l'elemento è trovato:
if (imageInput && imagePreview) {
    
    // Al change del valore di image input
    imageInput.addEventListener('change', function() {
        console.log("image change", this.files[0]);

        // leggo il file inserito
        const selectedFile = this.files[0];
        const reader = new FileReader();
        reader.addEventListener('load', function() {

            // metto il file nel src del elemento preview
            console.log("lettura completata", reader.result); // i dati sono in base64

            // visualizzo immagine
            imagePreview.src = reader.result;
            imagePreview.classList.remove('d-none');
        });
        reader.readAsDataURL(selectedFile);
        
    });
}


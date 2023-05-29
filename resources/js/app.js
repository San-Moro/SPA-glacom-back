import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
])

//preview management of uploaded images
const coverImageInput = document.getElementById('cover_image');
const imagePreview = document.getElementById('img_preview');

coverImageInput.addEventListener('change', function() {
    //console.log("change", this.files[0]);
    const uploadedFile = this.files[0];
    if(uploadedFile) {
        const reader = new FileReader();
        reader.addEventListener('load', function() {
            imagePreview.src = reader.result;
        });
        reader.readAsDataURL(uploadedFile);
    }
});
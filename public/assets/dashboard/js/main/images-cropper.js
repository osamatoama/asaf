class ImagesCropper {
    constructor(dropzone, dropzoneWrapper, cropperOptions, recommendedSize) {
        this.currentDropzone = dropzone;
        this.imgCropperOptions = cropperOptions;
        this.currentDropzoneWrapper = dropzoneWrapper;
        this.storedTemporaryImages = [];
        this.storedCroppedImages = [];
        this.currentCropper = null;
        this.isProcessing = false;
        this.recommendedImgSize = recommendedSize;
    }

    generateCropModalsMarkup() {
        const recommendedSizeMarkup = `<p class="recommended-img-size fs-6 text-info mb-3">الحجم المفضل هو ${this.recommendedImgSize.width} * ${this.recommendedImgSize.height}</p>`;
        const cropModalMarkup = `
            <div class="modal fade" id="cropImgModal" tabindex="-1" role="dialog" aria-labelledby="cropImgModal"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">تعديل الصورة</h5>
                        <span class="close-crop-modal">
                            <em class="icon ni ni-cross-circle fs-2"></em>
                        </span>
                    </div>
                    <div class="modal-body position-relative">
                    ${this.recommendedImgSize ? recommendedSizeMarkup : ""}
                        <div class="uploaded-image-container position-relative">
                            <span class="dimensions w-auto position-absolute d-flex justify-content-center align-items-center bg-light bg-gradient rounded-2"></span>
                            <div class="position-relative w-100">
                                <img class="mw-100" id="croper-uploaded-img" src="" alt="crop">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger skip-cropper-btn">تخطي</button>
                        <button type="button" class="btn btn-secondary next-cropper-btn">التالي</button>
                    </div>
                </div>
            </div>
        </div>
        `;

        const confirmModalMarkup = `
            <div class="modal fade" id="confirmCloseCropModal" tabindex="-1" role="dialog" aria-labelledby="confirmCloseCropModal"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-top" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">هل أنت متأكد؟</h5>
                    </div>
                    <div class="modal-body position-relative">
                        <p class="fs-6">هل تريد إلغاء عملية إضافة الصور؟</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger confirm-close-modal-btn">تأكيد</button>
                        <button type="button" class="btn btn-secondary cancel-closing-modal-btn">إلغاء</button>
                    </div>
                </div>
            </div>
        </div>
        `;

        return {cropModalMarkup, confirmModalMarkup};
    };

    attatchModalsAndEvents(isMultiple) {
        if (!document.getElementById("cropImgModal")) {
            this.isProcessing = false;
            document.querySelector(".crop-modal-wrapper").insertAdjacentHTML("afterbegin", this.generateCropModalsMarkup().cropModalMarkup);
            document.querySelector(".crop-modal-wrapper").insertAdjacentHTML("beforeend", this.generateCropModalsMarkup().confirmModalMarkup);

            isMultiple
                ? document.querySelector("#cropImgModal .skip-cropper-btn").classList.remove("d-none")
                : document.querySelector("#cropImgModal .skip-cropper-btn").classList.add("d-none");

            document.querySelector("#cropImgModal .next-cropper-btn").addEventListener("click", () => {
                this.confirmCropImgHandler();
            });
            document.querySelector("#cropImgModal .skip-cropper-btn").addEventListener("click", () => {
                this.skipCroppingHandler();
            });
            document.querySelector("#cropImgModal .close-crop-modal").addEventListener("click", () => {
                this.toggleConfirmModalHandler();
            });
            document.querySelector("#confirmCloseCropModal .cancel-closing-modal-btn").addEventListener("click", () => {
                this.toggleConfirmModalHandler();
            });
            document.querySelector("#confirmCloseCropModal .confirm-close-modal-btn").addEventListener("click", () => {
                this.closeCropModalHandler();
            });
        }
    }

    toggleCropperModal = () => {
        const cropperModal = document.querySelector(".crop-modal-wrapper #cropImgModal");
        const confirmModal = document.querySelector(".crop-modal-wrapper #confirmCloseCropModal");
        if (this.storedTemporaryImages.length === 0) {
            document.body.style.overflow = "initial";
            cropperModal.remove();
            confirmModal.remove();
        }
        if (cropperModal.classList.contains("show")) {
            return;
        }
        document.body.style.overflow = "hidden";
        cropperModal.style.display = "block";
        cropperModal.classList.add("show");
    };

    toggleLoaderOverlay() {
        if (this.currentDropzoneWrapper.querySelector('.crop-loader-overlay')) {
            this.currentDropzoneWrapper.querySelector('.crop-loader-overlay').remove();
        } else {
            const loaderOverlayMarkup = `
                <div class="crop-loader-overlay w-100 h-100 d-flex justify-content-center align-items-center position-absolute top-0 start-0 end-0">
                    <em class="icon ni ni-loader text-white"></em>
                </div>
            `;
            this.currentDropzoneWrapper.insertAdjacentHTML("beforeend", loaderOverlayMarkup);
        }
    }

    prepareImageCropper() {
        this.toggleCropperModal();
        if (
            this.isProcessing ||
            (this.storedTemporaryImages.length === 0 &&
                this.storedCroppedImages.length === 0)
        ) {
            return;
        }

        if (this.storedTemporaryImages.length === 0 && this.storedCroppedImages.length > 0) {
            this.toggleLoaderOverlay();
            this.uploadCroppedImages();
            return;
        }

        const uploadedImg = document.querySelector("#cropImgModal #croper-uploaded-img");
        this.currentCropper?.destroy();
        uploadedImg.src = this.storedTemporaryImages[0].result;
        uploadedImg.addEventListener('crop', (event)=> {
            if (document.querySelector("#cropImgModal .dimensions")) {
                document.querySelector("#cropImgModal .dimensions").innerHTML = `${Math.trunc(event.detail.width)}*${Math.trunc(event.detail.height)}`;
            }
        });
        this.currentCropper = new Cropper(uploadedImg, this.imgCropperOptions);
    }

    thumbnailsHandler(file) {
        if (file.cropped) {
            return;
        }
        let cachedFilename = file.name;
        const allUploadedFilesLength = this.currentDropzone.getAcceptedFiles().length;
        this.currentDropzone.removeFile(file);
        this.attatchModalsAndEvents(allUploadedFilesLength > 1 ? true : false);
        const reader = new FileReader();
        reader.onloadend = () => {
            reader.cachedFilename = cachedFilename;
            this.storedTemporaryImages.push(reader);
            this.prepareImageCropper();
            this.isProcessing = true;
        };
        reader.readAsDataURL(file);
    }

    dataURItoBlob = (dataURI) => {
        let byteString = atob(dataURI.split(",")[1]);
        let ab = new ArrayBuffer(byteString.length);
        let ia = new Uint8Array(ab);
        for (let i = 0; i < byteString.length; i++) {
            ia[i] = byteString.charCodeAt(i);
        }
        return new Blob([ab], { type: "image/jpeg" });
    };

    cropAndStoreImg() {
        const blob = this.currentCropper.getCroppedCanvas().toDataURL("image/jpeg", 0.9);
        const newFile = this.dataURItoBlob(blob);
        newFile.cropped = true;
        newFile.name = this.storedTemporaryImages[0].cachedFilename;
        this.storedCroppedImages.push(newFile);
    }

    confirmCropImgHandler() {
        this.cropAndStoreImg();
        this.storedTemporaryImages.shift();
        this.isProcessing = false;
        this.prepareImageCropper();
    }

    checkImgCompleteUploading() {
        if (this.storedCroppedImages.length > 0) {
            this.storedCroppedImages.shift();
            this.isProcessing = false;
            if (this.storedCroppedImages.length > 0) {
                this.uploadCroppedImages();
            } else {
                this.toggleLoaderOverlay();
            }
        }
    }

    skipCroppingHandler() {
        this.storedTemporaryImages.shift();
        this.isProcessing = false;
        this.prepareImageCropper();
    }

    uploadCroppedImages() {
        if (!this.isProcessing) {
            this.currentDropzone.addFile(this.storedCroppedImages[0]);
            this.currentDropzone.processQueue();
            this.isProcessing = true;
        }
    }

    toggleConfirmModalHandler() {
        const confirmModal = document.querySelector('.crop-modal-wrapper #confirmCloseCropModal');
        if (confirmModal.classList.contains('show')) {
            confirmModal.classList.remove('show');
            confirmModal.style.display = "none";
        } else {
            confirmModal.classList.add('show');
            confirmModal.style.display = "block";
        }
    }

    closeCropModalHandler() {
        this.storedTemporaryImages = [];
        this.storedCroppedImages = [];
        this.toggleConfirmModalHandler();
        this.toggleCropperModal();
    }
}

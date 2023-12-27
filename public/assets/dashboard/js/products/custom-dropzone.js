function imgControlsMarkup(previewElement) {
    let isValidImg = previewElement.classList.contains('valid-img');

    const imgControlsMarkup = `
    <div class="dz-img-controls p-1 d-flex justify-content-between align-items-center gap-2 h-100">
        <div class="default-img-wrapper d-flex align-items-center gap-1 h-100 ${isValidImg ? 'is-valid-img' : 'disabled'}">
            <div class="default-img-checkbox">
                <input ${isValidImg ? '' : 'disabled'} type="checkbox" class="default-img-inp">
                <span class="checkmark text-muted d-flex justify-content-between align-items-center">
                    <em class="icon ni ni-check-thick d-none fs-6"></em>
                </span>
            </div>
            <span class="default-text">الصورة الرئيسية</span>
        </div>
        <span class="dz-custom-remove d-flex justify-content-center align-items-center w-auto">
            <em class="icon ni ni-trash"></em>
        </span>
    </div>
    `
    return imgControlsMarkup;
}

function setImgName(previewElement, responseName) {
    previewElement.classList.add('valid-img')
    previewElement.dataset.name = responseName;
}

function setDefaultImgValue(defaultImg = null) {
    if (defaultImg?.dataset.name) {
        document.querySelector(".product-default-img-name-inp").value = defaultImg.dataset.name;
    } else {
        document.querySelector(".product-default-img-name-inp").value = '';
    }
}

function setDefaultImg() {
    const defaultImgName = document.querySelector(".product-default-img-name-inp").value;
    const defaultImg = document.querySelector(`.dz-preview.valid-img[data-name='${defaultImgName}']`);
    const firstValidImg = document.querySelector('.dz-preview.valid-img');
    if (defaultImgName && defaultImg) {
        defaultImg.classList.add('is-default');
        defaultImg?.querySelector('.default-img-inp')?.click();
    }
    if (!defaultImgName && firstValidImg) {
        firstValidImg.querySelector('.default-img-inp')?.click();
        firstValidImg.classList.add('is-default');
        setDefaultImgValue(firstValidImg);
    }
}

function handleDefaultImgChecking(clickedInp) {
    document.querySelectorAll('.default-img-inp').forEach((inp)=>{
        inp.checked = false;
        inp.closest('.dz-img-controls').classList.remove('active');
        inp.closest('.dz-preview.valid-img')?.classList.remove('is-default');
    })
    clickedInp.checked = true
    clickedInp.closest('.dz-img-controls').classList.add('active');
    clickedInp.closest('.dz-preview.valid-img').classList.add('is-default');
    setDefaultImgValue(clickedInp.closest(".dz-preview"));
}

function attachImgControls (previewElement) {
    previewElement.querySelector('.dz-remove').classList.add('d-none');

    previewElement.insertAdjacentHTML('beforeend', imgControlsMarkup(previewElement));

    setDefaultImg();

    previewElement.querySelector('.dz-custom-remove').addEventListener('click', function(){
        if (this.closest('.dz-preview').classList.contains('is-default')) {
            document.querySelector(".product-default-img-name-inp").value = '';
        }
        previewElement.querySelector('.dz-remove').click();
        setDefaultImg();
    });


    previewElement.querySelector('.is-valid-img .default-img-checkbox')?.addEventListener('click', function (){
        this.querySelector('.default-img-inp').click();
    });

    previewElement.querySelector('.default-img-inp').addEventListener('change', function (){
        handleDefaultImgChecking(this);
    });
}

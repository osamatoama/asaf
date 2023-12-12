function generateIframe(src) {
    const iframeMarkup = `
        <iframe
            src="${src}"
            loading="lazy"
            title="Gold Boulevard Products"
            width="100%"
            height="550"
            frameborder="0"
            allow="clipboard-read; clipboard-write"
            scrolling="no"
        ></iframe>
    `;
    navigator.clipboard.writeText(iframeMarkup);
    NioApp.Toast('تم نسخ الفريم بنجاح، يمكنك الآن استخدامه في موقعك.', 'success');
}

function updateIframeUrl (queryMenu) {
    const copyBtn = document.querySelector('#iframe-queries-modal .modal-copy-iframe-btn');
    let iframeUrl = copyBtn.dataset.iframeSrc;
    if (iframeUrl.includes('?')) {
        iframeUrl += '&';
    } else {
        iframeUrl += '?';
    }
    iframeUrl+= `${queryMenu.dataset.queryName}=${queryMenu.value}`;
    copyBtn.dataset.iframeSrc = iframeUrl;
}

document.querySelector('.modal-copy-iframe-btn')?.addEventListener('click', function () {
    generateIframe(this.dataset.iframeSrc);
    this.closest('#iframe-queries-modal').querySelector('form').reset();
    this.closest('#iframe-queries-modal').querySelector('[data-bs-dismiss]').click();
});

document.querySelectorAll('.product-query-string').forEach((query) => {
    query.addEventListener('change', function () {
        updateIframeUrl(this);
    });
});

document.querySelector('#iframe-queries-modal')?.addEventListener('hide.bs.modal', function(){
    this.querySelector('form').reset();
    this.querySelector('.modal-copy-iframe-btn').dataset.iframeSrc = '';
});

document.addEventListener('click', function (e) {
    if (!e.target.classList.contains('copy-iframe-btn') && !e.target.closest('.copy-iframe-btn')) {
        return
    }
    const copyBtn = e.target.classList.contains('copy-iframe-btn') ? e.target : e.target.closest('.copy-iframe-btn');
    const iframeSrc = copyBtn.dataset.iframeUrl;
    if (copyBtn.dataset.type === 'dynamic') {
        generateIframe(iframeSrc);
    } else {
        const modalCopyBtn = document.querySelector('.modal-copy-iframe-btn');
        modalCopyBtn ? (modalCopyBtn.dataset.iframeSrc = iframeSrc) : '';
    }
});


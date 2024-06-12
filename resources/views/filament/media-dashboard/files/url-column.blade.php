<div class="flex" x-data="{ copyToClipboard() {
    navigator.clipboard.writeText('{{ $getState() }}')
        .then(() => {
            alert('تم نسخ الرابط');
        })
        .catch(err => {
            console.error('Failed to copy: ', err);
        });
} }"
>
    <button>
        <x-filament::icon-button
            icon="heroicon-o-clipboard"
            @click="copyToClipboard()"
        />
    </button>
</div>

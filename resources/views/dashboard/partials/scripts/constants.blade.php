<script>
    const _csrf = '{{ csrf_token() }}'

    const _routes = {
        dropzone: {
            store: '{{ route('dashboard.dropzone.store') }}'
        },
    }

    const _urls = {
        assets: '{{ assetCustom('assets/dashboard') }}'
    }
</script>

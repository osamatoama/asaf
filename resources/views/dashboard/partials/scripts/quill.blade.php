<script src="{{ asset('dashboard_theme/assets/js/libs/editors/quill.js') }}"></script>

<script>
    let Link = Quill.import('formats/link');

    class MyLink extends Link {
        static create(value) {
        let node = super.create(value);
        value = this.sanitize(value);
        node.setAttribute('href', value);
        node.removeAttribute('rel');
        node.removeAttribute('target');
        return node;
        }
    }

    Quill.register(MyLink);
</script>

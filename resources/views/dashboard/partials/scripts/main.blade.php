@include('dashboard.partials.scripts.dictionary')
@include('dashboard.partials.scripts.constants')
<script src="{{ assetCustom('assets/dashboard/js/functions.js') }}"></script>
<script>
    $('.should-toggle').on('click', function () {
        toggleButton($(this))
    })

    @if(session()->has('success'))
    NioApp.Toast('{{ session('success') }}', 'success')
    @endif
    @if(session()->has('error'))
    NioApp.Toast('{{ session('error') }}', 'error')
    @endif
</script>
<script>
    function convertString(str) {
        var
            persianNumbers = [/۰/g, /۱/g, /۲/g, /۳/g, /۴/g, /۵/g, /۶/g, /۷/g, /۸/g, /۹/g],
            arabicNumbers = [/٠/g, /١/g, /٢/g, /٣/g, /٤/g, /٥/g, /٦/g, /٧/g, /٨/g, /٩/g];

        if (typeof str === 'string') {
            for (var i = 0; i < 10; i++) {
                str = str.replace(persianNumbers[i], i).replace(arabicNumbers[i], i);
            }
        }
        return str;
    }

    $(".ArNumToEn").on('input', function () {
        var newString = convertString($(this).val());
        $(this).val(newString);
    });

    $(document).ready(function () {
        $('.ArNumToEn').each(function () {
            var newString = convertString($(this).val());
            $(this).val(newString);
        });
    });
</script>

@if(session('success_message') ?? false)
    <script>
        fireSuccessToast('{{ session('success_message') }}');
    </script>
@endif
@if(session('error_message') ?? false)
    <script>
        fireErrorToast('{{ session('error_message') }}');
    </script>
@endif

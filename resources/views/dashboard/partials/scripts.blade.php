<script src="{{ asset('assets/dashboard/js/bundle.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/scripts.js') }}"></script>
<script src="{{ asset('assets/libs/axios/axios.min.js') }}"></script>
<script>
    axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
    axios.defaults.headers.common['X-CSRF-Token'] = $('meta[name="_token"]').attr('content')
</script>
<script src="{{ asset('assets/dashboard/js/libs/fancybox.umd.js') }}"></script>

@include('dashboard.partials.scripts.main')
@include('dashboard.partials.scripts.app')

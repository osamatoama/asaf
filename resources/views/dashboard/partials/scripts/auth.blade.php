<script>
    @if($errors->has('auth'))
    NioApp.Toast('{{ $errors->first('auth') }}', 'error')
    @endif
</script>

<script type="text/javascript">
    toastr.options = {
        "progressBar": true,
        "showDuration": "10000"
    }

    @if ($errors->any())
    @foreach ($errors->all() as $error)
    toastr.error('{!! $error !!}');
    @endforeach
    @endif

    @foreach (['error', 'warning', 'success', 'info'] as $key)
    @if(session()->has($key))
    @switch($key)
    @case('info')
    toastr.info('{!! session()->get($key) !!}');
    @break

    @case('warning')
    toastr.warning('{!! session()->get($key) !!}');
    @break

    @case('error')
    toastr.error('{!! session()->get($key) !!}');
    @break

    @case('success')
    toastr.success('{!! session()->get($key) !!}');
    @break
    @endswitch
    @endif
    @endforeach
</script>

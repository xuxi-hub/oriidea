@foreach (['danger', 'warning', 'success', 'info', 'status'] as $msg)
  @if(session()->has($msg))
    <div class="message-container">
        <div class="alert alert-{{ $msg }} alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{ session()->get($msg) }}
        </div>
    </div>
  @endif
@endforeach

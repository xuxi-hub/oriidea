 @include('shared._errors')

<form id="formPostStatus" action="{{ route('statuses.store') }}" method="post">
     {{ csrf_field() }}
     <textarea class="form-control" placeholder="聊聊新鲜事儿..." name="content">{{ old('content') }}</textarea>
     <button type="submit" class="btn btn-primary">发布</button>
</form>
<!-- formPostStatus **end -->

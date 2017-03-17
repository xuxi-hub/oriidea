<a href="{{ route('users.show', $user->id) }}">
    <img class="gravatar" src="{{ $user->gravatar('100') }}" alt="{{ $user->name }}" />
</a>
<h1>{{ $user->name }}</h1>

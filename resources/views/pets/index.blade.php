@if($errors->any())
    @foreach ($errors->all() as $error)
        {{ $error }}
    @endforeach
@endif
    All Available Pets List </br></br>
<a href="{{ route('pets.create') }}">+ new pet</a></br></br>
@foreach($pets as $pet)
        @if(isset($pet['name']))
            Name: {{ $pet['name'] }} 
        @else
          <em>No Name</em>
        @endif
        Status: {{ $pet['status'] }}
        <a href="{{ route('pets.edit', $pet['id']) }}">Edit</a>
        <form action="{{ route('pets.destroy', $pet['id']) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button></br>
        </form>
        </li>
@endforeach
</body>
</html>

@if($errors->any())
    @foreach ($errors->all() as $error)
        {{ $error }}
    @endforeach
@endif Edit
    <form action="{{ route('pets.update', $pet['id']) }}" method="POST">
    @csrf
    @method('PUT')
    Name: <input type="text" name="name"> </br>
    Status:<input type="text" name="status"> </br>
    <button type="submit">Edit</button>
    </form>


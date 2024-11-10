@if($errors->any())
    @foreach ($errors->all() as $error)
        {{ $error }}
    @endforeach
@endif Add
    <form action="{{ route('pets.store') }}" method="POST">
        @csrf
        Name: <input type="text" name="name"> </br>
        Status: <input type="text" name="status"> </br>
        <button type="submit">+++ :)</button>
    </form>

@extends ('layouts.master')

@section ('title')
    Admin Dashboard
@endsection

@section ('style')
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
@endsection

@section ('content')
    <div class="container">
        @foreach($authors as $author)
            <p>Name: {{ $author->name }}, Email: {{ $author->email }}</p>
        @endforeach
    </div>

@endsection


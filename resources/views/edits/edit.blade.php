@extends('layouts.master')

@section('title')
Quote Application - Edit
@endsection

@section('style')
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

@endsection

@section('content')
    <div class="container">
        <section>
            <div>
                <h2 style="color: grey">Edit your quote</h2>
            </div>
            @if (count($errors) > 0)
                <div>
                    @foreach($errors->all() as $error)
                        <p style="color: red;">{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <div>
                <form action="{{ route('post-edit', ['quote_id' => $quote->id]) }}" method="post">
                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <label for="name">Enter Name: </label>
         <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="{{ $quote->author->name }}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <label for="quote">Enter Quote: </label>
                            <textarea name="quote" id="quote" placeholder="Enter Quote" class="form-control" rows="5">{{ $quote->quote }}</textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-secondary">Update Quote</button>
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                </form>
            </div>
        </section>

    </div>
@endsection
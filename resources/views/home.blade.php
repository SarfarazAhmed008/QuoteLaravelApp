@extends('layouts.master')

@section('title')
    Quote Application
@endsection

@section('style')
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

@endsection

@section('content')
    <div class="container">
        <section>
            @if (!empty(Request::segment(1)))
                <div>
                    <p>The filter is set....<a href="{{ route('home') }}">Show all quotes</a></p>
                </div>
            @endif
            <h2 style="color: grey">Latest Quotes</h2>
            @if (Session::has('success'))
                <div>
                    <p style="color: green">{{ Session::get('success') }}</p>
                </div>
            @endif
            @for($i = 0; $i < count($quotes); $i++)

            <div class="border border-primary col-md-4">
                <div style="text-align: right; position: relative;">
                    <a href="{{ route('edit', ['quote_id' => $quotes[$i]->id ]) }}" style="text-decoration: none; color: grey">Edit |</a>
                    <a href="{{ route('delete', ['quote_id' => $quotes[$i]->id ]) }}" style="text-decoration: none; color: red">X</a>
                </div>
                <div>
                    {{ $quotes[$i]->quote }}
                </div>
                <div>
                    created by <a href="{{ route('home', ['author' => $quotes[$i]->author->name] ) }}">{{ $quotes[$i]->author->name }}</a> on {{ $quotes[$i]->created_at }}
                </div>
            </div><br>
            @endfor

<!--         <div>
                {{ $quotes->links() }}
            </div> -->
            <div>
                @if ($quotes->currentPage() !== 1)
                    <a href="{{ $quotes->previousPageUrl() }}"><span class="fa fa-caret-left"><</span></a>
                @endif
                @if ($quotes->currentPage() !== $quotes->lastPage() && $quotes->hasPages() )
                    <a href="{{ $quotes->nextPageUrl() }}"><span class="fa fa-caret-right">></span></a>
                @endif
            </div>

        </section>
        <section>
            <div>
                <h2 style="color: grey">Post your quote</h2>
            </div>
            @if (count($errors) > 0)
                <div>
                    @foreach($errors->all() as $error)
                        <p style="color: red;">{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <div>
                <form action="{{ route('create') }}" method="post">
                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <label for="name">Enter Name: </label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <label for="email">Enter Email: </label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter email">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <label for="quote">Enter Quote: </label>
                            <textarea name="quote" id="quote" placeholder="Enter Quote" class="form-control" rows="5"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-secondary">Post Quote</button>
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                </form>
            </div>
        </section>
        <br><br><br>
    </div>
@endsection



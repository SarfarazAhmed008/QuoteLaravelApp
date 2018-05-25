@extends ('layouts.master')

@section ('title')
    Admin
@endsection

@section ('style')
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
@endsection

@section ('content')
            <br><br>            
            <div class="container">
            @if (count($errors) > 0)
                @foreach($errors->all() as $error)
                    <p style="color: red">{{ $error }}</p>
                @endforeach
            @endif

            @if ( Session::has('fail') )
                <p style="color: red">{{ Session::get('fail') }}</p>
            @endif
                <form action="{{ route('admin.login') }}" method="post">
                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <label for="name">Enter Name: </label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <label for="password">Enter Password: </label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-secondary">Login</button>
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                </form>
            </div>

@endsection
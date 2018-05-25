@extends('layouts.master')

@section('title')
	Register 
@endsection

@section('style')
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
@endsection

@section('content')

	<h2>Thank you {{ $author }} for registering here.</h2>
	<a href="{{ route('home') }}">Go Homepage</a>

@endsection

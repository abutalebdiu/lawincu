@extends('layouts.app')
@section('content')
<h1>Welcome to Amlakin</h1>
<a href="{{ route("login") }}">User Login</a> <br>
<a href="{{ route("admin.login") }}">Admin Login</a> <br>
<a href="{{ route("supplier.login") }}">Supplier Login</a>
@endsection

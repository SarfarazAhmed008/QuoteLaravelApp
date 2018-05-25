<h3 style="text-align: center;color: grey">Welcome to Quote App</h3>
<a href="{{ route('admin.login') }}">Admin</a>
@if (Auth::check())
<a href="{{ route('admin.logout') }}">Logout</a>
@endif

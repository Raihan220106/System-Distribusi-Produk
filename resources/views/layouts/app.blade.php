<!DOCTYPE html>
<html>
<head>
    <title>Distribution App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <form action="{{ route('logout') }}" method="POST" style="text-align: right">
    @csrf
    <button type="submit">Logout</button>
</form>

    @yield('content')
</body>
</html>

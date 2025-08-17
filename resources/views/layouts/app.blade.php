<!DOCTYPE html>
<html>
<head>
    <title>Distribution App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
</head>
<body>
    <form action="{{ route('logout') }}" method="POST" style="text-align: right">
        @csrf
        <button type="submit">Logout</button>
    </form>

    @yield('content')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    {{-- ⬇️ WAJIB: render script yang di-push dari view --}}
    @stack('scripts')
</body>
</html>

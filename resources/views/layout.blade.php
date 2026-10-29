<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Aplikasi Apotek</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand navbar-dark bg-success mb-4">
  <div class="container">
    <span class="navbar-brand">Apotek</span>
    <div class="navbar-nav">
      <a class="nav-link" href="{{ route('pelanggan.index') }}">Pelanggan</a>
      <a class="nav-link" href="{{ route('staf.index') }}">Staf Apotek</a>
      <a class="nav-link" href="{{ route('obat.index') }}">Daftar Obat</a>
    </div>
  </div>
</nav>
<div class="container">
  @if(session('ok'))
    <div class="alert alert-success">{{ session('ok') }}</div>
  @endif
  @if($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
  @endif
  @yield('content')
</div>
</body>
</html>

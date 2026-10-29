<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Aplikasi Apotek</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
  <style>
    :root {
      --brand: #0e7c49;
      --brand-hover: #0a6238;
      --bg: #f4f6f5;
      --muted: #6b7280;
    }
    body {
      font-family: 'Inter', system-ui, -apple-system, Segoe UI, Roboto, 'Helvetica Neue', sans-serif;
      background: var(--bg);
      color: #212529;
    }
    .navbar {
      background: var(--brand) !important;
      border-radius: 0 0 14px 14px;
      box-shadow: 0 4px 12px -2px rgba(0, 0, 0, 0.08);
      margin-bottom: 1.75rem;
    }
    .navbar-brand {
      font-weight: 600;
      letter-spacing: 0.4px;
      font-size: 1.25rem;
    }
    .nav-link {
      color: rgba(255, 255, 255, 0.92) !important;
      padding: 0.45rem 0.9rem;
      border-radius: 8px;
      margin: 0 4px;
      font-weight: 500;
      font-size: 0.95rem;
    }
    .nav-link:hover, .nav-link:focus {
      background: rgba(255, 255, 255, 0.18);
      color: #fff !important;
    }
    .container {
      max-width: 1000px;
    }
    .card {
      border: none;
      border-radius: 16px;
      box-shadow: 0 2px 10px -3px rgba(0, 0, 0, 0.06);
      background: #fff;
      overflow: hidden;
      margin-bottom: 1.5rem;
    }
    .card-header {
      background: #fff;
      border-bottom: 1px solid #eee;
      padding: 1rem 1.25rem;
      font-weight: 600;
      font-size: 1.05rem;
      display: flex;
      align-items: center;
      gap: 0.6rem;
    }
    .card-body {
      padding: 1.25rem;
    }
    .btn {
      font-weight: 500;
      border-radius: 10px;
      padding: 0.5rem 1.1rem;
      font-size: 0.95rem;
    }
    .btn-primary {
      background: var(--brand);
      border-color: var(--brand);
    }
    .btn-primary:hover {
      background: var(--brand-hover);
      border-color: var(--brand-hover);
    }
    .btn-danger {
      border-radius: 10px;
    }
    .form-control, .form-select {
      border-radius: 10px;
      padding: 0.55rem 0.9rem;
      border: 1px solid #d1d5db;
      font-size: 0.95rem;
    }
    .form-control:focus {
      border-color: var(--brand);
      box-shadow: 0 0 0 4px rgba(14, 124, 73, 0.12);
    }
    .form-label {
      font-weight: 500;
      font-size: 0.88rem;
      color: #374151;
    }
    .table {
      font-size: 0.92rem;
      margin-bottom: 0;
    }
    .table thead {
      background: #f8fafc;
      color: #4b5563;
    }
    .table thead th {
      font-weight: 600;
      font-size: 0.85rem;
      text-transform: uppercase;
      letter-spacing: 0.3px;
      border-bottom: 2px solid #eee;
      padding: 0.85rem 0.75rem;
    }
    .table td, .table th {
      vertical-align: middle;
      padding: 0.85rem 0.75rem;
      border-color: #eee;
    }
    .table tbody tr:hover {
      background: #fbfdfe;
    }
    table.table-danger {
      color: #7f1d1d;
    }
    .badge {
      font-weight: 500;
      font-size: 0.78rem;
      padding: 0.35rem 0.65rem;
      border-radius: 20px;
    }
    .alert {
      border: none;
      border-radius: 12px;
      padding: 0.95rem 1.25rem;
      font-size: 0.92rem;
    }
    .alert-success {
      background: #dcfce7;
      color: #14532d;
    }
    .alert-danger {
      background: #fee2e2;
      color: #991b1b;
    }
    .text-muted {
      color: var(--muted) !important;
    }
    .empty-state {
      text-align: center;
      padding: 3rem 1rem;
      color: var(--muted);
    }
    @media (max-width: 576px) {
      .container {
        width: 100%;
        padding-left: 0.75rem;
        padding-right: 0.75rem;
      }
      .navbar {
        border-radius: 0;
      }
      .card {
        border-radius: 0;
      }
      .table-responsive {
        font-size: 0.85rem;
      }
      .btn {
        width: 100%;
      }
    }
  </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="{{ route('obat.index') }}">Apotek</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#apotekNav" aria-controls="apotekNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="apotekNav">
      <div class="navbar-nav ms-auto mb-2 mb-lg-0">
        <a class="nav-link" href="{{ route('pelanggan.index') }}">Pelanggan</a>
        <a class="nav-link" href="{{ route('staf.index') }}">Staf Apotek</a>
        <a class="nav-link" href="{{ route('obat.index') }}">Daftar Obat</a>
      </div>
    </div>
  </div>
</nav>

<div class="container pb-5">
  @if(session('ok'))
    <div class="alert alert-success">{{ session('ok') }}</div>
  @endif
  @if($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0 small">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
  @endif
  @yield('content')
</div>
</body>
</html>

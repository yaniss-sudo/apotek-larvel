<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Beranda') · Aplikasi Apotek</title>
  <script>
    try { if (localStorage.getItem('sidebarCollapsed') === '1') document.documentElement.classList.add('sidebar-collapsed'); } catch (e) {}
  </script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
  <link href="{{ asset('css/apotek.css') }}" rel="stylesheet">
</head>
<body>
<aside class="sidebar" id="sidebar">
  <a class="logo" href="{{ url('/') }}"><i class="bi bi-heart-pulse-fill"></i><span>Apotek</span></a>
  <div class="menu-label">Menu</div>
  <nav>
    <a href="{{ route('pelanggan.index') }}" title="Pelanggan" class="{{ request()->routeIs('pelanggan.*') ? 'active' : '' }}">
      <i class="bi bi-people"></i><span>Pelanggan</span>
    </a>
    <a href="{{ route('staf.index') }}" title="Staf Apotek" class="{{ request()->routeIs('staf.*') ? 'active' : '' }}">
      <i class="bi bi-person-badge"></i><span>Staf Apotek</span>
    </a>
    <a href="{{ route('obat.index') }}" title="Daftar Obat" class="{{ request()->routeIs('obat.*') ? 'active' : '' }}">
      <i class="bi bi-capsule"></i><span>Daftar Obat</span>
    </a>
  </nav>
</aside>
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<div class="main">
  <header class="topbar">
    <button class="btn-toggle" id="sidebarToggle" type="button" aria-label="Buka/tutup menu"><i class="bi bi-list"></i></button>
    <div class="crumb"><span>Apotek</span><i class="bi bi-chevron-right small"></i><strong>@yield('title')</strong></div>
  </header>

  <main class="content">
    @if(session('ok'))
      <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
        <i class="bi bi-check-circle me-1"></i> {{ session('ok') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
      </div>
    @endif
    @if($errors->any())
      <div class="alert alert-danger mb-3" role="alert">
        <div class="fw-semibold"><i class="bi bi-exclamation-circle me-1"></i> Data belum bisa disimpan:</div>
        <ul class="mb-0 small ps-3">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
      </div>
    @endif

    @yield('content')
  </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  (function () {
    var root = document.documentElement;
    var desktop = window.matchMedia('(min-width: 992px)');
    document.getElementById('sidebarToggle').addEventListener('click', function () {
      if (desktop.matches) {
        var c = root.classList.toggle('sidebar-collapsed');
        try { localStorage.setItem('sidebarCollapsed', c ? '1' : '0'); } catch (e) {}
      } else {
        root.classList.toggle('sidebar-open');
      }
    });
    document.getElementById('sidebarOverlay').addEventListener('click', function () { root.classList.remove('sidebar-open'); });
    desktop.addEventListener('change', function () { root.classList.remove('sidebar-open'); });

    // Pencarian cepat pada tabel: <input data-filter="#idTabel" data-count="#idCount" data-unit="staf">
    document.querySelectorAll('[data-filter]').forEach(function (input) {
      var table = document.querySelector(input.dataset.filter);
      if (!table) return;
      var rows = [].slice.call(table.querySelectorAll('tbody tr[data-row]'));
      var none = table.querySelector('.no-result');
      var counter = document.querySelector(input.dataset.count);
      var unit = input.dataset.unit || 'data';
      input.addEventListener('input', function () {
        var q = input.value.trim().toLowerCase(), n = 0;
        rows.forEach(function (r) {
          var show = r.textContent.toLowerCase().indexOf(q) > -1;
          r.hidden = !show; if (show) n++;
        });
        if (none) none.hidden = n > 0 || rows.length === 0;
        if (counter) counter.textContent = (q ? n + ' dari ' : '') + rows.length + ' ' + unit;
      });
    });
  })();
</script>
@stack('scripts')
</body>
</html>

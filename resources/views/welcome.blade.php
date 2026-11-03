<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Apotek | Kelola data pelanggan, staf, dan obat</title>
  <meta name="description" content="Aplikasi apotek untuk mengelola data pelanggan, staf, dan stok obat.">
  <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="{{ asset('css/landing.css') }}" rel="stylesheet">
</head>
<body>
  <header class="landing-head">
    <a class="brand" href="{{ route('beranda') }}"><x-logo :size="34" /><span>Apotek</span></a>
    <a class="link-masuk" href="{{ route('pelanggan.index') }}">Masuk ke aplikasi</a>
  </header>

  <main class="landing-main">
    <section class="hero">
      <h1>Data apotek tertata dalam satu tempat.</h1>
      <p>Catat pelanggan, staf, dan stok obat beserta tanggal kadaluarsanya, tanpa berpindah-pindah catatan.</p>
      <a class="btn-masuk" href="{{ route('pelanggan.index') }}">Buka aplikasi</a>
    </section>

    <ul class="pintasan">
      <li>
        <a href="{{ route('pelanggan.index') }}">
          <strong>Pelanggan</strong>
          <span>{{ number_format($jmlPelanggan, 0, ',', '.') }} pelanggan terdaftar</span>
        </a>
      </li>
      <li>
        <a href="{{ route('staf.index') }}">
          <strong>Staf Apotek</strong>
          <span>{{ number_format($jmlStaf, 0, ',', '.') }} staf aktif tercatat</span>
        </a>
      </li>
      <li>
        <a href="{{ route('obat.index') }}">
          <strong>Daftar Obat</strong>
          <span>{{ number_format($jmlObat, 0, ',', '.') }} jenis obat dipantau</span>
        </a>
      </li>
    </ul>
  </main>

  <footer class="landing-foot">Tugas Kelompok 5, kelas TRKJ 2C, mata kuliah Sistem Terintegrasi. Foto oleh Urban Vintage di Unsplash.</footer>
</body>
</html>

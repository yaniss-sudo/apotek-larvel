<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>404 | Halaman tidak ditemukan</title>
  <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="{{ asset('css/landing.css') }}" rel="stylesheet">
</head>
<body>
  <header class="landing-head">
    <a class="brand" href="{{ route('beranda') }}"><x-logo :size="34" /><span>Apotek</span></a>
  </header>
  <main class="landing-main">
    <section class="hero nf">
      <p class="kode">404</p>
      <h1>Halaman tidak ditemukan</h1>
      <p>Alamat yang kamu buka tidak tersedia atau sudah dipindahkan. Periksa kembali alamatnya, atau kembali ke beranda.</p>
      <div class="aksi">
        <a class="btn-masuk" href="{{ route('beranda') }}">Ke beranda</a>
        <a class="btn-garis" href="{{ route('pelanggan.index') }}">Buka aplikasi</a>
      </div>
    </section>
  </main>
</body>
</html>

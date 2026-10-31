<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>404 - Halaman Tidak Ditemukan | Apotek</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background: #f4f8f5;
    }
    .kode {
      font-size: 7rem;
      font-weight: 700;
      line-height: 1;
      color: #0e7c49;
    }
  </style>
</head>
<body>
  <div class="text-center px-3">
    <div class="kode">404</div>
    <h4 class="mt-3">Halaman tidak ditemukan</h4>
    <p class="text-muted mb-4">
      Alamat yang kamu buka tidak tersedia atau sudah dipindahkan.<br>
      Periksa kembali alamatnya, atau kembali ke halaman utama.
    </p>
    <a href="{{ url('/') }}" class="btn btn-success" style="background:#0e7c49;border-color:#0e7c49">Ke Beranda</a>
    <a href="javascript:history.back()" class="btn btn-outline-secondary">Kembali</a>
    <div class="mt-4 small text-muted">Aplikasi Apotek</div>
  </div>
</body>
</html>

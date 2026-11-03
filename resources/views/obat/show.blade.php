@extends('layout')
@section('title', 'Detail Obat')
@section('content')
@php
  $exp  = \Carbon\Carbon::parse($obat->tanggal_kadaluarsa)->startOfDay();
  $sisa = (int) now()->startOfDay()->diffInDays($exp, false);
@endphp
<div class="page-header">
  <div>
    <h1 class="page-title">{{ $obat->nama_obat }}</h1>
    <p class="page-sub">Detail obat, kode {{ $obat->kode_obat }}</p>
  </div>
  <a href="{{ route('obat.index') }}" class="btn btn-ghost"><i class="bi bi-arrow-left me-1"></i> Kembali ke daftar</a>
</div>

<div class="card detail detail-plain">
  <dl class="detail-list">
    <div><dt>Kode obat</dt><dd>{{ $obat->kode_obat }}</dd></div>
    <div><dt>Nama obat</dt><dd>{{ $obat->nama_obat }}</dd></div>
    <div><dt>Stok</dt><dd>{{ number_format($obat->stok, 0, ',', '.') }}</dd></div>
    <div>
      <dt>Kadaluarsa</dt>
      <dd>
        {{ $exp->translatedFormat('d F Y') }}
        @if($sisa < 0)
          <span class="badge-soft-danger ms-1">Sudah kadaluarsa</span>
        @elseif($sisa <= 90)
          <span class="badge-soft-danger ms-1">{{ $sisa }} hari lagi</span>
        @else
          <span class="badge-soft-success ms-1">{{ $sisa }} hari lagi</span>
        @endif
      </dd>
    </div>
    <div><dt>Ditambahkan</dt><dd>{{ $obat->created_at?->translatedFormat('d F Y') ?? '-' }}</dd></div>
  </dl>
  <div class="detail-foot">
    <a href="{{ route('obat.index') }}" class="btn btn-outline-secondary">Kembali</a>
    <form method="POST" action="{{ route('obat.destroy', $obat->id) }}" onsubmit="return confirm('Yakin ingin menghapus obat ini?')">
      @csrf @method('DELETE')
      <button class="btn btn-outline-danger"><i class="bi bi-trash me-1"></i> Hapus obat</button>
    </form>
  </div>
</div>
@endsection

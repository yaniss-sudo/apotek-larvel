@extends('layout')
@section('title', 'Detail Pelanggan')
@section('content')
<div class="page-header">
  <div>
    <h1 class="page-title">{{ $pelanggan->nama }}</h1>
    <p class="page-sub">Detail pelanggan</p>
  </div>
  <a href="{{ route('pelanggan.index') }}" class="btn btn-ghost"><i class="bi bi-arrow-left me-1"></i> Kembali ke daftar</a>
</div>

<div class="card detail">
  <div class="detail-side">
    <x-avatar :nama="$pelanggan->nama" :foto="$pelanggan->foto" :large="true" />
    <div class="fw-semibold mt-2">{{ $pelanggan->nama }}</div>
    <div class="cell-sub">ID #{{ $pelanggan->id }}</div>
  </div>
  <dl class="detail-list">
    <div><dt>No HP</dt><dd>{{ $pelanggan->no_hp }}</dd></div>
    <div><dt>Alamat</dt><dd>{{ $pelanggan->alamat }}</dd></div>
    <div><dt>Bio</dt><dd>{{ $pelanggan->bio ?: '-' }}</dd></div>
    <div><dt>Terdaftar</dt><dd>{{ $pelanggan->created_at?->translatedFormat('d F Y') ?? '-' }}</dd></div>
    <div><dt>Terakhir diubah</dt><dd>{{ $pelanggan->updated_at?->translatedFormat('d F Y, H:i') ?? '-' }}</dd></div>
  </dl>
  <div class="detail-foot">
    <a href="{{ route('pelanggan.index') }}" class="btn btn-outline-secondary">Kembali</a>
    <form method="POST" action="{{ route('pelanggan.destroy', $pelanggan->id) }}" onsubmit="return confirm('Yakin ingin menghapus pelanggan ini?')">
      @csrf @method('DELETE')
      <button class="btn btn-outline-danger"><i class="bi bi-trash me-1"></i> Hapus pelanggan</button>
    </form>
  </div>
</div>
@endsection

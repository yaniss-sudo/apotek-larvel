@extends('layout')
@section('title', 'Detail Staf')
@section('content')
<div class="page-header">
  <div>
    <h1 class="page-title">{{ $staf->nama }}</h1>
    <p class="page-sub">Detail staf apotek</p>
  </div>
  <a href="{{ route('staf.index') }}" class="btn btn-ghost"><i class="bi bi-arrow-left me-1"></i> Kembali ke daftar</a>
</div>

@php $lahir = $staf->tanggal_lahir ? \Carbon\Carbon::parse($staf->tanggal_lahir) : null; @endphp
<div class="card detail">
  <div class="detail-side">
    <x-avatar :nama="$staf->nama" :foto="$staf->foto" :large="true" />
    <div class="fw-semibold mt-2">{{ $staf->nama }}</div>
    <div class="cell-sub">ID #{{ $staf->id }}</div>
  </div>
  <dl class="detail-list">
    <div><dt>No HP</dt><dd>{{ $staf->no_hp }}</dd></div>
    <div><dt>Alamat</dt><dd>{{ $staf->alamat }}</dd></div>
    <div><dt>Tempat lahir</dt><dd>{{ $staf->tempat_lahir ?: '-' }}</dd></div>
    <div><dt>Tanggal lahir</dt><dd>{{ $lahir ? $lahir->translatedFormat('d F Y').' ('.$lahir->age.' tahun)' : '-' }}</dd></div>
    <div><dt>Bio</dt><dd>{{ $staf->bio ?: '-' }}</dd></div>
    <div><dt>Terdaftar</dt><dd>{{ $staf->created_at?->translatedFormat('d F Y') ?? '-' }}</dd></div>
  </dl>
  <div class="detail-foot">
    <a href="{{ route('staf.index') }}" class="btn btn-outline-secondary">Kembali</a>
    <form method="POST" action="{{ route('staf.destroy', $staf->id) }}" onsubmit="return confirm('Yakin ingin menghapus staf ini?')">
      @csrf @method('DELETE')
      <button class="btn btn-outline-danger"><i class="bi bi-trash me-1"></i> Hapus staf</button>
    </form>
  </div>
</div>
@endsection

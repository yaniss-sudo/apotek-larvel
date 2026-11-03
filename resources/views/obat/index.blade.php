@extends('layout')
@section('title', 'Daftar Obat')
@section('content')
<div class="page-header">
  <div>
    <h1 class="page-title">Daftar Obat</h1>
    <p class="page-sub">Pantau stok dan tanggal kadaluarsa obat.</p>
  </div>
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah-obat">
    <i class="bi bi-plus-lg me-1"></i> Tambah Obat
  </button>
</div>

<div class="card table-card">
  <div class="card-toolbar">
    <div class="search">
      <i class="bi bi-search"></i>
      <input type="search" class="form-control" placeholder="Cari kode atau nama obat..."
             data-filter="#tabel-obat" data-count="#hitung-obat" data-unit="obat">
    </div>
    <span class="count" id="hitung-obat">{{ $data->count() }} obat</span>
  </div>
  <div class="table-scroll">
    <table class="table table-hover align-middle" id="tabel-obat">
      <thead>
        <tr>
          <th>Kode</th>
          <th>Nama Obat</th>
          <th class="text-end">Stok</th>
          <th>Kadaluarsa</th>
          <th class="text-end col-aksi">Aksi</th>
        </tr>
      </thead>
      <tbody>
      @forelse($data as $d)
        @php $exp = \Carbon\Carbon::parse($d->tanggal_kadaluarsa); @endphp
        <tr data-row>
          <td class="fw-semibold">{{ $d->kode_obat }}</td>
          <td><button type="button" class="nama-link" data-bs-toggle="modal" data-bs-target="#detail-obat-{{ $d->id }}">{{ $d->nama_obat }}</button></td>
          <td class="text-end">{{ number_format($d->stok, 0, ',', '.') }}</td>
          <td>
            <span class="me-1">{{ $exp->format('d M Y') }}</span>
            @if($exp->isPast())<span class="badge-soft-danger">Kadaluarsa</span>@endif
          </td>
          <td class="text-end col-aksi"><div class="d-flex justify-content-end gap-1">
            <button type="button" class="btn btn-icon" data-bs-toggle="modal" data-bs-target="#detail-obat-{{ $d->id }}" title="Lihat detail"><i class="bi bi-eye"></i></button>
            <form method="POST" action="{{ route('obat.destroy', $d->id) }}" onsubmit="return confirm('Yakin ingin menghapus obat ini?')" class="d-inline">
              @csrf @method('DELETE')
              <button class="btn btn-icon danger" title="Hapus"><i class="bi bi-trash"></i></button>
            </form></div>
          </td>
        </tr>
      @empty
        <tr><td colspan="5" class="empty-state"><i class="bi bi-capsule"></i>Belum ada data obat.</td></tr>
      @endforelse
        <tr class="no-result" hidden><td colspan="5" class="empty-state"><i class="bi bi-search"></i>Tidak ada hasil yang cocok.</td></tr>
      </tbody>
    </table>
  </div>
</div>

@foreach($data as $d)
{{-- Card detail --}}
<div class="modal fade detail-card" id="detail-obat-{{ $d->id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered"><div class="modal-content">
    <div class="dc-banner"><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button></div>
    <div class="dc-avatar"><span class="avatar avatar-lg dc-icon"><i class="bi bi-capsule"></i></span></div>
    <div class="dc-head"><h5>{{ $d->nama_obat }}</h5><div class="cell-sub">{{ $d->kode_obat }}</div></div>
    <dl class="dc-list">
      <div><dt>Kode</dt><dd>{{ $d->kode_obat }}</dd></div>
      <div><dt>Stok</dt><dd>{{ number_format($d->stok, 0, ',', '.') }}</dd></div>
      <div><dt>Kadaluarsa</dt><dd>
        @php $e = \Carbon\Carbon::parse($d->tanggal_kadaluarsa); @endphp
        {{ $e->format('d M Y') }}
        @if($e->isPast())<span class="badge-soft-danger ms-1">Kadaluarsa</span>@endif
      </dd></div>
    </dl>
  </div></div>
</div>
@endforeach

<div class="modal fade" id="tambah-obat" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <form method="POST" action="{{ route('obat.store') }}">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">Tambah Obat</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-12 col-sm-5">
              <label class="form-label">Kode Obat</label>
              <input name="kode_obat" class="form-control" placeholder="OBT-001" value="{{ old('kode_obat') }}" required>
            </div>
            <div class="col-12 col-sm-7">
              <label class="form-label">Nama Obat</label>
              <input name="nama_obat" class="form-control" placeholder="Nama obat" value="{{ old('nama_obat') }}" required>
            </div>
            <div class="col-6">
              <label class="form-label">Stok</label>
              <input type="number" name="stok" min="0" class="form-control" placeholder="0" value="{{ old('stok') }}" required>
            </div>
            <div class="col-6">
              <label class="form-label">Tgl. Kadaluarsa</label>
              <input type="date" name="tanggal_kadaluarsa" class="form-control" value="{{ old('tanggal_kadaluarsa') }}" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
          <button class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push('scripts')
@if($errors->any())
<script>
  document.addEventListener('DOMContentLoaded', function () {
    new bootstrap.Modal(document.getElementById('tambah-obat')).show();
  });
</script>
@endif
@endpush

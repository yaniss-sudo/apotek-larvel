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
          <td>{{ $d->nama_obat }}</td>
          <td class="text-end">{{ number_format($d->stok, 0, ',', '.') }}</td>
          <td>
            <span class="me-1">{{ $exp->format('d M Y') }}</span>
            @if($exp->isPast())<span class="badge-soft-danger">Kadaluarsa</span>@endif
          </td>
          <td class="text-end col-aksi">
            <form method="POST" action="{{ route('obat.destroy', $d->id) }}" onsubmit="return confirm('Yakin ingin menghapus obat ini?')" class="d-inline">
              @csrf @method('DELETE')
              <button class="btn btn-icon danger" title="Hapus"><i class="bi bi-trash"></i></button>
            </form>
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

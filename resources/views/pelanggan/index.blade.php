@extends('layout')
@section('title', 'Pelanggan')
@section('content')
@php
  $editId = old('_edit_id');
  $addErr = old('_add');
  $o = fn($key) => $addErr ? old($key) : null;
@endphp

<div class="page-header">
  <div>
    <h1 class="page-title">Pelanggan</h1>
    <p class="page-sub">Kelola data pelanggan apotek.</p>
  </div>
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah-pelanggan">
    <i class="bi bi-plus-lg me-1"></i> Tambah Pelanggan
  </button>
</div>

<div class="card table-card">
  <div class="card-toolbar">
    <div class="search">
      <i class="bi bi-search"></i>
      <input type="search" class="form-control" placeholder="Cari nama, no HP, alamat..."
             data-filter="#tabel-pelanggan" data-count="#hitung-pelanggan" data-unit="pelanggan">
    </div>
    <span class="count" id="hitung-pelanggan">{{ $data->count() }} pelanggan</span>
  </div>
  <div class="table-scroll">
    <table class="table table-hover align-middle" id="tabel-pelanggan">
      <thead>
        <tr>
          <th>Pelanggan</th>
          <th class="d-none d-md-table-cell">No HP</th>
          <th class="d-none d-md-table-cell">Alamat</th>
          <th class="d-none d-lg-table-cell">Bio</th>
          <th class="text-end col-aksi">Aksi</th>
        </tr>
      </thead>
      <tbody>
      @forelse($data as $d)
        <tr data-row>
          <td>
            <div class="d-flex align-items-center gap-2">
              <x-avatar :nama="$d->nama" :foto="$d->foto" />
              <div>
                <div class="fw-semibold">{{ $d->nama }}</div>
                <div class="cell-sub">ID #{{ $d->id }}<span class="d-md-none"> · {{ $d->no_hp }}</span></div>
              </div>
            </div>
          </td>
          <td class="d-none d-md-table-cell">{{ $d->no_hp }}</td>
          <td class="d-none d-md-table-cell"><div class="truncate" title="{{ $d->alamat }}">{{ $d->alamat }}</div></td>
          <td class="d-none d-lg-table-cell"><div class="truncate" title="{{ $d->bio }}">{{ $d->bio ?: '-' }}</div></td>
          <td class="text-end col-aksi">
            <div class="d-flex justify-content-end gap-1">
              <button type="button" class="btn btn-icon" data-bs-toggle="modal" data-bs-target="#edit-pelanggan-{{ $d->id }}" title="Ubah">
                <i class="bi bi-pencil"></i>
              </button>
              <form method="POST" action="{{ route('pelanggan.destroy', $d->id) }}" onsubmit="return confirm('Yakin ingin menghapus pelanggan ini?')">
                @csrf @method('DELETE')
                <button class="btn btn-icon danger" title="Hapus"><i class="bi bi-trash"></i></button>
              </form>
            </div>
          </td>
        </tr>
      @empty
        <tr><td colspan="5" class="empty-state"><i class="bi bi-people"></i>Belum ada data pelanggan.</td></tr>
      @endforelse
        <tr class="no-result" hidden><td colspan="5" class="empty-state"><i class="bi bi-search"></i>Tidak ada hasil yang cocok.</td></tr>
      </tbody>
    </table>
  </div>
</div>

{{-- Modal tambah --}}
<div class="modal fade" id="tambah-pelanggan" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <form method="POST" action="{{ route('pelanggan.store') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_add" value="1">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Pelanggan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-12 col-md-6">
              <label class="form-label">Nama</label>
              <input name="nama" class="form-control" placeholder="Nama lengkap" value="{{ $o('nama') }}" required>
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label">No HP</label>
              <input name="no_hp" class="form-control" placeholder="08xxxxxxxxxx" value="{{ $o('no_hp') }}" required>
            </div>
            <div class="col-12">
              <label class="form-label">Alamat</label>
              <textarea name="alamat" class="form-control" rows="2" placeholder="Alamat lengkap" required>{{ $o('alamat') }}</textarea>
            </div>
            <div class="col-12">
              <label class="form-label">Bio <span class="text-muted fw-normal">(opsional)</span></label>
              <textarea name="bio" class="form-control" rows="2" placeholder="Bio singkat...">{{ $o('bio') }}</textarea>
            </div>
            <div class="col-12">
              <label class="form-label">Foto Profil <span class="text-muted fw-normal">(opsional)</span></label>
              <input type="file" name="foto" class="form-control" accept="image/*">
              <div class="form-text">Maks 2MB (JPG/PNG/WebP)</div>
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

{{-- Modal ubah --}}
@foreach($data as $d)
@php $isEdit = (string) $editId === (string) $d->id; $v = fn($k, $default) => $isEdit ? old($k, $default) : $default; @endphp
<div class="modal fade" id="edit-pelanggan-{{ $d->id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <form method="POST" action="{{ route('pelanggan.update', $d->id) }}" enctype="multipart/form-data">
        @csrf @method('PUT')
        <input type="hidden" name="_edit_id" value="{{ $d->id }}">
        <div class="modal-header">
          <h5 class="modal-title">Ubah Data Pelanggan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-12 d-flex align-items-center gap-3">
              <x-avatar :nama="$d->nama" :foto="$d->foto" :large="true" />
              <div class="flex-grow-1">
                <label class="form-label">Foto</label>
                <input type="file" name="foto" class="form-control" accept="image/*">
                <div class="form-text">Kosongkan jika tidak ingin mengubah.</div>
              </div>
              @if($d->foto)
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="hapus_foto" id="hapus_foto_pelanggan_{{ $d->id }}">
                <label class="form-check-label small" for="hapus_foto_pelanggan_{{ $d->id }}">Hapus foto</label>
              </div>
              @endif
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label">Nama</label>
              <input name="nama" class="form-control" value="{{ $v('nama', $d->nama) }}" required>
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label">No HP</label>
              <input name="no_hp" class="form-control" value="{{ $v('no_hp', $d->no_hp) }}" required>
            </div>
            <div class="col-12">
              <label class="form-label">Alamat</label>
              <textarea name="alamat" class="form-control" rows="2" required>{{ $v('alamat', $d->alamat) }}</textarea>
            </div>
            <div class="col-12">
              <label class="form-label">Bio</label>
              <textarea name="bio" class="form-control" rows="2">{{ $v('bio', $d->bio) }}</textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
          <button class="btn btn-primary">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endforeach
@endsection

@push('scripts')
@if($errors->any() && ($editId || $addErr))
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var el = document.getElementById('{{ $editId ? 'edit-pelanggan-'.(int) $editId : 'tambah-pelanggan' }}');
    if (el) new bootstrap.Modal(el).show();
  });
</script>
@endif
@endpush

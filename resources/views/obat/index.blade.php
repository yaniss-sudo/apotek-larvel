@extends('layout')
@section('content')
<div class="card">
  <div class="card-header">
    <span class="badge bg-success">Obat</span> Daftar Obat
  </div>
  <div class="card-body">
    <form method="POST" action="{{ route('obat.store') }}" class="row g-3 mb-4 align-items-end">
      @csrf
      <div class="col-md-4 col-sm-6">
        <label class="form-label d-block mb-1">Kode Obat</label>
        <input name="kode_obat" class="form-control" placeholder="Kode Obat" value="{{ old('kode_obat') }}" required>
      </div>
      <div class="col-md-4 col-sm-6">
        <label class="form-label d-block mb-1">Nama Obat</label>
        <input name="nama_obat" class="form-control" placeholder="Nama Obat" value="{{ old('nama_obat') }}" required>
      </div>
      <div class="col-md-2 col-sm-6">
        <label class="form-label d-block mb-1">Stok</label>
        <input type="number" name="stok" min="0" class="form-control" placeholder="Stok" value="{{ old('stok') }}" required>
      </div>
      <div class="col-md-2 col-sm-6">
        <label class="form-label d-block mb-1">Tanggal Kadaluarsa</label>
        <input type="date" name="tanggal_kadaluarsa" class="form-control" value="{{ old('tanggal_kadaluarsa') }}" required>
      </div>
      <div class="col-12">
        <button class="btn btn-primary">Simpan</button>
      </div>
    </form>

    <div class="table-responsive">
      <table class="table table-hover align-middle">
        <thead>
          <tr>
            <th>Kode Obat</th>
            <th>Nama Obat</th>
            <th>Stok</th>
            <th>Tanggal Kadaluarsa</th>
            <th class="text-end" style="width: 14%">Aksi</th>
          </tr>
        </thead>
        <tbody>
        @foreach($data as $d)
          <tr>
            <td>{{ $d->kode_obat }}</td>
            <td>{{ $d->nama_obat }}</td>
            <td>{{ $d->stok }}</td>
            <td>
              {{ $d->tanggal_kadaluarsa }}
              @if(\Carbon\Carbon::parse($d->tanggal_kadaluarsa)->isPast())
                <span class="badge bg-danger text-white mt-1 d-inline-block small">Kadaluarsa</span>
              @endif
            </td>
            <td class="text-end">
              <form method="POST" action="{{ route('obat.destroy', $d->id) }}" onsubmit="return confirm('Yakin ingin menghapus obat ini?')" class="d-inline">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-danger">Hapus</button>
              </form>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>

    @if(!$data->count())
      <div class="empty-state">Belum ada data obat.</div>
    @endif
  </div>
</div>
@endsection

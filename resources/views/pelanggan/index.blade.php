@extends('layout')
@section('content')
<div class="card">
  <div class="card-header">
    <span class="badge bg-success">Pelanggan</span> Data Pelanggan
  </div>
  <div class="card-body">
    <form method="POST" action="{{ route('pelanggan.store') }}" class="row g-3 mb-4 align-items-end">
      @csrf
      <div class="col-md-4 col-sm-6">
        <label class="form-label d-block mb-1">Nama</label>
        <input name="nama" class="form-control" placeholder="Nama" value="{{ old('nama') }}" required>
      </div>
      <div class="col-md-5 col-sm-6">
        <label class="form-label d-block mb-1">Alamat</label>
        <textarea name="alamat" class="form-control" placeholder="Alamat" rows="2" required>{{ old('alamat') }}</textarea>
      </div>
      <div class="col-md-3 col-sm-6">
        <label class="form-label d-block mb-1">No HP</label>
        <input name="no_hp" class="form-control" placeholder="No HP" value="{{ old('no_hp') }}" required>
      </div>
      <div class="col-12">
        <button class="btn btn-primary">Simpan</button>
      </div>
    </form>

    <div class="table-responsive">
      <table class="table table-hover align-middle">
        <thead>
          <tr>
            <th>Id Pelanggan</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>No HP</th>
            <th class="text-end" style="width: 14%">Aksi</th>
          </tr>
        </thead>
        <tbody>
        @foreach($data as $d)
          <tr>
            <td>{{ $d->id }}</td>
            <td>{{ $d->nama }}</td>
            <td>{{ $d->alamat }}</td>
            <td>{{ $d->no_hp }}</td>
            <td class="text-end">
              <form method="POST" action="{{ route('pelanggan.destroy', $d->id) }}" onsubmit="return confirm('Yakin ingin menghapus pelanggan ini?')" class="d-inline">
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
      <div class="empty-state">Belum ada data pelanggan.</div>
    @endif
  </div>
</div>
@endsection

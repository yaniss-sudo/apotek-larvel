@extends('layout')
@section('content')
<div class="card">
  <div class="card-header">
    <span class="badge bg-success">Staf</span> Data Staf Apotek
  </div>
  <div class="card-body">
    <form method="POST" action="{{ route('staf.store') }}" class="row g-3 mb-4 align-items-end">
      @csrf
      <div class="col-md-3 col-sm-6">
        <label class="form-label d-block mb-1">Nama</label>
        <input name="nama" class="form-control" placeholder="Nama" value="{{ old('nama') }}" required>
      </div>
      <div class="col-md-4 col-sm-6">
        <label class="form-label d-block mb-1">Alamat</label>
        <textarea name="alamat" class="form-control" placeholder="Alamat" rows="2" required>{{ old('alamat') }}</textarea>
      </div>
      <div class="col-md-2 col-sm-6">
        <label class="form-label d-block mb-1">Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir') }}" required>
      </div>
      <div class="col-md-2 col-sm-6">
        <label class="form-label d-block mb-1">Tempat Lahir</label>
        <input name="tempat_lahir" class="form-control" placeholder="Tempat Lahir" value="{{ old('tempat_lahir') }}" required>
      </div>
      <div class="col-md-1 col-sm-6">
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
            <th>Id Staff</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Tanggal Lahir</th>
            <th>Tempat Lahir</th>
            <th>No HP</th>
            <th class="text-end" style="width: 12%">Aksi</th>
          </tr>
        </thead>
        <tbody>
        @foreach($data as $d)
          <tr>
            <td>{{ $d->id }}</td>
            <td>{{ $d->nama }}</td>
            <td>{{ $d->alamat }}</td>
            <td>{{ $d->tanggal_lahir }}</td>
            <td>{{ $d->tempat_lahir }}</td>
            <td>{{ $d->no_hp }}</td>
            <td class="text-end">
              <form method="POST" action="{{ route('staf.destroy', $d->id) }}" onsubmit="return confirm('Yakin ingin menghapus staf ini?')" class="d-inline">
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
      <div class="empty-state">Belum ada data staf apotek.</div>
    @endif
  </div>
</div>
@endsection

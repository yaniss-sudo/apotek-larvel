@extends('layout')
@section('content')
<h3>Staf Apotek</h3>
<form method="POST" action="{{ route('staf.store') }}" class="mb-4">
  @csrf
  <input name="nama" class="form-control mb-2" placeholder="Nama" value="{{ old('nama') }}" required>
  <textarea name="alamat" class="form-control mb-2" placeholder="Alamat" required>{{ old('alamat') }}</textarea>
  <label class="form-label">Tanggal Lahir</label>
  <input type="date" name="tanggal_lahir" class="form-control mb-2" value="{{ old('tanggal_lahir') }}" required>
  <input name="tempat_lahir" class="form-control mb-2" placeholder="Tempat Lahir" value="{{ old('tempat_lahir') }}" required>
  <input name="no_hp" class="form-control mb-2" placeholder="No HP" value="{{ old('no_hp') }}" required>
  <button class="btn btn-primary">Simpan</button>
</form>

<table class="table table-bordered">
  <tr><th>Id Staff</th><th>Nama</th><th>Alamat</th><th>Tanggal Lahir</th><th>Tempat Lahir</th><th>No HP</th><th>Aksi</th></tr>
  @foreach($data as $d)
  <tr>
    <td>{{ $d->id }}</td><td>{{ $d->nama }}</td><td>{{ $d->alamat }}</td>
    <td>{{ $d->tanggal_lahir }}</td><td>{{ $d->tempat_lahir }}</td><td>{{ $d->no_hp }}</td>
    <td>
      <form method="POST" action="{{ route('staf.destroy', $d->id) }}" onsubmit="return confirm('Hapus data ini?')">
        @csrf @method('DELETE')
        <button class="btn btn-sm btn-danger">Hapus</button>
      </form>
    </td>
  </tr>
  @endforeach
</table>
@endsection

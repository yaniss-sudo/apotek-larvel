@extends('layout')
@section('content')
<h3>Daftar Obat</h3>
<form method="POST" action="{{ route('obat.store') }}" class="mb-4">
  @csrf
  <input name="kode_obat" class="form-control mb-2" placeholder="Kode Obat" value="{{ old('kode_obat') }}" required>
  <input name="nama_obat" class="form-control mb-2" placeholder="Nama Obat" value="{{ old('nama_obat') }}" required>
  <input type="number" name="stok" min="0" class="form-control mb-2" placeholder="Stock Obat" value="{{ old('stok') }}" required>
  <label class="form-label">Tanggal Kadaluarsa</label>
  <input type="date" name="tanggal_kadaluarsa" class="form-control mb-2" value="{{ old('tanggal_kadaluarsa') }}" required>
  <button class="btn btn-primary">Simpan</button>
</form>

<table class="table table-bordered">
  <tr><th>Kode Obat</th><th>Nama Obat</th><th>Stock</th><th>Tanggal Kadaluarsa</th><th>Aksi</th></tr>
  @foreach($data as $d)
  <tr @class(['table-danger' => \Carbon\Carbon::parse($d->tanggal_kadaluarsa)->isPast()])>
    <td>{{ $d->kode_obat }}</td><td>{{ $d->nama_obat }}</td><td>{{ $d->stok }}</td><td>{{ $d->tanggal_kadaluarsa }}</td>
    <td>
      <form method="POST" action="{{ route('obat.destroy', $d->id) }}" onsubmit="return confirm('Hapus data ini?')">
        @csrf @method('DELETE')
        <button class="btn btn-sm btn-danger">Hapus</button>
      </form>
    </td>
  </tr>
  @endforeach
</table>
@endsection

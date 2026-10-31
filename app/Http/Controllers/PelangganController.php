<?php
namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PelangganController extends Controller
{
    private function rules(): array
    {
        return [
            'nama'   => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp'  => 'required|string|max:20',
            'foto'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'bio'    => 'nullable|string',
        ];
    }

    private function simpanFoto(Request $r, ?string $lama = null): ?string
    {
        if (!$r->hasFile('foto')) {
            return $lama;
        }

        if ($lama && Storage::disk('public')->exists($lama)) {
            Storage::disk('public')->delete($lama);
        }

        return $r->file('foto')->store('foto-profil/pelanggan', 'public');
    }

    public function index(Request $r)
    {
        $data = Pelanggan::latest()->get();
        return $r->is('api/*') ? response()->json($data)
                               : view('pelanggan.index', compact('data'));
    }

    public function store(Request $r)
    {
        $v = $r->validate($this->rules());
        $v['foto'] = $this->simpanFoto($r);

        $p = Pelanggan::create($v);
        return $r->is('api/*') ? response()->json($p, 201)
                               : back()->with('ok', 'Data pelanggan tersimpan');
    }

    public function show(Pelanggan $pelanggan)
    {
        return response()->json($pelanggan);
    }

    public function update(Request $r, Pelanggan $pelanggan)
    {
        $v = $r->validate($this->rules());

        if ($r->boolean('hapus_foto')) {
            if ($pelanggan->foto && Storage::disk('public')->exists($pelanggan->foto)) {
                Storage::disk('public')->delete($pelanggan->foto);
            }
            $v['foto'] = null;
        } else {
            $v['foto'] = $this->simpanFoto($r, $pelanggan->foto);
        }

        $pelanggan->update($v);
        return $r->is('api/*') ? response()->json($pelanggan)
                               : back()->with('ok', 'Data pelanggan diperbarui');
    }

    public function destroy(Request $r, Pelanggan $pelanggan)
    {
        if ($pelanggan->foto && Storage::disk('public')->exists($pelanggan->foto)) {
            Storage::disk('public')->delete($pelanggan->foto);
        }
        $pelanggan->delete();
        return $r->is('api/*') ? response()->json(['message' => 'Data dihapus'])
                               : back()->with('ok', 'Data dihapus');
    }
}

<?php
namespace App\Http\Controllers;

use App\Models\Staf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StafController extends Controller
{
    private function rules(): array
    {
        return [
            'nama'          => 'required|string|max:255',
            'alamat'        => 'required|string',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir'  => 'required|string|max:255',
            'no_hp'         => 'required|string|max:20',
            'foto'          => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'bio'           => 'nullable|string',
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

        return $r->file('foto')->store('foto-profil/staf', 'public');
    }

    public function index(Request $r)
    {
        $data = Staf::latest()->get();
        return $r->is('api/*') ? response()->json($data)
                               : view('staf.index', compact('data'));
    }

    public function store(Request $r)
    {
        $v = $r->validate($this->rules());
        $v['foto'] = $this->simpanFoto($r);

        $s = Staf::create($v);
        return $r->is('api/*') ? response()->json($s, 201)
                               : back()->with('ok', 'Data staf tersimpan');
    }

    public function show(Staf $staf)
    {
        return response()->json($staf);
    }

    public function update(Request $r, Staf $staf)
    {
        $v = $r->validate($this->rules());

        if ($r->boolean('hapus_foto')) {
            if ($staf->foto && Storage::disk('public')->exists($staf->foto)) {
                Storage::disk('public')->delete($staf->foto);
            }
            $v['foto'] = null;
        } else {
            $v['foto'] = $this->simpanFoto($r, $staf->foto);
        }

        $staf->update($v);
        return $r->is('api/*') ? response()->json($staf)
                               : back()->with('ok', 'Data staf diperbarui');
    }

    public function destroy(Request $r, Staf $staf)
    {
        if ($staf->foto && Storage::disk('public')->exists($staf->foto)) {
            Storage::disk('public')->delete($staf->foto);
        }
        $staf->delete();
        return $r->is('api/*') ? response()->json(['message' => 'Data dihapus'])
                               : back()->with('ok', 'Data dihapus');
    }
}

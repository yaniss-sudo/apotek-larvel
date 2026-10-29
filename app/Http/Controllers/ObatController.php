<?php
namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ObatController extends Controller
{
    private function rules(?int $id = null): array
    {
        return [
            'kode_obat'          => ['required', 'string', 'max:50', Rule::unique('obat', 'kode_obat')->ignore($id)],
            'nama_obat'          => 'required|string|max:255',
            'stok'               => 'required|integer|min:0',
            'tanggal_kadaluarsa' => 'required|date',
        ];
    }

    public function index(Request $r)
    {
        $data = Obat::latest()->get();
        return $r->is('api/*') ? response()->json($data)
                               : view('obat.index', compact('data'));
    }

    public function store(Request $r)
    {
        $o = Obat::create($r->validate($this->rules()));
        return $r->is('api/*') ? response()->json($o, 201)
                               : back()->with('ok', 'Data obat tersimpan');
    }

    public function show(Obat $obat)
    {
        return response()->json($obat);
    }

    public function update(Request $r, Obat $obat)
    {
        $obat->update($r->validate($this->rules($obat->id)));
        return response()->json($obat);
    }

    public function destroy(Request $r, Obat $obat)
    {
        $obat->delete();
        return $r->is('api/*') ? response()->json(['message' => 'Data dihapus'])
                               : back()->with('ok', 'Data dihapus');
    }
}

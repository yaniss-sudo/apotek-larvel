<?php
namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    private function rules(): array
    {
        return [
            'nama'   => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp'  => 'required|string|max:20',
        ];
    }

    public function index(Request $r)
    {
        $data = Pelanggan::latest()->get();
        return $r->is('api/*') ? response()->json($data)
                               : view('pelanggan.index', compact('data'));
    }

    public function store(Request $r)
    {
        $p = Pelanggan::create($r->validate($this->rules()));
        return $r->is('api/*') ? response()->json($p, 201)
                               : back()->with('ok', 'Data pelanggan tersimpan');
    }

    public function show(Pelanggan $pelanggan)
    {
        return response()->json($pelanggan);
    }

    public function update(Request $r, Pelanggan $pelanggan)
    {
        $pelanggan->update($r->validate($this->rules()));
        return response()->json($pelanggan);
    }

    public function destroy(Request $r, Pelanggan $pelanggan)
    {
        $pelanggan->delete();
        return $r->is('api/*') ? response()->json(['message' => 'Data dihapus'])
                               : back()->with('ok', 'Data dihapus');
    }
}

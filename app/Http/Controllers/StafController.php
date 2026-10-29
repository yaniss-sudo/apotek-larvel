<?php
namespace App\Http\Controllers;

use App\Models\Staf;
use Illuminate\Http\Request;

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
        ];
    }

    public function index(Request $r)
    {
        $data = Staf::latest()->get();
        return $r->is('api/*') ? response()->json($data)
                               : view('staf.index', compact('data'));
    }

    public function store(Request $r)
    {
        $s = Staf::create($r->validate($this->rules()));
        return $r->is('api/*') ? response()->json($s, 201)
                               : back()->with('ok', 'Data staf tersimpan');
    }

    public function show(Staf $staf)
    {
        return response()->json($staf);
    }

    public function update(Request $r, Staf $staf)
    {
        $staf->update($r->validate($this->rules()));
        return response()->json($staf);
    }

    public function destroy(Request $r, Staf $staf)
    {
        $staf->delete();
        return $r->is('api/*') ? response()->json(['message' => 'Data dihapus'])
                               : back()->with('ok', 'Data dihapus');
    }
}

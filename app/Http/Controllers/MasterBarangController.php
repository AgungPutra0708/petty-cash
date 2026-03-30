<?php

namespace App\Http\Controllers;

use App\Models\Bilyet;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class MasterBarangController extends Controller
{
    public function index()
    {
        return view('master-barang.index');
    }

    public function getDataBarang()
    {
        $query = Barang::all(); // kalau mau ambil user

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '
                <div class="table-data-feature">
                    <a href="' . route('master-barang.edit', $row->id) . '" class="item" title="Edit">
                        <i class="zmdi zmdi-edit"></i>
                    </a>

                    <button class="item btn-delete" data-id="' . $row->id . '" title="Delete">
                        <i class="zmdi zmdi-delete"></i>
                    </button>
                </div>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function create()
    {
        return view('master-barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_barang' => 'required|string|max:255|unique:barangs,nomor_barang',
            'nama_barang' => 'required|string|max:255',
            'description' => 'nullable|string|max:500'
        ]);

        $barang = Barang::where('nomor_barang', $request->nomor_barang)->first();

        if ($barang) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['nomor_barang' => 'Nomor barang sudah ada']);
        }

        Barang::create([
            'nomor_barang' => $request->nomor_barang,
            'name' => $request->nama_barang,
            'description' => $request->description,
        ]);

        return redirect()->route('master-barang.index')
            ->with('success', 'Barang berhasil ditambahkan');
    }

    // EDIT
    public function edit(Barang $barang)
    {
        return view('master-barang.edit', compact('barang'));
    }

    // UPDATE
    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'nomor_barang' => 'required|string|max:255|unique:barangs,nomor_barang,' . $barang->id,
            'nama_barang' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
        ]);

        $existingBarang = Barang::where('nomor_barang', $request->nomor_barang)->first();
        
        if ($existingBarang && $existingBarang->id !== $barang->id) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['nomor_barang' => 'Nomor barang sudah ada']);
        }

        $barang->update([
            'nomor_barang' => $request->nomor_barang,
            'name' => $request->nama_barang,
            'description' => $request->description,
        ]);

        return redirect()->route('master-barang.index')
            ->with('success', 'Barang berhasil diupdate');
    }

    // DELETE
    public function destroy(Barang $barang)
    {
        $barang->delete();

        return response()->json([
            'success' => true,
            'message' => 'Barang berhasil dihapus'
        ]);
    }
    public function getLastNumber(Barang $barang)
    {
        $last = Barang::where('id', $barang->id)
            ->orderBy('id', 'desc')
            ->first();

        if ($last) {
            $nextNumber = (int)$last->nomor_barang + 1;
        } else {
            $nextNumber = 1;
        }

        return response()->json([
            'next_number' => $nextNumber
        ]);
    }
}

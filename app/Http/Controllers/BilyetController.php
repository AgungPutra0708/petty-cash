<?php

namespace App\Http\Controllers;

use App\Models\Bilyet;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class BilyetController extends Controller
{
    public function index()
    {
        return view('bilyet.index');
    }

    public function getDataBilyet()
    {
        $query = Bilyet::with('user'); // kalau mau ambil user

        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('jumlah', function ($row) {
                return number_format($row->jumlah, 2, ',', '.');
            })
            ->addColumn('user', fn($row) => $row->user->name ?? '-')
            ->addColumn('action', function ($row) {
                return '
                <div class="table-data-feature">
                    <a href="' . route('bilyet.edit', $row->id) . '" class="item" title="Edit">
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
        $customers = Customer::all();
        return view('bilyet.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_bilyet' => 'required|string|max:255',
            'customer_id' => 'required|exists:customers,id',
            'nama_bank' => 'required|string|max:255',
            'jumlah' => 'required|numeric',
            'tanggal_terbit' => 'required|date',
            'tanggal_jatuh_tempo' => 'required|date|after_or_equal:tanggal_terbit',
            'keterangan' => 'nullable|string',
        ]);

        Bilyet::create([
            'nomor_bilyet' => $request->nomor_bilyet,
            'customer_id' => $request->customer_id,
            'nama_bank' => $request->nama_bank,
            'jumlah' => $request->jumlah,
            'tanggal_terbit' => $request->tanggal_terbit,
            'tanggal_jatuh_tempo' => $request->tanggal_jatuh_tempo,
            'keterangan' => $request->keterangan,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('bilyet.index')
            ->with('success', 'Bilyet berhasil ditambahkan');
    }

    // EDIT
    public function edit(Bilyet $bilyet)
    {
        return view('bilyet.edit', compact('bilyet'));
    }

    // UPDATE
    public function update(Request $request, Bilyet $bilyet)
    {
        $request->validate([
            'nomor_bilyet' => 'required|string|max:255',
            'customer_id' => 'required|exists:customers,id',
            'nama_bank' => 'required|string|max:255',
            'jumlah' => 'required|numeric',
            'tanggal_terbit' => 'required|date',
            'tanggal_jatuh_tempo' => 'required|date|after_or_equal:tanggal_terbit',
            'keterangan' => 'nullable|string',
        ]);

        $bilyet->update([
            'nomor_bilyet' => $request->nomor_bilyet,
            'customer_id' => $request->customer_id,
            'nama_bank' => $request->nama_bank,
            'jumlah' => $request->jumlah,
            'tanggal_terbit' => $request->tanggal_terbit,
            'tanggal_jatuh_tempo' => $request->tanggal_jatuh_tempo,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('bilyet.index')
            ->with('success', 'Bilyet berhasil diupdate');
    }

    // DELETE
    public function destroy(Bilyet $bilyet)
    {
        $bilyet->delete();

        return response()->json([
            'success' => true,
            'message' => 'Bilyet berhasil dihapus'
        ]);
    }
    public function getLastNumber(Customer $customer)
    {
        // ambil nomor customer
        $customerNumber = $customer->nomor_customer;

        // cari nomor terakhir untuk customer itu
        $last = Bilyet::where('customer_id', $customer->id)
            ->orderBy('id', 'desc')
            ->first();

        if ($last && $last->nomor_bilyet) {

            // ambil 2 digit terakhir saja
            $lastTwo = substr($last->nomor_bilyet, -2);

            $nextNumber = (int)$lastTwo + 1;
        } else {

            $nextNumber = 1;
        }

        // format jadi 2 digit (01, 02, 03...)
        $nextFormatted = str_pad($nextNumber, 2, '0', STR_PAD_LEFT);

        // susun ulang format
        $newNomor = 'BIL/' . $customerNumber . '/' . $nextFormatted;

        return response()->json([
            'next_number' => $newNomor
        ]);
    }
}

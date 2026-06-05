<?php

namespace App\Http\Controllers;

use App\Models\PettyCash;
use App\Models\PettyCashDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PettyCashController extends Controller
{
    public function index()
    {
        return view('petty-cash.index');
    }

    public function getDataPettyCash()
    {
        $query = PettyCash::with('creator')
            ->orderBy('created_at', 'desc');

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('bulan_display', function ($row) {
                return $row->bulan->format('F Y');
            })
            ->addColumn('status_badge', function ($row) {
                $badges = [
                    'draft' => '<span class="badge badge-warning">Draft</span>',
                    'approved' => '<span class="badge badge-success">Approved</span>',
                    'closed' => '<span class="badge badge-info">Closed</span>',
                ];
                return $badges[$row->status] ?? '';
            })
            ->addColumn('action', function ($row) {
                return '
                <div class="table-data-feature">
                    <a href="' . route('petty-cash.show', $row->id) . '" class="item" title="View">
                        <i class="zmdi zmdi-eye"></i>
                    </a>
                    <a href="' . route('petty-cash.edit', $row->id) . '" class="item" title="Edit">
                        <i class="zmdi zmdi-edit"></i>
                    </a>
                    <button class="item btn-delete" data-id="' . $row->id . '" title="Delete">
                        <i class="zmdi zmdi-delete"></i>
                    </button>
                </div>
                ';
            })
            ->rawColumns(['action', 'status_badge'])
            ->make(true);
    }

    public function create()
    {
        // Generate nomor petty cash
        $lastPettyCash = PettyCash::orderBy('id', 'desc')->first();
        $nextNumber = ($lastPettyCash ? (int)substr($lastPettyCash->nomor_petty_cash, -4) + 1 : 1);
        $nomorPettyCash = 'PC-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        return view('petty-cash.create', compact('nomorPettyCash'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_petty_cash' => 'required|string|unique:petty_cashes',
            'bulan' => 'required|date',
            'jumlah_awal' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string',
        ]);

        $pettyCash = PettyCash::create([
            'nomor_petty_cash' => $request->nomor_petty_cash,
            'bulan' => $request->bulan,
            'jumlah_awal' => $request->jumlah_awal,
            'total_pengeluaran' => 0,
            'jumlah_akhir' => $request->jumlah_awal,
            'status' => 'draft',
            'keterangan' => $request->keterangan,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('petty-cash.show', $pettyCash->id)
            ->with('success', 'Petty cash berhasil dibuat');
    }

    public function show(PettyCash $pettyCash)
    {
        $pettyCash->load('details', 'creator');
        return view('petty-cash.show', compact('pettyCash'));
    }

    public function edit(PettyCash $pettyCash)
    {
        $pettyCash->load('details');
        return view('petty-cash.edit', compact('pettyCash'));
    }

    public function update(Request $request, PettyCash $pettyCash)
    {
        $request->validate([
            'jumlah_awal' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string',
        ]);

        $pettyCash->update([
            'jumlah_awal' => $request->jumlah_awal,
            'keterangan' => $request->keterangan,
        ]);

        // Recalculate total pengeluaran
        $totalPengeluaran = $pettyCash->details()->sum('jumlah_pengeluaran');
        $pettyCash->update([
            'total_pengeluaran' => $totalPengeluaran,
            'jumlah_akhir' => $request->jumlah_awal - $totalPengeluaran,
        ]);

        return redirect()->route('petty-cash.show', $pettyCash->id)
            ->with('success', 'Petty cash berhasil diperbarui');
    }

    public function destroy(PettyCash $pettyCash)
    {
        if ($pettyCash->status != 'draft') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya petty cash dengan status draft yang dapat dihapus'
            ]);
        }

        $pettyCash->delete();

        return response()->json([
            'success' => true,
            'message' => 'Petty cash berhasil dihapus'
        ]);
    }

    // Detail pengeluaran
    public function storeDetail(Request $request, PettyCash $pettyCash)
    {
        $request->validate([
            'tanggal_pengeluaran' => 'required|date',
            'keterangan_pengeluaran' => 'required|string',
            'jumlah_pengeluaran' => 'required|numeric|min:0',
            'penerima' => 'nullable|string',
        ]);

        PettyCashDetail::create([
            'petty_cash_id' => $pettyCash->id,
            'tanggal_pengeluaran' => $request->tanggal_pengeluaran,
            'keterangan_pengeluaran' => $request->keterangan_pengeluaran,
            'jumlah_pengeluaran' => $request->jumlah_pengeluaran,
            'penerima' => $request->penerima,
            'created_by' => Auth::id(),
        ]);

        // Recalculate total pengeluaran
        $totalPengeluaran = $pettyCash->details()->sum('jumlah_pengeluaran');
        $pettyCash->update([
            'total_pengeluaran' => $totalPengeluaran,
            'jumlah_akhir' => $pettyCash->jumlah_awal - $totalPengeluaran,
        ]);

        return redirect()->back()
            ->with('success', 'Pengeluaran berhasil ditambahkan');
    }

    public function editDetail(PettyCashDetail $detail)
    {
        return view('petty-cash.edit-detail', compact('detail'));
    }

    public function updateDetail(Request $request, PettyCashDetail $detail)
    {
        $request->validate([
            'tanggal_pengeluaran' => 'required|date',
            'keterangan_pengeluaran' => 'required|string',
            'jumlah_pengeluaran' => 'required|numeric|min:0',
            'penerima' => 'nullable|string',
        ]);

        $detail->update([
            'tanggal_pengeluaran' => $request->tanggal_pengeluaran,
            'keterangan_pengeluaran' => $request->keterangan_pengeluaran,
            'jumlah_pengeluaran' => $request->jumlah_pengeluaran,
            'penerima' => $request->penerima,
        ]);

        $pettyCash = $detail->pettyCash;
        $totalPengeluaran = $pettyCash->details()->sum('jumlah_pengeluaran');
        $pettyCash->update([
            'total_pengeluaran' => $totalPengeluaran,
            'jumlah_akhir' => $pettyCash->jumlah_awal - $totalPengeluaran,
        ]);

        return redirect()->route('petty-cash.show', $pettyCash->id)
            ->with('success', 'Pengeluaran berhasil diperbarui');
    }

    public function destroyDetail(PettyCashDetail $detail)
    {
        $pettyCash = $detail->pettyCash;
        $detail->delete();

        // Recalculate total pengeluaran
        $totalPengeluaran = $pettyCash->details()->sum('jumlah_pengeluaran');
        $pettyCash->update([
            'total_pengeluaran' => $totalPengeluaran,
            'jumlah_akhir' => $pettyCash->jumlah_awal - $totalPengeluaran,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pengeluaran berhasil dihapus'
        ]);
    }

    public function report()
    {
        $pettyCashes = PettyCash::with('details', 'creator')
            ->orderBy('bulan', 'desc')
            ->get();

        return view('petty-cash.report', compact('pettyCashes'));
    }
}

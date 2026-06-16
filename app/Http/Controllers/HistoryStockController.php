<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\HistoryStock;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Yajra\DataTables\Facades\DataTables;

class HistoryStockController extends Controller
{
    public function index()
    {
        $barangs = Barang::all();
        return view('stock.history-index', compact('barangs'));
    }

    public function indexPemasukan()
    {
        $barangs = Barang::all();
        return view('stock.pemasukan-index', compact('barangs'));
    }

    public function indexPengeluaran()
    {
        $barangs = Barang::all();
        return view('stock.pengeluaran-index', compact('barangs'));
    }

    public function getDataHistoryStock()
    {
        $query = HistoryStock::with('barang', 'creator')
            ->orderBy('tanggal', 'desc');

        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('tanggal', function ($row) {
                return \Carbon\Carbon::parse($row->tanggal)
                    ->format('d/m/Y');
            })
            ->addColumn('barang_name', function ($row) {
                return $row->barang->name;
            })
            ->addColumn('type_badge', function ($row) {
                $badge = $row->type == 'masuk' 
                    ? '<span class="badge badge-success">Masuk</span>' 
                    : '<span class="badge badge-danger">Keluar</span>';
                return $badge;
            })
            ->addColumn('status_badge', function ($row) {
                $statusMap = [
                    'draft' => '<span class="badge badge-warning">Draft</span>',
                    'pending_approval' => '<span class="badge badge-info">Pending Approval</span>',
                    'approved' => '<span class="badge badge-success">Approved</span>',
                    'rejected' => '<span class="badge badge-danger">Rejected</span>',
                ];
                return $statusMap[$row->status] ?? '';
            })
            ->rawColumns(['type_badge', 'status_badge'])
            ->make(true);
    }

    public function getDataPemasukan()
    {
        $query = HistoryStock::with('barang', 'creator')
            ->where('type', 'masuk')
            ->orderBy('tanggal', 'desc');

        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('tanggal', function ($row) {
                return \Carbon\Carbon::parse($row->tanggal)
                    ->format('d/m/Y');
            })
            ->addColumn('barang_name', function ($row) {
                return $row->barang->name;
            })
            ->addColumn('status_badge', function ($row) {
                $statusMap = [
                    'draft' => '<span class="badge badge-warning">Draft</span>',
                    'pending_approval' => '<span class="badge badge-info">Pending Approval</span>',
                    'approved' => '<span class="badge badge-success">Approved</span>',
                    'rejected' => '<span class="badge badge-danger">Rejected</span>',
                ];
                return $statusMap[$row->status] ?? '';
            })
            ->addColumn('action', function ($row) {
                $actions = '<div class="table-data-feature">';
                
                if ($row->status == 'draft' && (Auth::user()->isCS() || Auth::user()->isAdmin())) {
                    $actions .= '<a href="' . route('pemasukan.edit', $row->id) . '" class="item" title="Edit">
                        <i class="zmdi zmdi-edit"></i>
                    </a>';
                    
                    $actions .= '<button class="item btn-delete" data-id="' . $row->id . '" title="Delete">
                        <i class="zmdi zmdi-delete"></i>
                    </button>';
                }
                
                if ($row->status == 'draft' && (Auth::user()->isCheckerCS() || Auth::user()->isAdmin())) {
                    $actions .= '<button class="item btn-submit-approval" data-id="' . $row->id . '" title="Submit untuk Approval">
                        <i class="zmdi zmdi-check"></i>
                    </button>';
                }
                
                if ($row->status == 'pending_approval' && (Auth::user()->isApprover() || Auth::user()->isApprover() || Auth::user()->isAdmin())) {
                    $actions .= '<button class="item btn-approve" data-id="' . $row->id . '" title="Approve" style="color: green;">
                        <i class="zmdi zmdi-check-circle"></i>
                    </button>';
                    $actions .= '<button class="item btn-reject" data-id="' . $row->id . '" title="Reject" style="color: red;">
                        <i class="zmdi zmdi-close-circle"></i>
                    </button>';
                }
                
                $actions .= '</div>';
                return $actions;
            })
            ->rawColumns(['action', 'status_badge'])
            ->make(true);
    }

    public function getDataPengeluaran()
    {
        $query = HistoryStock::with('barang', 'creator')
            ->where('type', 'keluar')
            ->orderBy('tanggal', 'desc');

        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('tanggal', function ($row) {
                return \Carbon\Carbon::parse($row->tanggal)
                    ->format('d/m/Y');
            })
            ->addColumn('barang_name', function ($row) {
                return $row->barang->name;
            })
            ->addColumn('status_badge', function ($row) {
                $statusMap = [
                    'draft' => '<span class="badge badge-warning">Draft</span>',
                    'pending_approval' => '<span class="badge badge-info">Pending Approval</span>',
                    'approved' => '<span class="badge badge-success">Approved</span>',
                    'rejected' => '<span class="badge badge-danger">Rejected</span>',
                ];
                return $statusMap[$row->status] ?? '';
            })
            ->addColumn('action', function ($row) {
                $actions = '<div class="table-data-feature">';
                
                if ($row->status == 'draft' && (Auth::user()->isCS() || Auth::user()->isAdmin())) {
                    $actions .= '<a href="' . route('pengeluaran.edit', $row->id) . '" class="item" title="Edit">
                        <i class="zmdi zmdi-edit"></i>
                    </a>';
                
                    $actions .= '<button class="item btn-delete" data-id="' . $row->id . '" title="Delete">
                        <i class="zmdi zmdi-delete"></i>
                    </button>';
                }
                
                if ($row->status == 'draft' && (Auth::user()->isCheckerCS() || Auth::user()->isAdmin())) {
                    $actions .= '<button class="item btn-submit-approval" data-id="' . $row->id . '" title="Submit untuk Approval">
                        <i class="zmdi zmdi-check"></i>
                    </button>';
                }
                
                if ($row->status == 'pending_approval' && (Auth::user()->isApprover() || Auth::user()->isApprover() || Auth::user()->isAdmin())) {
                    $actions .= '<button class="item btn-approve" data-id="' . $row->id . '" title="Approve" style="color: green;">
                        <i class="zmdi zmdi-check-circle"></i>
                    </button>';
                    $actions .= '<button class="item btn-reject" data-id="' . $row->id . '" title="Reject" style="color: red;">
                        <i class="zmdi zmdi-close-circle"></i>
                    </button>';
                }
                
                $actions .= '</div>';
                return $actions;
            })
            ->rawColumns(['action', 'status_badge'])
            ->make(true);
    }

    public function create()
    {
        $barangs = Barang::all();
        return view('stock.history-create', compact('barangs'));
    }

    public function createPemasukan()
    {
        $barangs = Barang::all();
        return view('stock.pemasukan-create', compact('barangs'));
    }

    public function createPengeluaran()
    {
        $barangs = Barang::all();
        return view('stock.pengeluaran-create', compact('barangs'));
    }

    public function storePemasukan(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'quantity' => 'required|integer|min:1',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        HistoryStock::create([
            'barang_id' => $request->barang_id,
            'type' => 'masuk',
            'quantity' => $request->quantity,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
            'status' => 'draft',
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('pemasukan.index')
            ->with('success', 'Pemasukan barang berhasil dibuat. Silakan submit untuk approval.');
    }

    public function storePengeluaran(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'quantity' => 'required|integer|min:1',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        HistoryStock::create([
            'barang_id' => $request->barang_id,
            'type' => 'keluar',
            'quantity' => $request->quantity,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
            'status' => 'draft',
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('pengeluaran.index')
            ->with('success', 'Pengeluaran barang berhasil dibuat. Silakan submit untuk approval.');
    }

    public function editPemasukan(HistoryStock $historyStock)
    {
        if ($historyStock->status != 'draft' || $historyStock->type != 'masuk') {
            return redirect()->route('pemasukan.index')
                ->with('error', 'Hanya pemasukan dengan status draft yang dapat diedit');
        }

        $barangs = Barang::all();
        return view('stock.pemasukan-edit', compact('historyStock', 'barangs'));
    }

    public function editPengeluaran(HistoryStock $historyStock)
    {
        if ($historyStock->status != 'draft' || $historyStock->type != 'keluar') {
            return redirect()->route('pengeluaran.index')
                ->with('error', 'Hanya pengeluaran dengan status draft yang dapat diedit');
        }

        $barangs = Barang::all();
        return view('stock.pengeluaran-edit', compact('historyStock', 'barangs'));
    }

    public function updatePemasukan(Request $request, HistoryStock $historyStock)
    {
        if ($historyStock->status != 'draft' || $historyStock->type != 'masuk') {
            return redirect()->route('pemasukan.index')
                ->with('error', 'Hanya pemasukan dengan status draft yang dapat diupdate');
        }

        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'quantity' => 'required|integer|min:1',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        $historyStock->update([
            'barang_id' => $request->barang_id,
            'quantity' => $request->quantity,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('pemasukan.index')
            ->with('success', 'Pemasukan barang berhasil diperbarui');
    }

    public function updatePengeluaran(Request $request, HistoryStock $historyStock)
    {
        if ($historyStock->status != 'draft' || $historyStock->type != 'keluar') {
            return redirect()->route('pengeluaran.index')
                ->with('error', 'Hanya pengeluaran dengan status draft yang dapat diupdate');
        }

        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'quantity' => 'required|integer|min:1',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        $historyStock->update([
            'barang_id' => $request->barang_id,
            'quantity' => $request->quantity,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('pengeluaran.index')
            ->with('success', 'Pengeluaran barang berhasil diperbarui');
    }

    public function destroy(HistoryStock $historyStock)
    {
        if ($historyStock->status != 'draft') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya riwayat stok dengan status draft yang dapat dihapus'
            ]);
        }

        $historyStock->delete();

        return response()->json([
            'success' => true,
            'message' => 'Stok berhasil dihapus'
        ]);
    }

    public function submitApproval(HistoryStock $historyStock)
    {
        if ($historyStock->status != 'draft') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya riwayat stok dengan status draft yang dapat disubmit'
            ]);
        }

        $barangs = Barang::find($historyStock->barang_id);
        if ($historyStock->type == 'keluar') {
            if ($historyStock->quantity > $barangs->qty) {
                return response()->json([
                    'success' => false,
                    'message' => 'Stok tidak mencukupi untuk pengeluaran ini. Stok saat ini: ' . $barangs->qty
                ]);
            }
        }

        $historyStock->update(['status' => 'pending_approval']);

        return response()->json([
            'success' => true,
            'message' => 'Riwayat stok berhasil disubmit untuk approval'
        ]);
    }

    public function approve(Request $request, HistoryStock $historyStock)
    {
        if ($historyStock->status != 'pending_approval') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya riwayat stok dengan status pending approval yang dapat di-approve'
            ]);
        }

        $barangs = Barang::find($historyStock->barang_id);
        if ($historyStock->type == 'keluar') {
            if ($historyStock->quantity > $barangs->qty) {
                return response()->json([
                    'success' => false,
                    'message' => 'Stok tidak mencukupi untuk pengeluaran ini. Stok saat ini: ' . $barangs->qty
                ]);
            }else{
                // Jika pengeluaran, langsung update stok
                $barangs->update(['qty' => $barangs->qty - $historyStock->quantity]);
            }
        }elseif ($historyStock->type == 'masuk') {
            // Jika pemasukan, langsung update stok
            $barangs->update(['qty' => $barangs->qty + $historyStock->quantity]);
        }

        $historyStock->update([
            'status' => 'approved',
            'approved_by' => Auth::id(),
            'tanggal_approved' => now(),
            'catatan_approval' => $request->catatan_approval ?? null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Riwayat stok berhasil di-approve'
        ]);
    }

    public function reject(Request $request, HistoryStock $historyStock)
    {
        $request->validate([
            'catatan_rejection' => 'required|string',
        ]);

        if ($historyStock->status != 'pending_approval') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya riwayat stok dengan status pending approval yang dapat di-reject'
            ]);
        }

        $historyStock->update([
            'status' => 'rejected',
            'approved_by' => Auth::id(),
            'tanggal_approved' => now(),
            'catatan_approval' => $request->catatan_rejection,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Riwayat stok berhasil di-reject'
        ]);
    }

    public function report()
    {
        return view('stock.report');
    }

    public function getStockSummary()
    {
        $query = Barang::query()
            ->select([
                'barangs.id',
                'barangs.name',
                'barangs.qty',
            ])
            ->selectRaw("
                COALESCE(
                    (
                        SELECT SUM(quantity)
                        FROM history_stocks hs
                        WHERE hs.barang_id = barangs.id
                        AND hs.type = 'masuk'
                        AND hs.status = 'approved'
                    ),0
                ) as total_masuk
            ")
            ->selectRaw("
                COALESCE(
                    (
                        SELECT SUM(quantity)
                        FROM history_stocks hs
                        WHERE hs.barang_id = barangs.id
                        AND hs.type = 'keluar'
                        AND hs.status = 'approved'
                    ),0
                ) as total_keluar
            ");

        return DataTables::of($query)
            ->addIndexColumn()
            ->make(true);
    }

    private function getStockSummaryData()
    {
        return Barang::query()
            ->select([
                'barangs.id',
                'barangs.name',
                'barangs.qty',
            ])
            ->selectRaw("
                COALESCE(
                    (
                        SELECT SUM(quantity)
                        FROM history_stocks hs
                        WHERE hs.barang_id = barangs.id
                        AND hs.type = 'masuk'
                        AND hs.status = 'approved'
                    ),0
                ) as total_masuk
            ")
            ->selectRaw("
                COALESCE(
                    (
                        SELECT SUM(quantity)
                        FROM history_stocks hs
                        WHERE hs.barang_id = barangs.id
                        AND hs.type = 'keluar'
                        AND hs.status = 'approved'
                    ),0
                ) as total_keluar
            ")
            ->get();
    }

    public function exportExcel()
    {
        $data = $this->getStockSummaryData();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'LAPORAN RINGKASAN STOK');

        $sheet->setCellValue('A3', 'No');
        $sheet->setCellValue('B3', 'Nama Barang');
        $sheet->setCellValue('C3', 'Masuk');
        $sheet->setCellValue('D3', 'Keluar');
        $sheet->setCellValue('E3', 'Stok Akhir');

        $row = 4;
        $no = 1;

        foreach ($data as $item) {
            $sheet->setCellValue('A'.$row, $no++);
            $sheet->setCellValue('B'.$row, $item->name);
            $sheet->setCellValue('C'.$row, $item->total_masuk);
            $sheet->setCellValue('D'.$row, $item->total_keluar);
            $sheet->setCellValue('E'.$row, $item->qty);
            $row++;
        }

        foreach (range('A', 'E') as $column) {
            $sheet->getColumnDimension($column)
                ->setAutoSize(true);
        }

        $fileName = 'Laporan_Stok_'.date('YmdHis').'.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$fileName\"");

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    public function exportPdf()
    {
        $stocks = $this->getStockSummaryData();

        $pdf = Pdf::loadView(
            'stock.report-pdf',
            compact('stocks')
        );

        return $pdf->download(
            'Laporan_Stok_'.date('YmdHis').'.pdf'
        );
    }
}

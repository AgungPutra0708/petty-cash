<?php

namespace App\Http\Controllers;

use App\Models\Bilyet;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{
    public function index()
    {
        return view('customer.index');
    }

    public function getDataCustomer()
    {
        $query = Customer::all(); // kalau mau ambil user

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '
                <div class="table-data-feature">
                    <a href="' . route('customer.edit', $row->id) . '" class="item" title="Edit">
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
        return view('customer.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_customer' => 'required|string|max:255|unique:customers,nomor_customer',
            'nama_customer' => 'required|string|max:255',
            'alamat' => 'nullable|string|max:500',
            'phone' => 'required|string|max:255',
        ]);

        Customer::create([
            'nomor_customer' => $request->nomor_customer,
            'name' => $request->nama_customer,
            'address' => $request->alamat,
            'phone' => $request->phone,
        ]);

        return redirect()->route('customer.index')
            ->with('success', 'Customer berhasil ditambahkan');
    }

    // EDIT
    public function edit(Customer $customer)
    {
        return view('customer.edit', compact('customer'));
    }

    // UPDATE
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'nomor_customer' => 'required|string|max:255|unique:customers,nomor_customer,' . $customer->id,
            'nama_customer' => 'required|string|max:255',
            'alamat' => 'nullable|string|max:500',
            'phone' => 'required|string|max:255',
        ]);

        $customer->update([
            'nomor_customer' => $request->nomor_customer,
            'name' => $request->nama_customer,
            'address' => $request->alamat,
            'phone' => $request->phone,
        ]);

        return redirect()->route('customer.index')
            ->with('success', 'Customer berhasil diupdate');
    }

    // DELETE
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return response()->json([
            'success' => true,
            'message' => 'Customer berhasil dihapus'
        ]);
    }
    public function getLastNumber(Customer $customer)
    {
        $last = Customer::where('id', $customer->id)
            ->orderBy('id', 'desc')
            ->first();

        if ($last) {
            $nextNumber = (int)$last->nomor_customer + 1;
        } else {
            $nextNumber = 1;
        }

        return response()->json([
            'next_number' => $nextNumber
        ]);
    }
}

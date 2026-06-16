<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index');
    }

    public function getDataUser()
    {
        $query = User::with('roles');

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('roles_display', function ($row) {
                $roles = $row->roles->pluck('display_name')->implode(', ');
                return $roles ?: '<span class="text-muted">Belum ada role</span>';
            })
            ->addColumn('action', function ($row) {
                return '
                <div class="table-data-feature">
                    <a href="' . route('user.edit', $row->id) . '" class="item" title="Edit">
                        <i class="zmdi zmdi-edit"></i>
                    </a>
                    <button class="item btn-delete" data-id="' . $row->id . '" title="Delete">
                        <i class="zmdi zmdi-delete"></i>
                    </button>
                </div>
                ';
            })
            ->rawColumns(['action', 'roles_display'])
            ->make(true);
    }

    public function create()
    {
        $roles = Role::all();
        return view('user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->roles()->attach($request->roles);

        return redirect()->route('user.index')
            ->with('success', 'User berhasil ditambahkan');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $userRoles = $user->roles->pluck('id')->toArray();
        return view('user.edit', compact('user', 'roles', 'userRoles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($request->password) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        $user->roles()->sync($request->roles);

        return redirect()->route('user.index')
            ->with('success', 'User berhasil diperbarui');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak dapat menghapus user yang sedang login'
            ]);
        }

        $user->roles()->detach();
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User berhasil dihapus'
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'administrator',
                'display_name' => 'Administrator',
                'description' => 'Administrator - Akses penuh ke semua fitur dan dapat menambah user',
            ],
            [
                'name' => 'maker',
                'display_name' => 'Maker (CS Bilyet & Teller Kas)',
                'description' => 'Maker - Membuat transaksi pemasukan dan pengeluaran stock',
            ],
            [
                'name' => 'checker_approval',
                'display_name' => 'Checker Approval (BOSM)',
                'description' => 'Checker Approval - Memeriksa dan memberikan rekomendasi approval',
            ],
            [
                'name' => 'approval',
                'display_name' => 'Approval (BOSM)',
                'description' => 'Approval - Melakukan final approval/rejection transaksi',
            ],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(
                ['name' => $role['name']],
                $role
            );
        }
    }
}

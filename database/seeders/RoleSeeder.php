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
                'name' => 'cs',
                'display_name' => 'Maker (CS Bilyet)',
                'description' => 'Maker - Membuat transaksi pemasukan dan pengeluaran stock',
            ],
            [
                'name' => 'teller',
                'display_name' => 'Maker (Teller Kas)',
                'description' => 'Maker - Membuat transaksi pemasukan dan pengeluaran stock',
            ],
            [
                'name' => 'checker_cs',
                'display_name' => 'Checker CS (BOSM)',
                'description' => 'Checker Approval - Memeriksa dan memberikan rekomendasi approval',
            ],
            [
                'name' => 'checker_teller',
                'display_name' => 'Checker Teller (BOSM)',
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

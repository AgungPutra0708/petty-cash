<?php

namespace App\Http\Controllers;

use App\Models\Bilyet;
use App\Models\Customer;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $userCount  = User::count();
        $bilyetCount = Bilyet::count();
        $customerCount = Customer::count();
        return view('dashboard', compact('userCount', 'bilyetCount', 'customerCount'));
    }
}

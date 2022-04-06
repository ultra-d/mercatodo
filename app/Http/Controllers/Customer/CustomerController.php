<?php

namespace App\Http\Controllers\Customer;

use App\Models\Invoice;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function index(): View
    {
        return view('customer.profile', [
            'invoices' => Invoice::latest()->paginate(8)
        ]);
    }
}

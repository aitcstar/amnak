<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;
use Hash;
use Auth;
use App\Models\AccountType;

class AccountTypeController extends Controller
{
    public function index(Request $request)
    {
        $AccountTypes = AccountType::orderBy('id', 'ASC')->get();
        return view('admin.accounttype.index', compact('AccountTypes'));
    }


    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\AccountType;
use App\Models\User;
use App\Models\Person;
use App\Models\Project;

use Hash;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
            if(Auth::user()->id != 1){
                /*$employees = Person::where('role_id',0)->orderBy('id', 'DESC')->get();
                return view('admin.employees.index', compact('employees'));*/
                $projects = Project::all();

                // البحث عن الموظفين بناءً على المشروع المحدد
                $query = Person::query();
        
               
                $employees = $query->get();
        
                return view('admin.employees.index', compact('employees', 'projects'));
            }else{
                $AccountTypes = AccountType::orderBy('id', 'ASC')->get();
                return view('admin.accounttype.index', compact('AccountTypes'));
            }
       
    }


}

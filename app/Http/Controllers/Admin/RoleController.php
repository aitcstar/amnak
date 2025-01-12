<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Role;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;
use Hash;
use Auth;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $roles = Role::get();
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function store(request $request)
    {
        $formInput=$request->all();

        $this->validate($request,[
            'name'=>'required',
        ]);

        $count = Role::where('name',$request->name)->count();

        if($count != 0){
            return back()->with('message', ' هذا الدور مسجل مسبقا');
        }else{
            Role::create($formInput);
        }

        return redirect()->route('rolesIndex',['admin','roles' ,'index']);
    }

    public function edit(request $request)
    {
        $role=Role::findOrFail($request->id);
        return view('admin.roles.edit', compact('role'));
    }

    public function update(request $request)
    {
        $formInput=$request->all();

        $this->validate($request,[
            'name'=>'required',
        ]);

        Role::where('id',$request->id)->update($formInput);
    

        return redirect()->route('rolesIndex',['admin','roles' ,'index']);
    }
   
    
    public function destroy(request $request,$id)
    {
        Role::where('id',$request->id)->delete();
        
        return back();
    }

}

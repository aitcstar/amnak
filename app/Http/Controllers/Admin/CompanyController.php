<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Company;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;
use Hash;
use Intervention\Image\ImageManagerStatic as Image;
use Auth;
use App\Models\User;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        $companies = Company::orderBy('id', 'DESC')->get();
        return view('admin.companies.index', compact('companies'));
    }

    public function create()
    {
        return view('admin.companies.create');
    }

    public function store(request $request)
    {
        $formInput=$request->all();
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'website'=>'required',
            'address'=>'required',
        ]);

        $count = Company::where('email',$request->email)->count();

        if($count != 0){
            return back()->with('message', 'البريد الإلكتروني مسجل مسبقا');
        }else{
            
                
                if($request->file('logo')){
                    $image=$request->file('logo');
                    if($image->isValid()){
                        $fileName=time().'-'.Str::slug($request['logo'],"-").'.'.$image->getClientOriginalExtension();
                        $small_image_path=public_path('companies/'.$fileName);
                        //Resize Image
                        Image::make($image)->save($small_image_path);
                        $formInput['logo']=$fileName;
                    }
                }

                $formInput['password']= Hash::make($request->password);

                $company = Company::create($formInput);
                User::create([
                    'name'          => $request->name,
                    'email'         => $request->email,
                    'phone'         => $request->phone,
                    'image'         => $company->logo,
                    'company_id'    => $company->id,
                    'password'      => Hash::make($request->password),
                ]);
            
        }

        return redirect()->route('companiesIndex',['admin','companies' ,'index']);
    }

    public function show(request $request)
    {
        $company = Company::where('id',$request->id)->first();       
        return view('admin.companies.show', compact('company'));
    }

    public function edit(request $request)
    {
        $company=Company::findOrFail($request->id);
        return view('admin.companies.edit', compact('company'));
    }

    public function update(request $request)
    {
        $formInput=$request->all();

        $this->validate($request,[
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'website'=>'required',
            'address'=>'required',
        ]);

            if($request->new_password != null && $request->password != null){
                Company::where('id',$request->id)->update(['password' => Hash::make($request->new_password)]);
                User::where('company_id',$request->id)->update(['password' => Hash::make($request->new_password)]);
            }else{
                if($request->file('logo')){
                    $image=$request->file('logo');
                    if($image->isValid()){
                       
                        $fileName=time().'-'.Str::slug($request['logo'],"-").'.'.$image->getClientOriginalExtension();
                        $small_image_path=public_path('companies/'.$fileName);
                        //Resize Image
                        Image::make($image)->save($small_image_path);
                        $formInput['logo']=$fileName;
                        User::where('company_id',$request->id)->update('image',$fileName);
                    }
                }
            

            if (is_null($formInput['password'])) {
                unset($formInput['password']);
            }
            
            if (is_null($formInput['new_password'])) {
                unset($formInput['new_password']);
            }

            Company::where('id',$request->id)->update($formInput);
    }

    if(Auth::user()->role_id == 1){
        return redirect()->route('companiesIndex',['admin','companies' ,'index']);
    }else{
        return redirect()->route('companiesEdit',['admin','companies' ,'edit',Auth::user()->id]);
    }
   
}
   
   
    public function destroy(request $request,$id)
    {
        User::where('company_id',$request->id)->delete();
        Company::where('id',$request->id)->delete();
        return back();
    }
    

    public function companyactive(request $request)
    {
       
        if(  $request->is_active== "مفعل"){
            $v = 0;
        }else{
            $v = 1;
        }
        //dd($v);
        Company::where('id',$request->id)->update(['is_active' => $v ]);
        
        return back();
    }

}


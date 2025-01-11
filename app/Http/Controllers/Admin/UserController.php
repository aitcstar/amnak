<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;
use Hash;
use Intervention\Image\ImageManagerStatic as Image;
use Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::where('role_id',0)->orderBy('id', 'DESC')->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create', compact('currencies'));
    }

    public function store(request $request)
    {
        $formInput=$request->all();

        $this->validate($request,[
            'name'=>'required',
            'email'=>'required',
        ]);

        $count = User::where('email',$request->email)->count();

        if($count != 0){
            return back()->with('message', 'البريد الإلكتروني مسجل مسبقا');
        }else{
            if($request->new_password != ''){
                User::where('id',$request->id)->update(['password' => Hash::make($request->new_password)]);
            }else{

                
                if($request->file('image')){
                    $image=$request->file('image');
                    if($image->isValid()){
                       
                        $fileName=time().'-'.Str::slug($request['image'],"-").'.'.$image->getClientOriginalExtension();
                        $small_image_path=public_path('profile/'.$fileName);
                        //Resize Image
                        Image::make($image)->save($small_image_path);
                        $formInput['image']=$fileName;
                    }
                }

                $formInput['password']= Hash::make($request->password);
                User::create($formInput);
                
            }
            
        }

        return redirect()->route('usersIndex',['admin','users' ,'index']);
    }

    public function show(request $request)
    {
        $user = User::where('id',$request->id)->first();       
        return view('admin.users.show', compact('user'));
    }

    public function edit(request $request)
    {
        $user=User::findOrFail($request->id);
       // dd($user);
        return view('admin.users.edit', compact('user'));
    }

    public function update(request $request)
    {
        $formInput=$request->all();

       
        $this->validate($request,[
            'name'=>'required',
        ]);

       
            if($request->new_password != null && $request->password != null){
                User::where('id',$request->id)->update(['password' => Hash::make($request->new_password)]);
            }else{
                if($request->file('image')){
                    $image=$request->file('image');
                    if($image->isValid()){
                       
                        $fileName=time().'-'.Str::slug($request['image'],"-").'.'.$image->getClientOriginalExtension();
                        $small_image_path=public_path('profile/'.$fileName);
                        //Resize Image
                        Image::make($image)->save($small_image_path);
                        $formInput['image']=$fileName;
                    }
                }
            
            if (is_null($formInput['password'])) {
                unset($formInput['password']);
            }
            
            if (is_null($formInput['new_password'])) {
                unset($formInput['new_password']);
            }
            //$formInput = $request->except(['_token']); // استثناء _token
            User::where('id',$request->id)->update($formInput);

       
    }

    if(Auth::user()->role_id == 1){
        return redirect()->route('usersIndex',['admin','users' ,'index']);
    }else{
        return redirect()->route('usersEdit',['admin','users' ,'edit',Auth::user()->id]);
    }
   
}
   
    

  
   
    public function destroy(request $request,$id)
    {
        User::where('id',$request->id)->delete();
        
        return back();
    }


    public function useractive(request $request)
    {
       
        if(  $request->active== "مفعل"){
            $v = 0;
        }else{
            $v = 1;
        }
        User::where('id',$request->id)->update(['active' => $v ]);
        
        return back();
    }


    
}

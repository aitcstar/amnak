<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Person;
use App\Models\PersonImage;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;
use Hash;
use Intervention\Image\ImageManagerStatic as Image;
use Auth;

class PersonController extends Controller
{
    public function index(Request $request)
    {
        $persons = Person::whereNull('company_id')->orderBy('id', 'DESC')->get();
        return view('admin.persons.index', compact('persons'));
    }


    public function create()
    {
        return view('admin.persons.create');
    }

    public function store(request $request)
    {
        $formInput=$request->all();

        $this->validate($request,[
            'first_name'=>'required',
            'last_name'=>'required',
            'national_id'=>'required',
            'gender'=>'required',
            'height'=>'required',
            'weight'=>'required',
            'password'=>'required',
            'salary'=>'required',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

       
                if($request->file('id_image')){
                    $image=$request->file('id_image');
                    if($image->isValid()){
                       
                        $fileName=time().'-'.Str::slug($request['id_image'],"-").'.'.$image->getClientOriginalExtension();
                        $small_image_path=public_path('employees/'.$fileName);
                        //Resize Image
                        Image::make($image)->save($small_image_path);
                        $formInput['id_image']=$fileName;
                    }
                }

                //$formInput['company_id'] = 0 ;
                $formInput['password']= Hash::make($request->password);

                $person = Person::create($formInput);
                // رفع الصور إن وجدت
                if ($request->hasFile('images')) {
                    foreach ($request->file('images') as $file) {
                        $path = $file->store('employees', 'public');
                        PersonImage::create([
                            'person_id' => $person->id,
                            'image_path' => $path,
                        ]);
                    }
                }
            
            
        

        return redirect()->route('personsIndex',['admin','persons' ,'index']);
    }



    public function show(request $request)
    {
        $person = Person::with('images')->find($request->id);
        return view('admin.persons.show', compact('person'));
    }
   
    
   
    public function edit(request $request)
    {
        $person=Person::findOrFail($request->id);

        return view('admin.persons.edit', compact('person'));
    }

    public function update(request $request)
    {
        $formInput=$request->all();

       
        $this->validate($request,[
            'first_name'=>'required',
            'last_name'=>'required',
            'national_id'=>'required',
            'gender'=>'required',
            'height'=>'required',
            'weight'=>'required',
            'salary'=>'required',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

       
          
                if($request->file('id_image')){
                    $image=$request->file('id_image');
                    if($image->isValid()){
                       
                        $fileName=time().'-'.Str::slug($request['id_image'],"-").'.'.$image->getClientOriginalExtension();
                        $small_image_path=public_path('employees/'.$fileName);
                        //Resize Image
                        Image::make($image)->save($small_image_path);
                        $formInput['id_image']=$fileName;
                    }
                }
            
           
            Person::where('id',$request->id)->update($formInput);

       
   

    if(Auth::user()->role_id == 1){
        return redirect()->route('personsIndex',['admin','persons' ,'index']);
    }else{
        return redirect()->route('personsIndex',['admin','persons' ,'index']);
    }
  }


    public function destroy(request $request,$id)
    {
        Person::where('id',$request->id)->delete();
        
        return back();
    }
}

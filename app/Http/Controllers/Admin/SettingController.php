<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Datatables;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController  extends Controller
{
    
    public function index(Request $request)
    {
        $ambulance=Setting::where(['key' => 'ambulance'])->value('value');

        return view('admin.settings.index', compact('ambulance'));
    }
   
    public function update(Request $request)
    {
        Setting::where(['key' =>'ambulance'])->update(['value' => $request->ambulance]);

        session()->flash('message' , 'تم تحديث رقم الاسعاف' );
        return back();
    }


}

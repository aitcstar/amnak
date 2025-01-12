<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Person;
use App\Models\PersonLeave;
use Illuminate\Http\Request;
use Auth;


class PersonLeaveController extends Controller
{
    
    public function index()
    {
        $leaves = PersonLeave::with('person', 'company')->get();
        return view('admin.person_leaves.index', compact('leaves'));
    }

    public function create()
    {
        $persons = Person::where('company_id',Auth::user()->company_id )->get();
        return view('admin.person_leaves.create' ,compact('persons'));
    }

    public function store(Request $request)
    {
        $formInput=$request->all();


        $request->validate([
            'person_id' => 'required|exists:persons,id',
            'leave_type' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'reason' => 'nullable|string',
        ]);

        $formInput['company_id'] = Auth::user()->company_id ;

        PersonLeave::create($formInput);

        return redirect()->route('personleavesIndex',['admin','personleaves' ,'index']);

    }

    public function show(request $request)
    {
        $leave = PersonLeave::findOrFail($request->id);
        return view('admin.person_leaves.show', compact('leave'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $leave = PersonLeave::findOrFail($id);
        $leave->status = $request->status;
        $leave->save();

        return redirect()->route('personleavesIndex',['admin','personleaves' ,'index'])->with('message', 'تم تحديث الحالة بنجاح.');

    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Project;
use App\Models\ProjectPerson;
use App\Models\Person;
use App\Models\Role;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;
use Hash;
use Intervention\Image\ImageManagerStatic as Image;
use Auth;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $projects = Project::orderBy('id', 'DESC')->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(request $request)
    {
        $formInput=$request->all();
        $this->validate($request,[
            'name'=>'required',
            'duration'=>'required',
            'locations'=>'required',
            'members_count'=>'required',
            'shifts_count'=>'required',
        ]);

        $count = Project::where('name',$request->name)->count();

        if($count != 0){
            return back()->with('message', 'اسم المشروع مسجل مسبقا');
        }else{
            $formInput['company_id'] = Auth::user()->company_id ;

            Project::create($formInput);
        }

        return redirect()->route('projectsIndex',['admin','projects' ,'index']);
    }

    public function show(request $request)
    {
        $project = Project::where('id',$request->id)->first();       
        return view('admin.projects.show', compact('project'));
    }

    public function edit(request $request)
    {
        $project=Project::findOrFail($request->id);
        $persons = Person::where('company_id',Auth::user()->company_id )->get();
        $roles = Role::get();
        return view('admin.projects.edit', compact('project','persons','roles'))->with('active_tab', 'aboutme');
    }

    public function update(request $request)
    {
        $formInput=$request->all();

        $this->validate($request,[
            'name'=>'required',
            'duration'=>'required',
            'locations'=>'required',
            'members_count'=>'required',
            'shifts_count'=>'required',
        ]);

            
        Project::where('id',$request->id)->update($formInput);
    

        if(Auth::user()->role_id == 1){
            return redirect()->route('projectsIndex',['admin','projects' ,'index'])->with('active_tab', 'aboutme');
        }else{
            return redirect()->route('projectsIndex',['admin','projects' ,'index'])->with('active_tab', 'aboutme');
        }
   
    }
   
   
    public function destroy(request $request,$id)
    {
        Project::where('id',$request->id)->delete();
        return back();
    }
    

    public function assignPerson(Request $request, $projectId)
    {
        $request->validate([
            'person_id' => 'required',
            'role' => 'required',
        ]);

        
        $project = Project::findOrFail($projectId);

        // التحقق إذا كان الموظف مضافًا بالفعل
        if ($project->persons()->where('person_id', $request->person_id)->exists()) {
            return redirect()->back()->with('message', 'هذا الموظف مضاف بالفعل لهذا المشروع.')->with('active_tab', 'settings');
        }

        // إضافة الموظف إلى المشروع
        $project->persons()->attach($request->person_id, ['role' => $request->role]);

        
        return redirect()->back()->with('message', 'تم إضافة الموظف بنجاح')->with('active_tab', 'settings');
    }

    public function removePerson($projectId, $personId)
    {
        $project = Project::findOrFail($projectId);
        $project->persons()->detach($personId);

        return redirect()->back()->with('message', 'تم حذف الموظف بنجاح');
    }
}


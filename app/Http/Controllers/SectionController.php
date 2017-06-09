<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Section;
use App\Department;
use App\Http\Controllers\Controller;

class SectionController extends Controller
{
    
    public function index(){

        $sections = \DB::table('section')
                    ->join('department', 'section.department_fk', '=', 'department.id')
                    ->select('section.*', 'department.department_name')->get();

        $departments = Department::all();


        return view("maintenance.maintenance-section")
            ->with('sections', $sections)
            ->with('departments', $departments);
    }

    public function store(Request $request)
    {        
        $section = Section::create(array(
                'section_name' => trim($request->input('add-section-name')),
                'department_fk' => $request->input('add-section-department'),
                'is_active' => 1
            ));

        $added = $section->save();

        return redirect('maintenance/section');
    }

    public function update(Request $request)
    {

        $section = Section::find($request->input('edit-section-id'));

        $section->section_name = trim($request->input('edit-section-name'));
        $section->department_fk = $request->input('edit-section-department');
        $section->save();

        return redirect('maintenance/section');
    }

    public function delete(Request $request)
    {

        $section = Section::find($request->input('del-section-id'));

        $section->is_active = 0;
        $section->save();

        return redirect('maintenance/section');
    }
    
}



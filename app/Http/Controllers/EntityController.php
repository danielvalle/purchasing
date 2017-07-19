<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Entity;
use App\Http\Controllers\Controller;

class EntityController extends Controller
{
	
	public function index(){

        $entities = Entity::all();

		return view("maintenance.maintenance-entity")
            ->with('entities', $entities);
	}

    public function store(Request $request)
    {        
        $entity_check = \DB::table('entity')
                    ->where('entity_name', trim($request->input('add-entity-name')))
                    ->first();
        
        if($entity_check == null)
        {
            $entity = Entity::create(array(
                'entity_name' => trim($request->input('add-entity-name')),
                'is_active' => 1
            ));

            $entity->save();

            \Session::flash('entity_new_success', "Entity is successfully added.");
        }
        else \Session::flash('entity_new_fail', "Entity already exists.");

        return redirect('maintenance/entity');
    }

    public function update(Request $request)
    {
        $entity_check = \DB::table('entity')
                    ->where('entity_name', trim($request->input('edit-entity-name')))
                    ->first();
        
        if($entity_check == null)
        {
            $entity = Entity::find($request->input('edit-entity-id'));
            $entity->entity_name = trim($request->input('edit-entity-name'));
            $entity->save();

            \Session::flash('entity_edit_success', trim($request->input('edit-entity-name')) . " is successfully updated.");
            
        }
        else if($entity_check->entity_name == trim($request->input('edit-entity-name')) && $entity_check->id != $request->input('edit-entity-id'))
        {
            \Session::flash('entity_edit_fail', trim($request->input('edit-entity-name')) . " already exists.");
        }

        return redirect('maintenance/entity');
    }

    public function delete(Request $request)
    {
    	$entity = Entity::find($request->input('del-entity-id'));

        $entity->is_active = 0;
        $entity->save();

        return redirect('maintenance/entity');
    }
	
}



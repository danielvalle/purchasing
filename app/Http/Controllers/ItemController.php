<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Item;
use App\StockCard;
use App\Http\Controllers\Controller;

class ItemController extends Controller
{
    
    public function index(){

        $items = Item::all();
        $stock_cards = \DB::table('stock_card as a')
                ->leftJoin("office as b", "a.office_fk", "=", "b.id")
                ->select("a.*", "b.office_name")
                ->get();

        return view("maintenance.maintenance-item")->with('items', $items)->with("stock_cards", $stock_cards);
    }

    public function store(Request $request)
    {        
        $item_name_check = \DB::table('item')
                    ->where('item_name', trim($request->input('add-item-name')))
                    ->first();

        $stock_no_check = \DB::table('item')
                    ->where('stock_no', trim($request->input('add-stock-no')))
                    ->first();

        if($item_name_check == null && $stock_no_check == null)
        {
            $item = Item::create(array(
                'stock_no' => trim($request->input('add-stock-no')),
                'item_name' => trim($request->input('add-item-name')),
                'item_description' => trim($request->input('add-item-description')),
                'is_active' => 1
            ));

            $item->save();

            \Session::flash('item_new_success', "Item is successfully added.");
        }
        else if($item_name_check != null)
        {
            \Session::flash('item_new_fail', "Item already exists.");
        }
        else if($stock_no_check != null)
        {
            \Session::flash('stock_no_new_fail', "Stock No. is already used.");
        }

        return redirect('maintenance/item');
    }

    public function update(Request $request)
    {
        $item_name_check = \DB::table('item')
                    ->where('item_name', trim($request->input('edit-item-name')))
                    ->first();

        $stock_no_check = \DB::table('item')
                    ->where('stock_no', trim($request->input('edit-stock-no')))
                    ->first();

        $item_check = \DB::table('item')
                    ->where('item_name', trim($request->input('edit-item-name')))
                    ->orWhere('stock_no', trim($request->input('edit-stock-no')))
                    ->first();

        

        //if($item_check == null)
        //{
           
            $item = Item::find($request->input('edit-item-id'));

            $item->stock_no = trim($request->input('edit-stock-no'));
            $item->item_name = trim($request->input('edit-item-name'));
            $item->item_description = trim($request->input('edit-item-description'));
            
            $item->save();
        /*    
            \Session::flash('item_edit_success', trim($request->input('edit-item-name')) . " is successfully updated.");
        }
        else if($item_name_check->item_name == trim($request->input('edit-item-name')) && $item_name_check->id != $request->input('edit-item-id'))
        {
            \Session::flash('item_edit_fail', trim($request->input('edit-item-name')) . " already exists.");
        }
        else if($stock_no_check->stock_no == trim($request->input('edit-stock-no')) && $stock_no_check->id != $request->input('edit-item-id'))
        {
            \Session::flash('stock_no_edit_fail', trim($request->input('edit-stock-no')) . " already exists.");
        }*/

        return redirect('maintenance/item');
    }

    public function delete(Request $request)
    {

        $item = Item::find($request->input('del-item-id'));

        $item->is_active = 0;
        $item->save();

        return redirect('maintenance/item');
    }
    
}


